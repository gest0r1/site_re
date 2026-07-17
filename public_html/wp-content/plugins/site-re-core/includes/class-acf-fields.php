<?php
/**
 * ACF Field Groups
 *
 * Регистрация полей через ACF API (требует активного ACF Pro или ACF Free).
 * Если ACF не установлен, поля не появятся — код отработает без ошибок.
 *
 * @package SiteRe_Core
 */

defined('ABSPATH') || exit;

class SiteRe_ACF_Fields {

    public static function register(): void {
        if (!function_exists('acf_add_local_field_group')) {
            return; // ACF не установлен — ничего не делаем
        }

        self::property_fields();
        self::developer_fields();
        self::review_fields();
        self::faq_fields();
        self::glossary_fields();
    }

    /* ─── Property Fields ─────────────────────── */
    private static function property_fields(): void {
        acf_add_local_field_group([
            'key'      => 'group_property_main',
            'title'    => __('Параметры объекта', 'site-re'),
            'fields'   => [
                /* Основные */
                [
                    'key'       => 'field_property_type',
                    'label'     => __('Тип', 'site-re'),
                    'name'      => 'type',
                    'type'      => 'select',
                    'required'  => true,
                    'choices'   => [
                        'new'   => __('Новостройка', 'site-re'),
                        'resale' => __('Вторичка', 'site-re'),
                    ],
                ],
                [
                    'key'       => 'field_property_status',
                    'label'     => __('Статус', 'site-re'),
                    'name'      => 'status',
                    'type'      => 'select',
                    'required'  => true,
                    'choices'   => [
                        'available'      => __('Доступно', 'site-re'),
                        'under_contract' => __('В процессе', 'site-re'),
                        'sold'           => __('Продано', 'site-re'),
                        'archived'       => __('Архив', 'site-re'),
                    ],
                ],
                [
                    'key'       => 'field_property_price',
                    'label'     => __('Цена (₽)', 'site-re'),
                    'name'      => 'price',
                    'type'      => 'number',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_property_price_per_meter',
                    'label'     => __('Цена за м² (₽)', 'site-re'),
                    'name'      => 'price_per_meter',
                    'type'      => 'number',
                ],
                [
                    'key'       => 'field_property_rooms',
                    'label'     => __('Комнат', 'site-re'),
                    'name'      => 'rooms',
                    'type'      => 'select',
                    'required'  => true,
                    'choices'   => [
                        'studio' => __('Студия', 'site-re'),
                        '1' => '1', '2' => '2', '3' => '3',
                        '4' => '4', '5+' => '5+',
                    ],
                ],
                [
                    'key'       => 'field_property_area_total',
                    'label'     => __('Общая площадь (м²)', 'site-re'),
                    'name'      => 'area_total',
                    'type'      => 'number',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_property_area_living',
                    'label'     => __('Жилая площадь (м²)', 'site-re'),
                    'name'      => 'area_living',
                    'type'      => 'number',
                ],
                [
                    'key'       => 'field_property_area_kitchen',
                    'label'     => __('Площадь кухни (м²)', 'site-re'),
                    'name'      => 'area_kitchen',
                    'type'      => 'number',
                ],
                [
                    'key'       => 'field_property_floor',
                    'label'     => __('Этаж', 'site-re'),
                    'name'      => 'floor',
                    'type'      => 'number',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_property_floors_total',
                    'label'     => __('Этажность', 'site-re'),
                    'name'      => 'floors_total',
                    'type'      => 'number',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_property_building_type',
                    'label'     => __('Тип дома', 'site-re'),
                    'name'      => 'building_type',
                    'type'      => 'select',
                    'required'  => true,
                    'choices'   => [
                        'panel'   => __('Панель', 'site-re'),
                        'monolith' => __('Монолит', 'site-re'),
                        'brick'   => __('Кирпич', 'site-re'),
                        'block'   => __('Блочный', 'site-re'),
                        'wood'    => __('Деревянный', 'site-re'),
                    ],
                ],
                [
                    'key'       => 'field_property_building_year',
                    'label'     => __('Год постройки', 'site-re'),
                    'name'      => 'building_year',
                    'type'      => 'number',
                ],
                [
                    'key'       => 'field_property_condition',
                    'label'     => __('Состояние', 'site-re'),
                    'name'      => 'condition',
                    'type'      => 'select',
                    'required'  => true,
                    'choices'   => [
                        'requires_repair' => __('Требует ремонта', 'site-re'),
                        'cosmetic'        => __('Косметический', 'site-re'),
                        'good'            => __('Хорошее', 'site-re'),
                        'excellent'       => __('Отличное', 'site-re'),
                    ],
                ],
                [
                    'key'       => 'field_property_ceiling_height',
                    'label'     => __('Высота потолков (м)', 'site-re'),
                    'name'      => 'ceiling_height',
                    'type'      => 'number',
                ],
                /* Локация */
                [
                    'key'       => 'field_property_address',
                    'label'     => __('Адрес', 'site-re'),
                    'name'      => 'address',
                    'type'      => 'text',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_property_metro_station',
                    'label'     => __('Метро', 'site-re'),
                    'name'      => 'metro_station',
                    'type'      => 'text',
                ],
                [
                    'key'       => 'field_property_metro_minutes',
                    'label'     => __('Минут до метро', 'site-re'),
                    'name'      => 'metro_minutes',
                    'type'      => 'number',
                ],
                [
                    'key'       => 'field_property_coordinates_lat',
                    'label'     => __('Широта', 'site-re'),
                    'name'      => 'coordinates_lat',
                    'type'      => 'number',
                ],
                [
                    'key'       => 'field_property_coordinates_lng',
                    'label'     => __('Долгота', 'site-re'),
                    'name'      => 'coordinates_lng',
                    'type'      => 'number',
                ],
                /* Связи */
                [
                    'key'       => 'field_property_developer',
                    'label'     => __('Застройщик', 'site-re'),
                    'name'      => 'developer',
                    'type'      => 'post_object',
                    'post_type' => ['developer'],
                    'allow_null' => true,
                ],
                [
                    'key'       => 'field_property_images',
                    'label'     => __('Фото объекта', 'site-re'),
                    'name'      => 'images',
                    'type'      => 'gallery',
                    'min'       => 1,
                    'max'       => 20,
                ],
                [
                    'key'       => 'field_property_documents',
                    'label'     => __('Документы', 'site-re'),
                    'name'      => 'documents',
                    'type'      => 'file',
                    'mime_types' => 'pdf,doc,docx',
                ],
                /* Риски */
                [
                    'key'       => 'field_property_risk_flooding',
                    'label'     => __('Риск подтопления', 'site-re'),
                    'name'      => 'risk_flooding',
                    'type'      => 'select',
                    'choices'   => [
                        'none'   => __('Нет', 'site-re'),
                        'low'    => __('Низкий', 'site-re'),
                        'medium' => __('Средний', 'site-re'),
                        'high'   => __('Высокий', 'site-re'),
                    ],
                ],
                [
                    'key'       => 'field_property_risk_noise',
                    'label'     => __('Шумовая нагрузка', 'site-re'),
                    'name'      => 'risk_noise',
                    'type'      => 'select',
                    'choices'   => [
                        'none'   => __('Нет', 'site-re'),
                        'low'    => __('Низкая', 'site-re'),
                        'medium' => __('Средняя', 'site-re'),
                        'high'   => __('Высокая', 'site-re'),
                    ],
                ],
                [
                    'key'       => 'field_property_risk_ecology',
                    'label'     => __('Экология района', 'site-re'),
                    'name'      => 'risk_ecology',
                    'type'      => 'select',
                    'choices'   => [
                        'none'   => __('Нет', 'site-re'),
                        'low'    => __('Низкая', 'site-re'),
                        'medium' => __('Средняя', 'site-re'),
                        'high'   => __('Высокая', 'site-re'),
                    ],
                ],
                [
                    'key'       => 'field_property_developer_rating',
                    'label'     => __('Рейтинг застройщика', 'site-re'),
                    'name'      => 'developer_rating',
                    'type'      => 'number',
                    'min'       => 0,
                    'max'       => 100,
                ],
                /* Даты */
                [
                    'key'       => 'field_property_sold_date',
                    'label'     => __('Дата продажи', 'site-re'),
                    'name'      => 'sold_date',
                    'type'      => 'date_picker',
                ],
                [
                    'key'       => 'field_property_listed_date',
                    'label'     => __('Дата публикации', 'site-re'),
                    'name'      => 'listed_date',
                    'type'      => 'date_picker',
                ],
                /* SEO */
                [
                    'key'       => 'field_property_seo_title',
                    'label'     => __('SEO Title', 'site-re'),
                    'name'      => 'seo_title',
                    'type'      => 'text',
                ],
                [
                    'key'       => 'field_property_seo_description',
                    'label'     => __('SEO Description', 'site-re'),
                    'name'      => 'seo_description',
                    'type'      => 'textarea',
                ],
            ],
            'location' => [
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'property',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position'   => 'acf_after_title',
            'style'      => 'default',
            'label_placement' => 'top',
        ]);
    }

    /* ─── Developer Fields ────────────────────── */
    private static function developer_fields(): void {
        acf_add_local_field_group([
            'key'      => 'group_developer_main',
            'title'    => __('Данные застройщика', 'site-re'),
            'fields'   => [
                [
                    'key'       => 'field_developer_full_name',
                    'label'     => __('Юридическое наименование', 'site-re'),
                    'name'      => 'full_name',
                    'type'      => 'text',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_developer_inn',
                    'label'     => __('ИНН', 'site-re'),
                    'name'      => 'inn',
                    'type'      => 'text',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_developer_ogrn',
                    'label'     => __('ОГРН', 'site-re'),
                    'name'      => 'ogrn',
                    'type'      => 'text',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_developer_rating',
                    'label'     => __('Рейтинг (0–100)', 'site-re'),
                    'name'      => 'rating',
                    'type'      => 'number',
                    'required'  => true,
                    'min'       => 0,
                    'max'       => 100,
                ],
                [
                    'key'       => 'field_developer_projects_total',
                    'label'     => __('Проектов всего', 'site-re'),
                    'name'      => 'projects_total',
                    'type'      => 'number',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_developer_projects_delivered',
                    'label'     => __('Сданных проектов', 'site-re'),
                    'name'      => 'projects_delivered',
                    'type'      => 'number',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_developer_projects_delayed',
                    'label'     => __('Проектов с задержками', 'site-re'),
                    'name'      => 'projects_delayed',
                    'type'      => 'number',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_developer_escrow_only',
                    'label'     => __('Только эскроу-счета', 'site-re'),
                    'name'      => 'escrow_only',
                    'type'      => 'true_false',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_developer_bankruptcy_cases',
                    'label'     => __('Дела о банкротстве', 'site-re'),
                    'name'      => 'bankruptcy_cases',
                    'type'      => 'number',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_developer_arbitration_cases',
                    'label'     => __('Арбитражные дела', 'site-re'),
                    'name'      => 'arbitration_cases',
                    'type'      => 'number',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_developer_founded_year',
                    'label'     => __('Год основания', 'site-re'),
                    'name'      => 'founded_year',
                    'type'      => 'number',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_developer_website',
                    'label'     => __('Сайт', 'site-re'),
                    'name'      => 'website',
                    'type'      => 'url',
                ],
                [
                    'key'       => 'field_developer_description',
                    'label'     => __('Описание', 'site-re'),
                    'name'      => 'description',
                    'type'      => 'wysiwyg',
                ],
                [
                    'key'       => 'field_developer_logo',
                    'label'     => __('Логотип', 'site-re'),
                    'name'      => 'logo',
                    'type'      => 'image',
                ],
                [
                    'key'       => 'field_developer_seo_title',
                    'label'     => __('SEO Title', 'site-re'),
                    'name'      => 'seo_title',
                    'type'      => 'text',
                ],
                [
                    'key'       => 'field_developer_seo_description',
                    'label'     => __('SEO Description', 'site-re'),
                    'name'      => 'seo_description',
                    'type'      => 'textarea',
                ],
            ],
            'location' => [
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'developer',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position'   => 'acf_after_title',
            'style'      => 'default',
            'label_placement' => 'top',
        ]);
    }

    /* ─── Review Fields ───────────────────────── */
    private static function review_fields(): void {
        acf_add_local_field_group([
            'key'      => 'group_review_main',
            'title'    => __('Данные отзыва', 'site-re'),
            'fields'   => [
                [
                    'key'       => 'field_review_segment',
                    'label'     => __('Сегмент', 'site-re'),
                    'name'      => 'segment',
                    'type'      => 'select',
                    'required'  => true,
                    'choices'   => [
                        'seller' => __('Продавец', 'site-re'),
                        'buyer'  => __('Покупатель', 'site-re'),
                    ],
                ],
                [
                    'key'       => 'field_review_deal_type',
                    'label'     => __('Тип сделки', 'site-re'),
                    'name'      => 'deal_type',
                    'type'      => 'select',
                    'required'  => true,
                    'choices'   => [
                        'sale'     => __('Продажа', 'site-re'),
                        'purchase' => __('Покупка', 'site-re'),
                        'exchange' => __('Обмен', 'site-re'),
                    ],
                ],
                [
                    'key'       => 'field_review_client_name',
                    'label'     => __('Имя клиента', 'site-re'),
                    'name'      => 'client_name',
                    'type'      => 'text',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_review_quote',
                    'label'     => __('Текст отзыва', 'site-re'),
                    'name'      => 'quote',
                    'type'      => 'textarea',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_review_rating',
                    'label'     => __('Оценка (1–5)', 'site-re'),
                    'name'      => 'rating',
                    'type'      => 'number',
                    'required'  => true,
                    'min'       => 1,
                    'max'       => 5,
                ],
                [
                    'key'       => 'field_review_consent_given',
                    'label'     => __('Согласие на публикацию', 'site-re'),
                    'name'      => 'consent_given',
                    'type'      => 'true_false',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_review_published_date',
                    'label'     => __('Дата публикации', 'site-re'),
                    'name'      => 'published_date',
                    'type'      => 'date_picker',
                    'required'  => true,
                ],
            ],
            'location' => [
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'review',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position'   => 'acf_after_title',
            'style'      => 'default',
            'label_placement' => 'top',
        ]);
    }

    /* ─── FAQ Fields ──────────────────────────── */
    private static function faq_fields(): void {
        acf_add_local_field_group([
            'key'      => 'group_faq_main',
            'title'    => __('Вопрос-ответ', 'site-re'),
            'fields'   => [
                [
                    'key'       => 'field_faq_question',
                    'label'     => __('Вопрос', 'site-re'),
                    'name'      => 'question',
                    'type'      => 'text',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_faq_answer',
                    'label'     => __('Ответ', 'site-re'),
                    'name'      => 'answer',
                    'type'      => 'wysiwyg',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_faq_segment',
                    'label'     => __('Для кого', 'site-re'),
                    'name'      => 'segment',
                    'type'      => 'select',
                    'required'  => true,
                    'choices'   => [
                        'seller' => __('Продавец', 'site-re'),
                        'buyer'  => __('Покупатель', 'site-re'),
                        'both'   => __('Обе аудитории', 'site-re'),
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'faq',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position'   => 'acf_after_title',
            'style'      => 'default',
            'label_placement' => 'top',
        ]);
    }

    /* ─── Glossary Fields ─────────────────────── */
    private static function glossary_fields(): void {
        acf_add_local_field_group([
            'key'      => 'group_glossary_main',
            'title'    => __('Термин', 'site-re'),
            'fields'   => [
                [
                    'key'       => 'field_glossary_term',
                    'label'     => __('Термин', 'site-re'),
                    'name'      => 'term',
                    'type'      => 'text',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_glossary_definition',
                    'label'     => __('Определение', 'site-re'),
                    'name'      => 'definition',
                    'type'      => 'wysiwyg',
                    'required'  => true,
                ],
                [
                    'key'       => 'field_glossary_segment',
                    'label'     => __('Для кого', 'site-re'),
                    'name'      => 'segment',
                    'type'      => 'select',
                    'required'  => true,
                    'choices'   => [
                        'seller' => __('Продавец', 'site-re'),
                        'buyer'  => __('Покупатель', 'site-re'),
                        'both'   => __('Обе аудитории', 'site-re'),
                    ],
                ],
                [
                    'key'       => 'field_glossary_related_posts',
                    'label'     => __('Связанные статьи', 'site-re'),
                    'name'      => 'related_posts',
                    'type'      => 'relationship',
                    'post_type' => ['post'],
                    'allow_null' => true,
                    'filters'    => ['search'],
                ],
                [
                    'key'       => 'field_glossary_related_glossary',
                    'label'     => __('Связанные термины', 'site-re'),
                    'name'      => 'related_glossary',
                    'type'      => 'relationship',
                    'post_type' => ['glossary'],
                    'allow_null' => true,
                    'filters'    => ['search'],
                ],
                [
                    'key'       => 'field_glossary_abbreviation',
                    'label'     => __('Расшифровка аббревиатуры', 'site-re'),
                    'name'      => 'abbreviation',
                    'type'      => 'text',
                ],
            ],
            'location' => [
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'glossary',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position'   => 'acf_after_title',
            'style'      => 'default',
            'label_placement' => 'top',
        ]);
    }
}
