<?php
/**
 * Stage 7 seed — pages, menus, and launch content.
 *
 * Run via WP-CLI:
 *   php8.3 wp-cli.phar --path=PATH eval-file scripts/prod-seed-stage7.php -- --publish
 *
 * Modes:
 *   STAGE7_STATUS=draft|publish
 *   STAGE7_DRY_RUN=1
 *   STAGE7_FORCE=1
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("CLI only\n");
}

if (!defined('ABSPATH')) {
    exit("WordPress context required (run via wp-cli eval-file)\n");
}

$_SERVER['HTTP_HOST'] = $_SERVER['HTTP_HOST'] ?? 'localhost';

$cli_flags = isset($args) && is_array($args) ? $args : (isset($argv) ? $argv : []);
$dry_run = in_array('--dry-run', $cli_flags, true) || (getenv('STAGE7_DRY_RUN') === '1');
$force = in_array('--force', $cli_flags, true) || (getenv('STAGE7_FORCE') === '1');
$status = getenv('STAGE7_STATUS') ?: 'draft';
if (in_array('--publish', $cli_flags, true)) {
    $status = 'publish';
}
if (in_array('--draft', $cli_flags, true)) {
    $status = 'draft';
}

echo "=== Stage 7 Seed ===\n";
echo 'Mode: ' . ($dry_run ? 'dry-run' : $status) . ($force ? ' | force' : '') . "\n";

/* ---------------------------------------------------------------------- */
/* Helpers                                                                */
/* ---------------------------------------------------------------------- */

function stage7_url(string $path): string {
    if (preg_match('#^https?://#i', $path) || str_starts_with($path, '#')) {
        return $path;
    }

    return home_url($path);
}

function stage7_btn(string $label, string $url, string $variant = 'de-btn--green'): string {
    return '<a class="de-btn ' . esc_attr($variant) . '" href="' . esc_url(stage7_url($url)) . '">' . esc_html($label) . '</a>';
}

function stage7_button_row(array $buttons): string {
    if (!$buttons) {
        return '';
    }

    $html = '<div class="de-actions">';
    foreach ($buttons as $button) {
        $html .= stage7_btn($button['label'], $button['url'], $button['variant'] ?? 'de-btn--green');
    }
    return $html . '</div>';
}

function stage7_card(string $title, string $text, string $url = '', string $label = 'Подробнее →'): string {
    $link = $url !== '' ? '<a class="de-link" href="' . esc_url(stage7_url($url)) . '">' . esc_html($label) . '</a>' : '';
    return '<article class="de-card de-card--tool"><h3>' . esc_html($title) . '</h3><p>' . esc_html($text) . '</p>' . $link . '</article>';
}

function stage7_grid(array $cards): string {
    $html = '<div class="de-grid de-grid-3">';
    foreach ($cards as $card) {
        $html .= stage7_card(
            $card['title'],
            $card['text'],
            $card['url'] ?? '',
            $card['label'] ?? 'Подробнее →'
        );
    }
    return $html . '</div>';
}

function stage7_list(array $items, string $class = 'de-checklist'): string {
    $html = '<ul class="' . esc_attr($class) . '">';
    foreach ($items as $item) {
        $html .= '<li>' . esc_html($item) . '</li>';
    }
    return $html . '</ul>';
}

function stage7_section(string $title, string $lead = '', string $body = '', bool $muted = false): string {
    $html = '<section class="de-section' . ($muted ? ' de-section--muted' : '') . '">';
    if ($title !== '') {
        $html .= '<h2>' . esc_html($title) . '</h2>';
    }
    if ($lead !== '') {
        $html .= '<p class="de-lead">' . esc_html($lead) . '</p>';
    }
    return $html . $body . '</section>';
}

function stage7_hero(string $eyebrow, string $h1, string $lead, array $buttons = [], string $poster = ''): string {
    $html = '<section class="de-hero"><div><span class="de-eyebrow">' . esc_html($eyebrow) . '</span><h1>' . esc_html($h1) . '</h1><p class="de-lead">' . esc_html($lead) . '</p>';
    $html .= stage7_button_row($buttons);
    $html .= '</div>';
    $html .= $poster !== '' ? '<figure class="de-hero__poster">' . $poster . '</figure>' : '';
    return $html . '</section>';
}

function stage7_shell(string $hero, array $sections): string {
    return '<div class="de-shell">' . $hero . implode('', $sections) . '</div>';
}

function stage7_photo_placeholder(string $text): string {
    return '<div class="de-photo-placeholder" style="min-height:280px;display:grid;place-items:center;border:1px dashed #c9d5e3;border-radius:20px;padding:24px;text-align:center;">' . esc_html($text) . '</div>';
}

function stage7_note(string $text): string {
    return '<p class="de-note">' . esc_html($text) . '</p>';
}

function stage7_upsert_page(array $spec, array $created, string $status, bool $force, bool $dry_run): int {
    $slug = $spec['slug'];
    $path = ltrim($spec['path'], '/');
    $resolved_slug = trim(basename(rtrim($path, '/')), '/');
    if ($resolved_slug === '') {
        $resolved_slug = $slug;
    }
    $existing = get_page_by_path($path, OBJECT, 'page');
    $parent_id = 0;

    if (!empty($spec['parent_slug']) && isset($created[$spec['parent_slug']])) {
        $parent_id = (int) $created[$spec['parent_slug']];
    }

    $managed = $existing ? get_post_meta($existing->ID, '_stage7_managed', true) : '';
    $can_update = $force || $managed;

    if ($existing && !$can_update) {
        echo "  skip {$spec['path']} (exists, not managed)\n";
        return (int) $existing->ID;
    }

    $payload = [
        'post_type'    => 'page',
        'post_status'  => $status,
        'post_title'   => $spec['title'],
        'post_name'    => $resolved_slug,
        'post_parent'  => $parent_id,
        'post_content' => $spec['content'],
    ];

    if ($dry_run) {
        echo '  dry-run ' . $spec['path'] . ' => ' . $status . "\n";
        return $existing ? (int) $existing->ID : 0;
    }

    if ($existing) {
        delete_post_meta($existing->ID, '_wp_page_template');
        $payload['ID'] = $existing->ID;
        $page_id = wp_update_post(wp_slash($payload), true);
        if (is_wp_error($page_id)) {
            throw new RuntimeException($page_id->get_error_message());
        }
        echo "  updated {$spec['path']}\n";
    } else {
        $page_id = wp_insert_post(wp_slash($payload), true);
        if (is_wp_error($page_id)) {
            throw new RuntimeException($page_id->get_error_message());
        }
        echo "  created {$spec['path']}\n";
    }

    update_post_meta($page_id, '_stage7_managed', 1);
    update_post_meta($page_id, '_stage7_version', '2026-07-07-stage7');
    if (!empty($spec['seo_title'])) {
        update_post_meta($page_id, 'rank_math_title', $spec['seo_title']);
    }
    if (!empty($spec['seo_description'])) {
        update_post_meta($page_id, 'rank_math_description', $spec['seo_description']);
    }

    return (int) $page_id;
}

