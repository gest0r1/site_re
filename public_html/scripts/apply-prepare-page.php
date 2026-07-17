<?php
/**
 * Apply /sell/prepare/ page content per approved spec (Gate 3)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-prepare-page.php
 *
 * Spec source: pages/sell/prepare/index.md
 */

$page_id = 43;

$new_content = <<<HTML
<div class="de-shell">

<!-- Hero -->
<section style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);padding:80px 0;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;text-align:center;">
<h1 style="font-size:44px;line-height:52px;color:#FFFFFF;font-weight:700;margin:0 0 16px;">
Как подготовить квартиру к продаже без лишнего ремонта
</h1>
<p style="font-size:18px;line-height:26px;color:#CBD5E0;margin:0 0 16px;">
Подготовка — это не ремонт ради ремонта, а управление первым впечатлением и количеством поводов для торга.
</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:600;font-size:16px;">
Получить чек-лист подготовки
</a>
</div>
</section>

<!-- Intro -->
<section style="padding:64px 0;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">
<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0 0 16px;">Перед продажей квартиры легко ошибиться в обе стороны.</p>
<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0 0 16px;">Можно ничего не делать и выйти на рынок «как есть». Тогда покупатель видит не потенциал, а запахи, тёмные комнаты, старый санузел, личные вещи и мелкие дефекты. В лучшем случае он просит скидку <strong>3–5% «за состояние»</strong>. В худшем — просто уходит к другому объявлению.</p>
<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0;">Можно сделать наоборот: вложиться в дорогой ремонт, мебель и технику. Но покупатель может не оценить ваш вкус и не добавить эти вложения к цене.</p>
</div>
</section>

<!-- 8 Principles -->
<section style="padding:0 0 64px;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">

<div style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:0 0 12px;">Принцип 1. Подготовка продаёт не ремонт, а снижение риска</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Покупатель мысленно считает будущие расходы. Чем больше неизвестных, тем сильнее желание торговаться. Задача подготовки — убрать дешёвые, но заметные причины недоверия.</p>
</div>

<div style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:0 0 12px;">Принцип 2. Первое впечатление быстрее документов</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Человек заходит в квартиру и за первые минуты решает, хочет он здесь жить или нет. Клининг, проветривание, вывоз лишнего и свет важнее дорогого декора.</p>
</div>

<div style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:0 0 12px;">Принцип 3. Дорогой ремонт ≠ рост цены</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Покупатель может не захотеть платить за ваш вкус. Безопаснее исправить очевидные дефекты, чем делать ремонт «на свой вкус».</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<p style="font-size:14px;color:#667085;margin:0 0 8px;"><strong>Пример</strong></p>
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;">Ремонт за <strong>1 000 000 ₽</strong> не означает, что квартиру удастся продать на 1 млн дороже. А подготовка за <strong>30–80 тыс. ₽</strong> может быть разумнее, если она убирает главные поводы для торга.</p>
</div>
</div>

<div style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:0 0 12px;">Принцип 4. Подготовка должна работать на фото</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Первый показ квартиры происходит не в квартире, а в объявлении. Готовить квартиру нужно не только «для прихода покупателя», но и для камеры.</p>
</div>

<div style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:0 0 12px;">Принцип 5. Уборка важнее декора</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Декор не спасает грязную квартиру. Если бюджет ограничен, начинать нужно не с декора, а с клининга.</p>
</div>

<div style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:0 0 12px;">Принцип 6. Нейтральность расширяет круг покупателей</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Яркий интерьер может понравиться одному и оттолкнуть десятерых. Нейтральная квартира — светлые поверхности, минимум личных вещей, свободное пространство.</p>
</div>

<div style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:0 0 12px;">Принцип 7. Подготовка — это стратегия торга</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Слабая подготовка даёт покупателю готовые аргументы для скидки.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<p style="font-size:14px;color:#667085;margin:0 0 8px;"><strong>Расчёт</strong></p>
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;">Квартира <strong>12 000 000 ₽</strong>. Скидка 3–5% «за состояние»: <strong style="color:#F5A623;">360 000–600 000 ₽</strong>. Подготовка не гарантирует продажу дороже, но убирает причины для скидки.</p>
</div>
</div>

<div style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:0 0 12px;">Принцип 8. Сначала считаем, потом тратим</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Действия делятся на три группы: обязательно, желательно, не делать. Задача агента — выбрать действия с максимальным эффектом и минимальными лишними расходами.</p>
</div>

</div>
</section>

<!-- 2 options CTA -->
<section style="padding:0 0 64px;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">
<div style="background:#F8F9FB;border-radius:12px;padding:40px 32px;">
<h2 style="font-size:28px;color:#172033;font-weight:700;text-align:center;margin:0 0 8px;">Что сделать дальше</h2>
<p style="font-size:16px;color:#4A5568;text-align:center;margin:0 0 32px;">Подготовка — это выбор действий, которые помогают убрать причины для скидки.</p>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">📋</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Подготовить самостоятельно</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Скачайте чек-лист и проверьте квартиру по зонам</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;">Получить чек-лист</a>
</div>
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">💬</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Разобрать квартиру с агентом</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Покажем, какие 3–5 действий дадут максимум эффекта</p>
<a href="#cta" style="display:inline-block;background:#2F7D46;color:#FFFFFF;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;">Записаться на консультацию</a>
</div>
</div>
</div>
</div>
</section>

<!-- Final CTA -->
<div id="cta" style="padding:64px 0;background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);">
<div style="max-width:500px;margin:0 auto;padding:0 24px;text-align:center;">
<h2 style="font-size:28px;color:#FFFFFF;margin:0 0 12px;">Перед тем как тратить деньги — разберите квартиру с агентом</h2>
<p style="font-size:16px;color:#CBD5E0;margin:0 0 32px;">Перезвоним в рабочее время и разберём вашу ситуацию за 15 минут.</p>
<form style="display:flex;flex-direction:column;gap:16px;" onsubmit="alert('Форма отправки будет подключена позже');return false;">
<input type="text" name="name" placeholder="Имя" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;">
<input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;">
<label style="font-size:13px;color:#CBD5E0;display:flex;align-items:center;gap:8px;justify-content:center;cursor:pointer;">
<input type="checkbox" required style="width:16px;height:16px;cursor:pointer;">
Согласен на обработку <a href="/privacy-policy/" style="color:#F5A623;text-decoration:underline;">персональных данных</a>
</label>
<button type="submit" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;">
Записаться на консультацию
</button>
</form>
</div>
</div>

</div>
HTML;

$result = wp_update_post(array(
    'ID'           => $page_id,
    'post_title'   => 'Подготовка квартиры к продаже',
    'post_name'    => 'prepare',
    'post_content' => $new_content,
    'post_status'  => 'publish',
), true);

if (is_wp_error($result)) {
    WP_CLI::error('Page update failed: ' . $result->get_error_message());
} else {
    WP_CLI::success("Page /sell/prepare/ (ID {$page_id}) updated successfully.");
}

if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
WP_CLI::line('Cache flushed.');
WP_CLI::line('Blocks: Hero + Intro + 8 principles + 2-option CTA + Final form');
WP_CLI::line('Spec: pages/sell/prepare/index.md (Gate 3)');
HTML;
