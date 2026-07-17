<?php
/**
 * Apply /sell/estimate/ page content per approved spec (Gate 3)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-estimate-page.php
 *
 * Spec source: pages/sell/estimate/index.md
 */

$page_id = 11;

$new_content = <<<HTML
<div class="de-shell">

<!-- Блок 1: Hero + Форма -->
<section style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);padding:80px 0;">
<div style="max-width:1100px;margin:0 auto;padding:0 24px;display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;">

<div>
<h1 style="font-size:42px;line-height:50px;color:#FFFFFF;font-weight:700;margin:0 0 20px;">
Сколько стоит ваша квартира?
</h1>
<p style="font-size:18px;line-height:26px;color:#CBD5E0;margin:0;">
Заполните форму — мы сделаем точный расчёт с учётом состояния, района и рынка. Перезвоним в течение 30 минут. Бесплатно.
</p>
</div>

<!-- Форма -->
<div style="background:#FFFFFF;border-radius:12px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.15);">
<form data-stage="2" data-action="estimate" style="display:flex;flex-direction:column;gap:16px;" onsubmit="return false;">

<!-- Step indicator -->
<div style="display:flex;gap:8px;justify-content:center;margin-bottom:12px;">
  <span class="step-indicator-1 active" style="width:40px;height:4px;border-radius:2px;background:#F5A623;"></span>
  <span class="step-indicator-2" style="width:40px;height:4px;border-radius:2px;background:#E2E8F0;"></span>
</div>

<!-- STEP 1: Параметры квартиры -->
<div class="form-step-1">
<p style="font-size:15px;font-weight:600;color:#172033;margin:0 0 4px;">Параметры квартиры</p>

<select name="building_type" required style="padding:14px 16px;border:1px solid #E2E8F0;border-radius:8px;font-size:15px;color:#172033;background:#FFFFFF;height:48px;">
<option value="">Тип дома</option>
<option>Панель</option>
<option>Монолит</option>
<option>Кирпич</option>
<option>Блочный</option>
<option>Другое</option>
</select>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
<input type="text" name="floor" placeholder="Этаж" style="padding:14px 16px;border:1px solid #E2E8F0;border-radius:8px;font-size:15px;color:#172033;height:48px;box-sizing:border-box;">
<input type="text" name="total_floors" placeholder="Этажность дома" style="padding:14px 16px;border:1px solid #E2E8F0;border-radius:8px;font-size:15px;color:#172033;height:48px;box-sizing:border-box;">
</div>

<input type="text" name="area" placeholder="Общая площадь, м²" style="padding:14px 16px;border:1px solid #E2E8F0;border-radius:8px;font-size:15px;color:#172033;height:48px;box-sizing:border-box;">

<select name="rooms" required style="padding:14px 16px;border:1px solid #E2E8F0;border-radius:8px;font-size:15px;color:#172033;background:#FFFFFF;height:48px;">
<option value="">Комнат</option>
<option>Студия</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4+</option>
</select>

<select name="condition" required style="padding:14px 16px;border:1px solid #E2E8F0;border-radius:8px;font-size:15px;color:#172033;background:#FFFFFF;height:48px;">
<option value="">Состояние</option>
<option>Требует ремонта</option>
<option>Косметический</option>
<option>Хорошее</option>
<option>Отличное</option>
</select>

<button type="button" class="btn-next" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;width:100%;">
Далее →
</button>
</div>

<!-- STEP 2: Контакты (hidden) -->
<div class="form-step-2" style="display:none;">
<p style="font-size:15px;font-weight:600;color:#172033;margin:0 0 4px;">Ваши контакты</p>

<input type="text" name="name" placeholder="Имя" required style="padding:14px 16px;border:1px solid #E2E8F0;border-radius:8px;font-size:15px;color:#172033;height:48px;box-sizing:border-box;">

<input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required style="padding:14px 16px;border:1px solid #E2E8F0;border-radius:8px;font-size:15px;color:#172033;height:48px;box-sizing:border-box;">