function stage7_manage_menu(string $menu_name, string $location, array $items, array $pages, bool $force, bool $dry_run): void {
    $menu = wp_get_nav_menu_object($menu_name);
    $menu_id = $menu ? (int) $menu->term_id : 0;
    $managed = $menu_id ? get_term_meta($menu_id, '_stage7_managed', true) : '';
    $can_update = $force || !$menu_id || $managed;

    if (!$can_update) {
        echo "  skip menu {$menu_name} (exists, not managed)\n";
        return;
    }

    if ($dry_run) {
        echo "  dry-run menu {$menu_name}\n";
        return;
    }

    if (!$menu_id) {
        $menu_id = (int) wp_create_nav_menu($menu_name);
    }

    $existing_items = wp_get_nav_menu_items($menu_id, ['orderby' => 'menu_order']);
    if ($existing_items) {
        foreach ($existing_items as $item) {
            wp_delete_post($item->ID, true);
        }
    }

    $created_items = [];
    foreach ($items as $item) {
        $parent_id = 0;
        if (!empty($item['parent']) && isset($created_items[$item['parent']])) {
            $parent_id = (int) $created_items[$item['parent']];
        }

        $page_id = $pages[$item['page_slug']] ?? 0;
        $url = !empty($item['url']) ? stage7_url($item['url']) : get_permalink($page_id);

        $created_items[$item['key']] = wp_update_nav_menu_item(
            $menu_id,
            0,
            [
                'menu-item-title'     => $item['title'],
                'menu-item-url'       => $url,
                'menu-item-status'     => 'publish',
                'menu-item-type'      => 'custom',
                'menu-item-object'    => 'custom',
                'menu-item-parent-id' => $parent_id,
            ]
        );
    }

    $locations = get_theme_mod('nav_menu_locations', []);
    $locations[$location] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);
    update_term_meta($menu_id, '_stage7_managed', 1);
    update_term_meta($menu_id, '_stage7_version', '2026-07-07-stage7');

    echo "  menu {$menu_name} ready\n";
}

/* ---------------------------------------------------------------------- */
/* Content builders                                                       */
/* ---------------------------------------------------------------------- */

function stage7_home_content(): string {
    $hero = stage7_hero(
        'Специалист по недвижимости',
        'Губернатчук Наталья Александровна — специалист по недвижимости в Москве и области',
        'Для продавца — оценка, подготовка, показы и переговоры. Для покупателя — подбор, каталог, ипотека и проверка объекта.',
        [
            ['label' => 'Продать квартиру / дом', 'url' => '/sell/', 'variant' => 'de-btn--green'],
            ['label' => 'Купить квартиру / новостройку', 'url' => '/buyers/', 'variant' => 'de-btn--white'],
        ],
        stage7_photo_placeholder('Место для фото Натальи Александровны')
    );

    $sections = [];
    $sections[] = stage7_section(
        'Как работаю',
        'Понятный путь для продавца и покупателя',
        stage7_grid([
            ['title' => 'Оценка и план', 'text' => 'Сначала считаем рамку цены или сценарий покупки. Потом определяем шаги.', 'url' => '/sell/estimate/'],
            ['title' => 'Проверка рисков', 'text' => 'Проверяем объект, документы, застройщика и условия сделки до задатка.', 'url' => '/buyers/check/'],
            ['title' => 'Сопровождение сделки', 'text' => 'Переговоры, документы, показ, согласование и доведение до результата.', 'url' => '/sell/diagnostic/'],
        ])
    );

    $sections[] = stage7_section(
        'Два сценария',
        'Сразу видно, какой маршрут подходит',
        stage7_list([
            'Продавец не знает рыночную цену и хочет понять стартовую рамку',
            'Покупателю нужен каталог и проверка до задатка',
            'Нужна альтернативная сделка или связка по срокам',
            'Есть документальные нюансы и нужен аккуратный маршрут',
        ])
    );

    $sections[] = stage7_section(
        'Почему доверяют',
        'INCOM как база, отзывы и публичные факты',
        stage7_grid([
            ['title' => 'Офис Братиславская, 26', 'text' => 'База INCOM-Недвижимость, Москва, Марьино.', 'url' => '/about/'],
            ['title' => 'Отзывы клиентов INCOM', 'text' => 'Публичные отзывы и рейтинг для trust-контента.', 'url' => '/reviews/'],
            ['title' => 'Награды и история', 'text' => 'Использую только подтверждённые факты INCOM.', 'url' => '/about/'],
        ])
    );

    $sections[] = stage7_section(
        'Полезные материалы',
        'Статьи вместо отдельного FAQ-раздела',
        stage7_grid([
            ['title' => 'Для владельцев', 'text' => 'Продажа, подготовка, документы, налоги и показы.', 'url' => '/blog/sellers/'],
            ['title' => 'Для покупателей', 'text' => 'Каталог, ипотека, проверка и сопровождение.', 'url' => '/blog/buyers/'],
            ['title' => 'Документы и ипотека', 'text' => 'Материалы по самым частым вопросам клиента.', 'url' => '/blog/documents/'],
        ])
    );

    $sections[] = stage7_section(
        'Отзывы',
        'Короткий блок доверия на главной',
        stage7_grid([
            ['title' => 'INCOM отзывы', 'text' => '5599 публичных отзывов клиентов на официальной странице.', 'url' => 'https://www.incom.ru/otzyvy-klientov/'],
            ['title' => 'Офис Марьино', 'text' => 'Отдельные отзывы и команда офиса на Братиславской, 26.', 'url' => 'https://www.incom.ru/offices/flatsretail/21263/realtors/'],
            ['title' => 'Яндекс Карты', 'text' => 'Рейтинг 4.1 и публичные отзывы по офису.', 'url' => 'https://yandex.ru/maps/org/inkom_nedvizhimost/1016840724/'],
        ]) . stage7_note('Отзывы публикуются только из публичных источников или с согласия клиента.')
    );

    $sections[] = stage7_section(
        'Связь',
        'Оперативный контакт и следующий шаг',
        stage7_button_row([
            ['label' => 'Получить консультацию по продаже', 'url' => '/contacts/', 'variant' => 'de-btn--green'],
            ['label' => 'Обсудить подбор объекта', 'url' => '/contacts/', 'variant' => 'de-btn--white'],
        ])
    );

    return stage7_shell($hero, $sections);
}

function stage7_sell_content(): string {
    $hero = stage7_hero(
        'Владельцам',
        'Продажа квартиры или дома — с понятным планом и сопровождением сделки',
        'Оценка, подготовка, показы, переговоры, налоги и альтернативные сделки.',
        [
            ['label' => 'Оценить недвижимость', 'url' => '/sell/estimate/'],
            ['label' => 'Полная диагностика', 'url' => '/sell/diagnostic/', 'variant' => 'de-btn--white'],
        ]
    );

    $sections = [];
    $sections[] = stage7_section(
        'Услуги для продавцов',
        'Что входит в сопровождение',
        stage7_grid([
            ['title' => 'Оценка', 'text' => 'Определяем рамку цены и логику выхода на рынок.', 'url' => '/sell/estimate/'],
            ['title' => 'Диагностика', 'text' => 'Смотрим, где теряются деньги и время.', 'url' => '/sell/diagnostic/'],
            ['title' => 'Подготовка', 'text' => 'Стайлинг, фото, тексты, документы и порядок показа.', 'url' => '/sell/prepare/'],
            ['title' => 'Документы', 'text' => 'Проверяем пакет документов и сложные моменты сделки.', 'url' => '/sell/documents/'],
            ['title' => 'Показы', 'text' => 'Готовим сценарий показов и ответы на возражения.', 'url' => '/sell/showings/'],
            ['title' => 'Переговоры и торг', 'text' => 'Согласовываем условия и защищаем интерес продавца.', 'url' => '/sell/negotiation/'],
        ])
    );

    $sections[] = stage7_section(
        'Когда это особенно полезно',
        'Маршруты продавца',
        stage7_list([
            'Когда нужно понять стартовую цену',
            'Когда самостоятельная продажа не дала результата',
            'Когда есть альтернативная покупка',
            'Когда по документам есть нюансы',
        ])
    );

    $sections[] = stage7_section(
        'Что важно знать',
        'FAQ как блок внутри страницы, не отдельный раздел',
        stage7_list([
            'Нужен ли ремонт перед продажей?',
            'Какие документы нужны для сделки?',
            'Как проходит показ квартиры?',
            'Как работает альтернативная сделка?',
            'Какие налоги могут возникнуть при продаже?',
        ])
    );

    $sections[] = stage7_section(
        'Следующий шаг',
        'Если нужен старт без лишней теории',
        stage7_button_row([
            ['label' => 'Получить консультацию', 'url' => '/contacts/'],
            ['label' => 'Перейти к оценке', 'url' => '/sell/estimate/', 'variant' => 'de-btn--white'],
        ])
    );

    return stage7_shell($hero, $sections);
}

function stage7_sell_estimate_content(): string {
    $hero = stage7_hero(
        'Оценка',
        'Первичный диапазон цены — без обещаний и без давления',
        'Это не гарантия продажи, а рабочая рамка для старта и переговоров.',
        [
            ['label' => 'Запросить оценку', 'url' => '/contacts/'],
            ['label' => 'К диагностике', 'url' => '/sell/diagnostic/', 'variant' => 'de-btn--white'],
        ]
    );

    return stage7_shell($hero, [
        stage7_section('Что учитываю', '', stage7_list([
            'Район, дом, состояние и этаж',
            'Площадь, планировка и документы',
            'Факторы спроса и ликвидности',
        ])),
        stage7_section('Что получаете', '', stage7_list([
            'Рабочий диапазон цены',
            'Что может поднять или снизить цену',
            'Следующий шаг: подготовка или продажа как есть',
        ])),
    ]);
}

function stage7_sell_diagnostic_content(): string {
    $hero = stage7_hero(
        'Диагностика',
        'Полная диагностика продажи — где теряются деньги и сроки',
        'Проверка объекта, документов, подачи и переговорной позиции.',
        [
            ['label' => 'Запросить диагностику', 'url' => '/contacts/'],
            ['label' => 'Подготовка', 'url' => '/sell/prepare/', 'variant' => 'de-btn--white'],
        ]
    );

    return stage7_shell($hero, [
        stage7_section('10 точек внимания', '', stage7_list([
            'Цена и стартовая позиция',
            'Фото и объявление',
            'Документы и риски',
            'Показ и сценарий общения',
            'Торг и согласование условий',
            'Налоги и альтернативные схемы',
        ])),
    ]);
}