<label style="font-size:12px;color:#718096;display:flex;align-items:flex-start;gap:8px;cursor:pointer;">
<input type="checkbox" required style="width:16px;height:16px;margin-top:1px;cursor:pointer;">
<span>Нажимая на кнопку, вы соглашаетесь с <a href="/privacy-policy/" style="color:#2F7D46;text-decoration:underline;">Политикой обработки персональных данных</a></span>
</label>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
<button type="button" class="btn-back" style="background:#E2E8F0;color:#4A5568;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;">
← Назад
</button>
<button type="submit" class="btn-submit" data-label="Рассчитать стоимость" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;">
Рассчитать стоимость
</button>
</div>
</div>
</form>
</div>

</div>
</section>

<!-- Блок 2: Что вы получите -->
<section style="padding:80px 0;background:#F8F9FB;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;">
<h2 style="font-size:36px;line-height:44px;color:#172033;font-weight:700;text-align:center;margin:0 0 48px;">Что вы получите</h2>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
<div style="display:flex;gap:14px;align-items:flex-start;background:#FFFFFF;border-radius:12px;padding:20px;box-shadow:0 1px 4px rgba(0,0,0,0.04);">
<span style="font-size:20px;color:#2F7D46;min-width:24px;">✓</span>
<div><strong style="font-size:16px;color:#172033;">Точная стоимость</strong><p style="font-size:14px;color:#4A5568;margin:4px 0 0;">С учётом состояния и района</p></div>
</div>
<div style="display:flex;gap:14px;align-items:flex-start;background:#FFFFFF;border-radius:12px;padding:20px;box-shadow:0 1px 4px rgba(0,0,0,0.04);">
<span style="font-size:20px;color:#2F7D46;min-width:24px;">✓</span>
<div><strong style="font-size:16px;color:#172033;">Анализ конкурентов</strong><p style="font-size:14px;color:#4A5568;margin:4px 0 0;">Цены похожих объектов в вашем доме</p></div>
</div>
<div style="display:flex;gap:14px;align-items:flex-start;background:#FFFFFF;border-radius:12px;padding:20px;box-shadow:0 1px 4px rgba(0,0,0,0.04);">
<span style="font-size:20px;color:#2F7D46;min-width:24px;">✓</span>
<div><strong style="font-size:16px;color:#172033;">Рекомендации</strong><p style="font-size:14px;color:#4A5568;margin:4px 0 0;">Подготовка к продаже</p></div>
</div>
<div style="display:flex;gap:14px;align-items:flex-start;background:#FFFFFF;border-radius:12px;padding:20px;box-shadow:0 1px 4px rgba(0,0,0,0.04);">
<span style="font-size:20px;color:#2F7D46;min-width:24px;">✓</span>
<div><strong style="font-size:16px;color:#172033;">Прогноз сроков</strong><p style="font-size:14px;color:#4A5568;margin:4px 0 0;">Сколько может занять продажа</p></div>
</div>
<div style="display:flex;gap:14px;align-items:flex-start;background:#FFFFFF;border-radius:12px;padding:20px;box-shadow:0 1px 4px rgba(0,0,0,0.04);grid-column:1/-1;max-width:400px;margin:0 auto;">
<span style="font-size:20px;color:#2F7D46;min-width:24px;">✓</span>
<div><strong style="font-size:16px;color:#172033;">Честный ответ</strong><p style="font-size:14px;color:#4A5568;margin:4px 0 0;">Стоит ли делать ремонт перед продажей</p></div>
</div>
</div>
</div>
</section>

</div>
<script src="/wp-content/scripts/form-handler.js"></script>
HTML;

$result = wp_update_post(array(
    'ID'           => $page_id,
    'post_title'   => 'Оценка квартиры',
    'post_name'    => 'estimate',
    'post_content' => $new_content,
    'post_status'  => 'publish',
), true);

if (is_wp_error($result)) {
    WP_CLI::error('Page update failed: ' . $result->get_error_message());
} else {
    WP_CLI::success("Page /sell/estimate/ (ID {$page_id}) updated successfully.");
}

if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
WP_CLI::line('Cache flushed.');
WP_CLI::line('Blocks: Hero+form (2-col) + Benefits (5 items)');
WP_CLI::line('Spec: pages/sell/estimate/index.md (Gate 3)');