function stage7_sell_prepare_content(): string {
    $hero = stage7_hero('Подготовка', 'Как подготовить объект к продаже без лишних затрат', 'Клининг, документы, фото, staging и порядок выхода в рекламу.', [['label' => 'Заказать подготовку', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Что делаем', '', stage7_list(['Оцениваем, что улучшать, а что не трогать', 'Готовим фото и описание', 'Собираем чек-лист по объекту', 'Даём план выхода на рынок']))]);
}

function stage7_sell_documents_content(): string {
    $hero = stage7_hero('Документы', 'Какие документы нужны для продажи', 'Проверка пакета документов и сложных мест до сделки.', [['label' => 'Проверить документы', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Пакет', '', stage7_list(['Право собственности', 'Основание владения', 'Согласия и доверенности', 'Дополнительные документы по ситуации']))]);
}

function stage7_sell_showings_content(): string {
    $hero = stage7_hero('Показы', 'Как проводить показы, чтобы не терять покупателя', 'Сценарий показа, ответы на вопросы и порядок действий.', [['label' => 'Обсудить показы', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('На что смотрим', '', stage7_list(['Свет, порядок и первые 30 секунд', 'Ответы на частые вопросы', 'Что говорить о цене и торге']))]);
}

function stage7_sell_negotiation_content(): string {
    $hero = stage7_hero('Переговоры', 'Переговоры и торг без лишнего давления', 'Согласование условий с опорой на реальную ситуацию сделки.', [['label' => 'Обсудить стратегию', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Как помогаю', '', stage7_list(['Фиксируем рамки по цене', 'Снижаем риск эмоционального торга', 'Прописываем следующий шаг']))]);
}

function stage7_sell_taxes_content(): string {
    $hero = stage7_hero('Налоги', 'Налоги при продаже', 'Кратко о том, что важно проверить до сделки.', [['label' => 'Уточнить ситуацию', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Что обсуждаем', '', stage7_list(['Срок владения', 'Возможные вычеты', 'Нюансы по семейной и долевой собственности']))]);
}

function stage7_sell_alternative_content(): string {
    $hero = stage7_hero('Альтернативная сделка', 'Продажа с одновременной покупкой — отдельный сценарий', 'Нужен порядок действий, чтобы не потерять деньги и сроки.', [['label' => 'Обсудить альтернативу', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Когда актуально', '', stage7_list(['Нужно продать и сразу купить', 'Есть встречная сделка', 'Нужна связка по срокам']))]);
}

function stage7_buyers_content(): string {
    $hero = stage7_hero(
        'Покупателям',
        'Покупка недвижимости в Москве и области — с подбором, проверкой и сопровождением',
        'Каталог, ипотека, проверка объекта, документы и переговоры — в одном маршруте.',
        [
            ['label' => 'Смотреть каталог', 'url' => '/buyers/catalog/'],
            ['label' => 'Ипотека', 'url' => '/buyers/mortgage/', 'variant' => 'de-btn--white'],
        ]
    );

    $sections = [];
    $sections[] = stage7_section(
        'Услуги для покупателей',
        'Что входит в сопровождение',
        stage7_grid([
            ['title' => 'Каталог', 'text' => 'Новостройки и вторичка с понятной навигацией.', 'url' => '/buyers/catalog/'],
            ['title' => 'Ипотека', 'text' => 'Подбор программы и предварительный расчёт.', 'url' => '/buyers/mortgage/'],
            ['title' => 'Подбор', 'text' => 'Собираю варианты под ваш бюджет и критерии.', 'url' => '/buyers/selection/'],
            ['title' => 'Проверка', 'text' => 'Объект, документы, риски и статус сделки.', 'url' => '/buyers/check/'],
            ['title' => 'Сопровождение', 'text' => 'Провожу до регистрации и закрытия сделки.', 'url' => '/buyers/support/'],
            ['title' => 'Переговоры', 'text' => 'Помогаю согласовать условия и зафиксировать их.', 'url' => '/buyers/negotiation/'],
        ])
    );

    $sections[] = stage7_section(
        'Для чего это нужно',
        'Коротко и по делу',
        stage7_list([
            'Первичная покупка и семейный сценарий',
            'Ипотека и подготовка заявки',
            'Новостройка или вторичка',
            'Проверка объекта до задатка',
            'Альтернативная сделка или покупка с продажей своей квартиры',
        ])
    );

    return stage7_shell($hero, $sections);
}

function stage7_buyers_catalog_content(): string {
    $hero = stage7_hero(
        'Каталог',
        'Каталог недвижимости — новостройки и вторичка',
        'Вторичка на старте без объектов — веду на подбор. Новостройки наполняю по застройщикам, районам и метро.',
        [
            ['label' => 'Новостройки', 'url' => '/buyers/catalog/new-buildings/'],
            ['label' => 'Вторичка', 'url' => '/buyers/catalog/resale/', 'variant' => 'de-btn--white'],
        ]
    );

    $sections = [];
    $sections[] = stage7_section(
        'Два сценария',
        'Выбор зависит от задачи',
        stage7_grid([
            ['title' => 'Новостройки', 'text' => 'Каталог по застройщикам, районам и метро.', 'url' => '/buyers/catalog/new-buildings/'],
            ['title' => 'Вторичка', 'text' => 'На старте веду на подбор, пока объекты не опубликованы.', 'url' => '/buyers/catalog/resale/'],
        ])
    );

    $sections[] = stage7_section(
        'Что дальше',
        'Если нужного объекта пока нет',
        stage7_button_row([
            ['label' => 'Оставить заявку на подбор', 'url' => '/buyers/selection/'],
            ['label' => 'Обсудить ипотеку', 'url' => '/buyers/mortgage/', 'variant' => 'de-btn--white'],
        ])
    );

    return stage7_shell($hero, $sections);
}

function stage7_buyers_catalog_new_content(): string {
    $hero = stage7_hero(
        'Новостройки',
        'Новостройки по застройщикам, районам и метро',
        'Здесь будут карточки объектов, комментарии редактора и сортировки по нужным фильтрам.',
        [
            ['label' => 'Обсудить подбор', 'url' => '/buyers/selection/'],
            ['label' => 'Каталог', 'url' => '/buyers/catalog/', 'variant' => 'de-btn--white'],
        ]
    );

    return stage7_shell($hero, [
        stage7_section('Фильтры', '', stage7_list([
            'Все застройщики или выбранные',
            'Районы и локации',
            'Метро и транспортная доступность',
            'Комментарий редактора к каждому объекту',
        ])),
        stage7_section('Стартовый режим', '', stage7_note('Объекты добавляются по мере наполнения каталога. Пока карточек нет, пользователь уходит на подбор и консультацию.')),
    ]);
}

function stage7_buyers_catalog_resale_content(): string {
    $hero = stage7_hero(
        'Вторичка',
        'Вторичка на старте — на подбор и консультацию',
        'Объектов в продаже у агента пока нет, поэтому маршрут ведёт в индивидуальный подбор.',
        [
            ['label' => 'Подобрать объект', 'url' => '/buyers/selection/'],
            ['label' => 'Каталог новостроек', 'url' => '/buyers/catalog/new-buildings/', 'variant' => 'de-btn--white'],
        ]
    );

    return stage7_shell($hero, [
        stage7_section('Что происходит сейчас', '', stage7_list([
            'Публикаций вторички пока нет',
            'Маршрут ведёт в индивидуальный подбор',
            'После наполнения карточки вернутся в каталог',
        ])),
    ]);
}

function stage7_buyers_mortgage_content(): string {
    $hero = stage7_hero(
        'Ипотека',
        'Ипотека в Москве и области — подбор условий и предварительный расчёт',
        'Помогаю выбрать сценарий, собрать документы и подать заявку без обещаний одобрения.',
        [
            ['label' => 'Обсудить ипотеку', 'url' => '/contacts/'],
            ['label' => 'Подбор объекта', 'url' => '/buyers/selection/', 'variant' => 'de-btn--white'],
        ]
    );

    return stage7_shell($hero, [
        stage7_section('Как помогаю', '', stage7_list([
            'Подбор ипотечной программы',
            'Предварительный расчёт платежа',
            'Список документов',
            'Согласование заявки с банком',
        ])),
        stage7_section('Важно', '', stage7_note('Ставки и условия зависят от банка и даты обращения. Никаких гарантий одобрения и лучших ставок без подтверждения.')),
    ]);
}

function stage7_buyers_selection_content(): string {
    $hero = stage7_hero('Подбор', 'Подбор недвижимости под ваш бюджет и критерии', 'Собираю варианты, отсеиваю лишнее и оставляю только рабочие.', [['label' => 'Оставить заявку', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Что учитываю', '', stage7_list(['Бюджет и ипотечный сценарий', 'Район, метро и инфраструктура', 'Планировка и состояние', 'Сроки выхода на сделку']))]);
}

function stage7_buyers_check_content(): string {
    $hero = stage7_hero('Проверка', 'Проверка объекта и документов до задатка', 'Смотрю, что важно знать до сделки и где могут быть риски.', [['label' => 'Проверить объект', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Что проверяю', '', stage7_list(['Документы объекта', 'Продавца и состав участников', 'Обременения и история', 'Слабые места сделки']))]);
}

function stage7_buyers_support_content(): string {
    $hero = stage7_hero('Сопровождение', 'Сопровождение сделки до регистрации', 'Провожу сделку пошагово и держу процесс под контролем.', [['label' => 'Обсудить сопровождение', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Этапы', '', stage7_list(['Подготовка документов', 'Согласование условий', 'Расчёты и подписание', 'Регистрация и передача']))]);
}

function stage7_buyers_negotiation_content(): string {
    $hero = stage7_hero('Переговоры', 'Переговоры с продавцом без лишних рисков', 'Согласование условий, сроков и компромиссов.', [['label' => 'Обсудить условия', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Как помогаю', '', stage7_list(['Отслеживаю аргументы по цене', 'Фиксирую условия в переписке', 'Помогаю не пропустить важные детали']))]);
}

function stage7_buyers_new_vs_resale_content(): string {
    $hero = stage7_hero('Сравнение', 'Новостройка или вторичка', 'Коротко о том, какой сценарий подходит под задачу.', [['label' => 'Проверить варианты', 'url' => '/buyers/catalog/']]);
    return stage7_shell($hero, [stage7_section('Сравниваю', '', stage7_list(['Сроки', 'Риски', 'Ипотеку', 'Состояние объекта', 'Потенциал перепродажи']))]);
}

function stage7_buyers_check_developer_content(): string {
    $hero = stage7_hero('Застройщик', 'Проверка застройщика', 'Смотрю документы, историю и риски перед покупкой новостройки.', [['label' => 'Обсудить застройщика', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Что проверяю', '', stage7_list(['Проектную документацию', 'Историю компании', 'Сроки и динамику', 'Что говорит публичная документация']))]);
}

function stage7_buyers_checklist_content(): string {
    $hero = stage7_hero('Чек-лист', 'Чек-лист покупки недвижимости', 'Сквозной список шагов от поиска до регистрации.', [['label' => 'Получить чек-лист', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Состав', '', stage7_list(['Поиск', 'Проверка', 'Ипотека', 'Задаток', 'Сделка', 'Регистрация']))]);
}

function stage7_about_content(): string {
    $hero = stage7_hero(
        'О специалисте',
        'Губернатчук Наталья Александровна',
        'Сайт продвигает услуги специалиста по недвижимости, а INCOM-Недвижимость используется как подтверждённая база и доверительный контекст.',
        [
            ['label' => 'Связаться', 'url' => '/contacts/'],
            ['label' => 'Материалы', 'url' => '/blog/', 'variant' => 'de-btn--white'],
        ],
        stage7_photo_placeholder('Фото специалиста разместить здесь')
    );

    return stage7_shell($hero, [
        stage7_section('Как работаю', '', stage7_list([
            'Спокойно и без давления',
            'С проверкой документов и рисков',
            'С понятным планом и сроками',
        ])),
        stage7_section('Кому удобно обращаться напрямую', '', stage7_list([
            'Если нужна продажа через личный маршрут специалиста',
            'Если нужна покупка с проверкой и сопровождением',
            'Если важно опираться на базу INCOM, но работать с конкретным человеком',
        ])),
        stage7_section('База доверия', '', stage7_grid([
            ['title' => 'INCOM офис', 'text' => 'Москва, Братиславская ул., 26.', 'url' => 'https://www.incom.ru/offices/flatsretail/21263/realtors/'],
            ['title' => 'Отзывы клиентов', 'text' => 'Публичные отзывы и рейтинг по офису и специалистам.', 'url' => 'https://www.incom.ru/otzyvy-klientov/'],
            ['title' => 'Награды и история', 'text' => 'Использую только подтверждённые факты INCOM.', 'url' => 'https://www.incom.ru/o-kompanii/nagrady/'],
        ])),
        stage7_section('Что важно на сайте', '', stage7_note('Отзывы и контактные факты привязаны к публичным источникам. На сайте нет FAQ-раздела: вопросы встраиваются в статьи и страницы услуг.')),
    ]);
}

function stage7_blog_content(): string {
    $hero = stage7_hero('Материалы', 'Материалы о недвижимости', 'Полезные статьи вместо отдельного FAQ-раздела.', [['label' => 'Для владельцев', 'url' => '/blog/sellers/'], ['label' => 'Для покупателей', 'url' => '/blog/buyers/', 'variant' => 'de-btn--white']]);
    return stage7_shell($hero, [stage7_section('Рубрики', '', stage7_grid([
        ['title' => 'Для владельцев', 'text' => 'Подготовка, документы, налоги, показы и торг.', 'url' => '/blog/sellers/'],
        ['title' => 'Для покупателей', 'text' => 'Каталог, ипотека, проверка и сопровождение.', 'url' => '/blog/buyers/'],
        ['title' => 'Ипотека', 'text' => 'Подбор программы и разбор сценариев.', 'url' => '/blog/mortgage/'],
        ['title' => 'Документы', 'text' => 'Собираем частые вопросы в одну ленту.', 'url' => '/blog/documents/'],
    ]))]);
}

function stage7_blog_sellers_content(): string {
    $hero = stage7_hero('Для владельцев', 'Статьи для владельцев', 'Практика продажи, подготовка и сделки.', [['label' => 'Владельцам', 'url' => '/sell/']]);
    return stage7_shell($hero, [stage7_section('Что будет здесь', '', stage7_list(['Оценка', 'Подготовка', 'Документы', 'Налоги', 'Показы']))]);
}

function stage7_blog_buyers_content(): string {
    $hero = stage7_hero('Для покупателей', 'Статьи для покупателей', 'Каталог, риски, ипотека и сопровождение.', [['label' => 'Покупателям', 'url' => '/buyers/']]);
    return stage7_shell($hero, [stage7_section('Что будет здесь', '', stage7_list(['Новостройки', 'Вторичка', 'Ипотека', 'Проверка', 'Сделка']))]);
}

function stage7_blog_mortgage_content(): string {
    $hero = stage7_hero('Ипотека', 'Материалы по ипотеке', 'Сценарии, документы и предварительный расчёт.', [['label' => 'Ипотека', 'url' => '/buyers/mortgage/']]);
    return stage7_shell($hero, [stage7_section('Темы', '', stage7_list(['Документы', 'Ставки и сроки', 'Предодобрение', 'Подбор банка']))]);
}

function stage7_blog_documents_content(): string {
    $hero = stage7_hero('Документы', 'Материалы по документам', 'Собираю частые вопросы в один раздел статей.', [['label' => 'Посмотреть услуги', 'url' => '/sell/documents/']]);
    return stage7_shell($hero, [stage7_section('Темы', '', stage7_list(['Продажа', 'Покупка', 'Ипотека', 'Сложные случаи']))]);
}

function stage7_reviews_content(): string {
    $hero = stage7_hero('Отзывы', 'Отзывы о работе специалиста', 'Публичные источники и согласованные отзывы без выдумки.', [['label' => 'Связаться', 'url' => '/contacts/'], ['label' => 'Офис INCOM', 'url' => 'https://www.incom.ru/offices/flatsretail/21263/realtors/', 'variant' => 'de-btn--white']]);

    return stage7_shell($hero, [
        stage7_section('Источники', '', stage7_grid([
            ['title' => 'INCOM отзывы', 'text' => '5599 отзывов на официальной странице.', 'url' => 'https://www.incom.ru/otzyvy-klientov/'],
            ['title' => 'Офис Марьино', 'text' => 'Отзывы клиентов и команда офиса на Братиславской, 26.', 'url' => 'https://www.incom.ru/offices/flatsretail/21263/realtors/'],
            ['title' => 'Яндекс Карты', 'text' => 'Публичный рейтинг 4.1 и отзывы по офису.', 'url' => 'https://yandex.ru/maps/org/inkom_nedvizhimost/1016840724/'],
        ])),
        stage7_section('Политика публикации', '', stage7_list([
            'Публикую только публичные отзывы или отзывы с согласием',
            'Не использую неподтверждённые цифры и обещания',
            'Не переношу отзывы без указания источника',
        ])),
    ]);
}

function stage7_contacts_content(): string {
    $hero = stage7_hero('Контакты', 'Связаться со специалистом', 'Москва, Братиславская ул., 26. Приём ведётся через базу INCOM-Недвижимость.', [['label' => 'Позвонить', 'url' => 'tel:+74953631629'], ['label' => 'Построить маршрут', 'url' => 'https://yandex.ru/maps/org/inkom_nedvizhimost/1016840724/', 'variant' => 'de-btn--white']], stage7_photo_placeholder('Место для фото офиса / эксперта'));

    return stage7_shell($hero, [
        stage7_section('Контактные данные', '', stage7_list([
            'Телефон: +7 (495) 363-16-29',
            'Адрес: Москва, Братиславская ул., 26',
            'Время работы: пн-пт 9:00–21:00, сб-вс 10:00–17:00',
        ])),
        stage7_section('Форма', '', stage7_note('Форма связи подключается через Fluent Forms. Отправка заявки не является договором и не гарантирует оказание услуги. Обязательно согласие на обработку персональных данных и ссылка на политику конфиденциальности.')),
    ]);
}

function stage7_legal_page_content(string $title, string $lead, array $items): string {
    $hero = stage7_hero('Legal', $title, $lead, [['label' => 'Контакты', 'url' => '/contacts/']]);
    return stage7_shell($hero, [stage7_section('Основные положения', '', stage7_list($items))]);
}

function stage7_cleanup_legacy_pages(bool $force, bool $dry_run): void {
    $legacy_paths = [
        'buyers/risk-check',
        'catalog/new',
        'compare',
        'preview-home',
    ];

    foreach ($legacy_paths as $path) {
        $page = get_page_by_path($path, OBJECT, 'page');
        if (!$page) {
            continue;
        }

        if ($dry_run) {
            echo "  dry-run delete legacy page {$path}\n";
            continue;
        }

        wp_delete_post((int) $page->ID, true);
        echo "  deleted legacy page {$path}\n";
    }
}

/* ---------------------------------------------------------------------- */
/* Build page specs                                                        */
/* ---------------------------------------------------------------------- */

$page_specs = [
    [
        'slug' => 'glavnaya',
        'path' => '/glavnaya/',
        'title' => 'Главная',
        'seo_title' => 'Губернатчук Наталья Александровна — недвижимость Москвы',
        'seo_description' => 'Специалист по недвижимости в Москве и области: продажа, покупка, проверка рисков, каталог и сопровождение сделки.',
        'content' => stage7_home_content(),
    ],
    [
        'slug' => 'sell',
        'path' => '/sell/',
        'title' => 'Владельцам',
        'seo_title' => 'Владельцам — продажа недвижимости в Москве',
        'seo_description' => 'Оценка, подготовка, показы, переговоры, налоги и альтернативные сделки для продавцов.',
        'content' => stage7_sell_content(),
    ],
    [
        'slug' => 'sell-estimate',
        'path' => '/sell/estimate/',
        'parent_slug' => 'sell',
        'title' => 'Оценка',
        'content' => stage7_sell_estimate_content(),
    ],
    [
        'slug' => 'sell-diagnostic',
        'path' => '/sell/diagnostic/',
        'parent_slug' => 'sell',
        'title' => 'Диагностика',
        'content' => stage7_sell_diagnostic_content(),
    ],
    [
        'slug' => 'sell-prepare',
        'path' => '/sell/prepare/',
        'parent_slug' => 'sell',
        'title' => 'Подготовка',
        'content' => stage7_sell_prepare_content(),
    ],
    [
        'slug' => 'sell-documents',
        'path' => '/sell/documents/',
        'parent_slug' => 'sell',
        'title' => 'Документы',
        'content' => stage7_sell_documents_content(),
    ],
    [
        'slug' => 'sell-showings',
        'path' => '/sell/showings/',
        'parent_slug' => 'sell',
        'title' => 'Показы',
        'content' => stage7_sell_showings_content(),
    ],
    [
        'slug' => 'sell-negotiation',
        'path' => '/sell/negotiation/',
        'parent_slug' => 'sell',
        'title' => 'Переговоры',
        'content' => stage7_sell_negotiation_content(),
    ],
    [
        'slug' => 'sell-taxes',
        'path' => '/sell/taxes/',
        'parent_slug' => 'sell',
        'title' => 'Налоги',
        'content' => stage7_sell_taxes_content(),
    ],
    [
        'slug' => 'sell-alternative',
        'path' => '/sell/alternative/',
        'parent_slug' => 'sell',
        'title' => 'Альтернативная сделка',
        'content' => stage7_sell_alternative_content(),
    ],
    [
        'slug' => 'buyers',
        'path' => '/buyers/',
        'title' => 'Покупателям',
        'seo_title' => 'Покупателям — подбор, ипотека и проверка недвижимости',
        'seo_description' => 'Каталог, ипотека, проверка объекта, подбор и сопровождение покупки недвижимости в Москве и области.',
        'content' => stage7_buyers_content(),
    ],
    [
        'slug' => 'buyers-catalog',
        'path' => '/buyers/catalog/',
        'parent_slug' => 'buyers',
        'title' => 'Каталог',
        'content' => stage7_buyers_catalog_content(),
    ],
    [
        'slug' => 'buyers-catalog-new',
        'path' => '/buyers/catalog/new-buildings/',
        'parent_slug' => 'buyers-catalog',
        'title' => 'Новостройки',
        'content' => stage7_buyers_catalog_new_content(),
    ],
    [
        'slug' => 'buyers-catalog-resale',
        'path' => '/buyers/catalog/resale/',
        'parent_slug' => 'buyers-catalog',
        'title' => 'Вторичка',
        'content' => stage7_buyers_catalog_resale_content(),
    ],
    [
        'slug' => 'buyers-mortgage',
        'path' => '/buyers/mortgage/',
        'parent_slug' => 'buyers',
        'title' => 'Ипотека',
        'content' => stage7_buyers_mortgage_content(),
    ],
    [
        'slug' => 'buyers-selection',
        'path' => '/buyers/selection/',
        'parent_slug' => 'buyers',
        'title' => 'Подбор',
        'content' => stage7_buyers_selection_content(),
    ],
    [
        'slug' => 'buyers-check',
        'path' => '/buyers/check/',
        'parent_slug' => 'buyers',
        'title' => 'Проверка',
        'content' => stage7_buyers_check_content(),
    ],
    [
        'slug' => 'buyers-support',
        'path' => '/buyers/support/',
        'parent_slug' => 'buyers',
        'title' => 'Сопровождение',
        'content' => stage7_buyers_support_content(),
    ],
    [
        'slug' => 'buyers-negotiation',
        'path' => '/buyers/negotiation/',
        'parent_slug' => 'buyers',
        'title' => 'Переговоры',
        'content' => stage7_buyers_negotiation_content(),
    ],
    [
        'slug' => 'buyers-new-vs-resale',
        'path' => '/buyers/new-vs-resale/',
        'parent_slug' => 'buyers',
        'title' => 'Новостройка или вторичка',
        'content' => stage7_buyers_new_vs_resale_content(),
    ],
    [
        'slug' => 'buyers-check-developer',
        'path' => '/buyers/check-developer/',
        'parent_slug' => 'buyers',
        'title' => 'Проверка застройщика',
        'content' => stage7_buyers_check_developer_content(),
    ],
    [
        'slug' => 'buyers-checklist',
        'path' => '/buyers/checklist/',
        'parent_slug' => 'buyers',
        'title' => 'Чек-лист',
        'content' => stage7_buyers_checklist_content(),
    ],
    [
        'slug' => 'about',
        'path' => '/about/',
        'title' => 'О компании',
        'seo_title' => 'О специалисте — Губернатчук Наталья Александровна',
        'seo_description' => 'Как работает специалист по недвижимости и какую роль в доверии и процессе играет база INCOM-Недвижимость.',
        'content' => stage7_about_content(),
    ],
    [
        'slug' => 'blog',
        'path' => '/blog/',
        'title' => 'Материалы',
        'seo_title' => 'Материалы о недвижимости — для владельцев и покупателей',
        'seo_description' => 'Статьи и полезные материалы о продаже, покупке, ипотеке и документах.',
        'content' => stage7_blog_content(),
    ],
    [
        'slug' => 'blog-sellers',
        'path' => '/blog/sellers/',
        'parent_slug' => 'blog',
        'title' => 'Для владельцев',
        'content' => stage7_blog_sellers_content(),
    ],
    [
        'slug' => 'blog-buyers',
        'path' => '/blog/buyers/',
        'parent_slug' => 'blog',
        'title' => 'Для покупателей',
        'content' => stage7_blog_buyers_content(),
    ],
    [
        'slug' => 'blog-mortgage',
        'path' => '/blog/mortgage/',
        'parent_slug' => 'blog',
        'title' => 'Ипотека',
        'content' => stage7_blog_mortgage_content(),
    ],
    [
        'slug' => 'blog-documents',
        'path' => '/blog/documents/',
        'parent_slug' => 'blog',
        'title' => 'Документы',
        'content' => stage7_blog_documents_content(),
    ],
    [
        'slug' => 'reviews',
        'path' => '/reviews/',
        'title' => 'Отзывы',
        'seo_title' => 'Отзывы клиентов — Губернатчук Наталья Александровна',
        'seo_description' => 'Публичные отзывы клиентов INCOM и Яндекс Карт как источник доверия и подтверждённого опыта.',
        'content' => stage7_reviews_content(),
    ],
    [
        'slug' => 'contacts',
        'path' => '/contacts/',
        'title' => 'Контакты',
        'seo_title' => 'Контакты — Губернатчук Наталья Александровна',
        'seo_description' => 'Адрес офиса, телефон, карта и форма связи со специалистом по недвижимости.',
        'content' => stage7_contacts_content(),
    ],
    [
        'slug' => 'privacy-policy',
        'path' => '/privacy-policy/',
        'title' => 'Политика конфиденциальности',
        'content' => stage7_legal_page_content(
            'Политика конфиденциальности',
            'Как обрабатываются персональные данные и зачем они нужны.',
            [
                'Собираю только данные, необходимые для связи и консультации',
                'Использую их для ответа на запрос и сопровождения сделки',
                'Передача третьим лицам только в рамках процесса и с законным основанием',
                'У клиента остаётся право запросить уточнение или удаление данных в рамках закона',
            ]
        ),
    ],
    [
        'slug' => 'cookie-policy',
        'path' => '/cookie-policy/',
        'title' => 'Cookie Policy',
        'content' => stage7_legal_page_content(
            'Cookie Policy',
            'Какие cookie и счётчики могут использоваться на сайте.',
            [
                'Технические cookie нужны для работы сайта',
                'Аналитические cookie помогают понимать поведение пользователей',
                'Пользователь может ограничить cookies в браузере',
                'При отключении части cookie часть функций может работать хуже',
            ]
        ),
    ],
    [
        'slug' => 'terms',
        'path' => '/terms/',
        'title' => 'Пользовательское соглашение',
        'content' => stage7_legal_page_content(
            'Пользовательское соглашение',
            'Правила использования сайта и материалов.',
            [
                'Материалы сайта носят информационный характер',
                'Отправка формы не создаёт договор и не гарантирует услугу',
                'Контент можно использовать только с учётом авторских прав и ссылок на источник',
                'Окончательные условия сделки фиксируются отдельно и зависят от конкретной ситуации',
            ]
        ),
    ],
];

$created_pages = [];
foreach ($page_specs as $spec) {
    $page_id = stage7_upsert_page($spec, $created_pages, $status, $force, $dry_run);
    if ($page_id) {
        $created_pages[$spec['slug']] = $page_id;
    }
}

stage7_cleanup_legacy_pages($force, $dry_run);

/* Front page */
if (!$dry_run && isset($created_pages['glavnaya'])) {
    update_option('show_on_front', 'page');
    update_option('page_on_front', (int) $created_pages['glavnaya']);
}

/* Menus */
$header_items = [
    ['key' => 'sell', 'title' => 'Владельцам', 'page_slug' => 'sell', 'url' => '/sell/'],
    ['key' => 'sell-estimate', 'title' => 'Оценка', 'page_slug' => 'sell-estimate', 'url' => '/sell/estimate/', 'parent' => 'sell'],
    ['key' => 'sell-diagnostic', 'title' => 'Диагностика', 'page_slug' => 'sell-diagnostic', 'url' => '/sell/diagnostic/', 'parent' => 'sell'],
    ['key' => 'sell-prepare', 'title' => 'Подготовка', 'page_slug' => 'sell-prepare', 'url' => '/sell/prepare/', 'parent' => 'sell'],
    ['key' => 'sell-documents', 'title' => 'Документы', 'page_slug' => 'sell-documents', 'url' => '/sell/documents/', 'parent' => 'sell'],
    ['key' => 'sell-showings', 'title' => 'Показы', 'page_slug' => 'sell-showings', 'url' => '/sell/showings/', 'parent' => 'sell'],
    ['key' => 'sell-negotiation', 'title' => 'Переговоры', 'page_slug' => 'sell-negotiation', 'url' => '/sell/negotiation/', 'parent' => 'sell'],
    ['key' => 'sell-taxes', 'title' => 'Налоги', 'page_slug' => 'sell-taxes', 'url' => '/sell/taxes/', 'parent' => 'sell'],
    ['key' => 'sell-alternative', 'title' => 'Альтернативная сделка', 'page_slug' => 'sell-alternative', 'url' => '/sell/alternative/', 'parent' => 'sell'],
    ['key' => 'buyers', 'title' => 'Покупателям', 'page_slug' => 'buyers', 'url' => '/buyers/'],
    ['key' => 'buyers-catalog', 'title' => 'Каталог', 'page_slug' => 'buyers-catalog', 'url' => '/buyers/catalog/', 'parent' => 'buyers'],
    ['key' => 'buyers-catalog-new', 'title' => 'Новостройки', 'page_slug' => 'buyers-catalog-new', 'url' => '/buyers/catalog/new-buildings/', 'parent' => 'buyers-catalog'],
    ['key' => 'buyers-catalog-resale', 'title' => 'Вторичка', 'page_slug' => 'buyers-catalog-resale', 'url' => '/buyers/catalog/resale/', 'parent' => 'buyers-catalog'],
    ['key' => 'buyers-mortgage', 'title' => 'Ипотека', 'page_slug' => 'buyers-mortgage', 'url' => '/buyers/mortgage/', 'parent' => 'buyers'],
    ['key' => 'buyers-selection', 'title' => 'Подбор', 'page_slug' => 'buyers-selection', 'url' => '/buyers/selection/', 'parent' => 'buyers'],
    ['key' => 'buyers-check', 'title' => 'Проверка', 'page_slug' => 'buyers-check', 'url' => '/buyers/check/', 'parent' => 'buyers'],
    ['key' => 'buyers-support', 'title' => 'Сопровождение', 'page_slug' => 'buyers-support', 'url' => '/buyers/support/', 'parent' => 'buyers'],
    ['key' => 'buyers-negotiation', 'title' => 'Переговоры', 'page_slug' => 'buyers-negotiation', 'url' => '/buyers/negotiation/', 'parent' => 'buyers'],
    ['key' => 'buyers-new-vs-resale', 'title' => 'Новостройка vs вторичка', 'page_slug' => 'buyers-new-vs-resale', 'url' => '/buyers/new-vs-resale/', 'parent' => 'buyers'],
    ['key' => 'buyers-check-developer', 'title' => 'Проверка застройщика', 'page_slug' => 'buyers-check-developer', 'url' => '/buyers/check-developer/', 'parent' => 'buyers'],
    ['key' => 'buyers-checklist', 'title' => 'Чек-лист', 'page_slug' => 'buyers-checklist', 'url' => '/buyers/checklist/', 'parent' => 'buyers'],
    ['key' => 'about', 'title' => 'О компании', 'page_slug' => 'about', 'url' => '/about/'],
    ['key' => 'blog', 'title' => 'Материалы', 'page_slug' => 'blog', 'url' => '/blog/'],
    ['key' => 'blog-sellers', 'title' => 'Для владельцев', 'page_slug' => 'blog-sellers', 'url' => '/blog/sellers/', 'parent' => 'blog'],
    ['key' => 'blog-buyers', 'title' => 'Для покупателей', 'page_slug' => 'blog-buyers', 'url' => '/blog/buyers/', 'parent' => 'blog'],
    ['key' => 'blog-mortgage', 'title' => 'Ипотека', 'page_slug' => 'blog-mortgage', 'url' => '/blog/mortgage/', 'parent' => 'blog'],
    ['key' => 'blog-documents', 'title' => 'Документы', 'page_slug' => 'blog-documents', 'url' => '/blog/documents/', 'parent' => 'blog'],
    ['key' => 'contacts', 'title' => 'Контакты', 'page_slug' => 'contacts', 'url' => '/contacts/'],
];

$footer_items = [
    ['key' => 'reviews', 'title' => 'Отзывы', 'page_slug' => 'reviews', 'url' => '/reviews/'],
    ['key' => 'materials', 'title' => 'Материалы', 'page_slug' => 'blog', 'url' => '/blog/'],
    ['key' => 'contacts', 'title' => 'Контакты', 'page_slug' => 'contacts', 'url' => '/contacts/'],
    ['key' => 'about', 'title' => 'О компании', 'page_slug' => 'about', 'url' => '/about/'],
];

stage7_manage_menu('Header Navigation', 'header', $header_items, $created_pages, $force, $dry_run);
stage7_manage_menu('Footer Navigation', 'footer', $footer_items, $created_pages, $force, $dry_run);

if (!$dry_run) {
    flush_rewrite_rules(false);
}

echo "STAGE7_OK\n";
