<?php
/**
 * Apply /sell/ page content per approved spec (Gate 3)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-sell-page.php
 *
 * Spec source: pages/sell/index.md (утверждён 2026-07-12)
 */

$page_id = 9; // Existing /sell/ page ID

$new_content = <<<HTML
<div class="de-shell">

<!-- Блок 1: Hero -->
<section class="de-hero" style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);padding:80px 0;text-align:center;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;">
<h1 style="font-size:42px;line-height:50px;color:#FFFFFF;font-weight:700;margin:0 0 20px;">
Продать квартиру <span style="color:#F5A623;">быстро и дорого</span> — это реально, если знать, что делать
</h1>
<p style="font-size:18px;line-height:26px;color:#CBD5E0;margin:0 0 32px;">
80% продавцов теряют деньги из-за неправильной цены, плохих фото и неподготовленного объекта. Мы знаем, как этого избежать. Бесплатно.
</p>
<a class="de-btn" href="/sell/estimate/" style="display:inline-block;background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:8px;text-decoration:none;font-weight:600;font-size:16px;">Оценить недвижимость →</a>
</div>
</section>

<!-- Блок 2: 5 ошибок -->
<section class="de-section" style="padding:64px 0;background:#FFFFFF;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;">
<h2 style="font-size:36px;line-height:44px;color:#172033;text-align:center;margin:0 0 48px;">5 ошибок, которые стоят вам денег</h2>
<div style="display:flex;flex-direction:column;gap:24px;">
<div style="display:flex;gap:16px;align-items:flex-start;">
<div style="font-size:36px;font-weight:700;color:#F5A623;line-height:1;min-width:48px;">1</div>
<div><strong style="font-size:18px;color:#172033;">Завышенная цена</strong><p style="font-size:15px;color:#4A5568;margin:4px 0 0;">Квартира висит месяцами, покупатели теряют интерес</p></div>
</div>
<div style="display:flex;gap:16px;align-items:flex-start;">
<div style="font-size:36px;font-weight:700;color:#F5A623;line-height:1;min-width:48px;">2</div>
<div><strong style="font-size:18px;color:#172033;">Плохие фото</strong><p style="font-size:15px;color:#4A5568;margin:4px 0 0;">80% покупателей не рассматривают объект без качественных снимков</p></div>
</div>
<div style="display:flex;gap:16px;align-items:flex-start;">
<div style="font-size:36px;font-weight:700;color:#F5A623;line-height:1;min-width:48px;">3</div>
<div><strong style="font-size:18px;color:#172033;">Неподготовленный объект</strong><p style="font-size:15px;color:#4A5568;margin:4px 0 0;">Запахи, бардак, старый ремонт снижают цену на 5–15%</p></div>
</div>
<div style="display:flex;gap:16px;align-items:flex-start;">
<div style="font-size:36px;font-weight:700;color:#F5A623;line-height:1;min-width:48px;">4</div>
<div><strong style="font-size:18px;color:#172033;">Слабые переговоры</strong><p style="font-size:15px;color:#4A5568;margin:4px 0 0;">Покупатель чувствует неуверенность и торгуется жёстче</p></div>
</div>
<div style="display:flex;gap:16px;align-items:flex-start;">
<div style="font-size:36px;font-weight:700;color:#F5A623;line-height:1;min-width:48px;">5</div>
<div><strong style="font-size:18px;color:#172033;">Неправильный выбор схемы</strong><p style="font-size:15px;color:#4A5568;margin:4px 0 0;">Цепочка, встречка, trade-in без понимания рисков</p></div>
</div>
</div>
<div style="text-align:center;margin-top:40px;">
<a class="de-btn" href="/sell/diagnostic/" style="display:inline-block;background:#2F7D46;color:#FFFFFF;padding:14px 28px;border-radius:12px;text-decoration:none;font-weight:600;font-size:15px;">Получить полную диагностику</a>
</div>
</div>
</section>

<!-- Блок 3: 3 шага -->
<section class="de-section" style="padding:64px 0;background:#F8F9FB;">
<div style="max-width:900px;margin:0 auto;padding:0 24px;">
<h2 style="font-size:36px;line-height:44px;color:#172033;text-align:center;margin:0 0 48px;">3 бесплатных шага к успешной продаже</h2>
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.08);text-align:center;">
<div style="font-size:24px;font-weight:700;color:#F5A623;margin-bottom:12px;">1</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Узнайте цену</h3>
<p style="font-size:14px;color:#718096;margin:0 0 16px;">Рыночная оценка вашего объекта</p>
<a href="/sell/estimate/" style="color:#2F7D46;font-weight:600;text-decoration:none;">Оценить →</a>
</div>
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.08);text-align:center;">
<div style="font-size:24px;font-weight:700;color:#F5A623;margin-bottom:12px;">2</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Проверьте фото</h3>
<p style="font-size:14px;color:#718096;margin:0 0 16px;">AI-анализ качества снимков</p>
<a href="/sell/photo-check/" style="color:#2F7D46;font-weight:600;text-decoration:none;">AI-анализ →</a>
</div>
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.08);text-align:center;">
<div style="font-size:24px;font-weight:700;color:#F5A623;margin-bottom:12px;">3</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Получите план продажи</h3>
<p style="font-size:14px;color:#718096;margin:0 0 16px;">Персональная диагностика ситуации</p>
<a href="/sell/diagnostic/" style="color:#2F7D46;font-weight:600;text-decoration:none;">Диагностика →</a>
</div>
</div>
<p style="font-size:14px;color:#718096;text-align:center;margin-top:24px;">Каждый шаг занимает 2–3 минуты. Без звонков, без обязательств.</p>
</div>
</section>

<!-- Блок 4: База знаний -->
<section class="de-section" style="padding:64px 0;background:#FFFFFF;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;">
<h2 style="font-size:36px;line-height:44px;color:#172033;text-align:center;margin:0 0 48px;">База знаний продавца</h2>
<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;">
<a href="/sell/prepare/" style="display:flex;align-items:center;gap:12px;padding:12px 16px;text-decoration:none;color:#2D3748;font-size:16px;border-radius:8px;transition:background 0.2s;" onmouseover="this.style.background='#F7F5F2'" onmouseout="this.style.background='transparent'">
<span style="font-size:20px;">📄</span> Как подготовить квартиру к продаже: чек-лист <span style="margin-left:auto;">→</span>
</a>
<a href="/sell/staging/" style="display:flex;align-items:center;gap:12px;padding:12px 16px;text-decoration:none;color:#2D3748;font-size:16px;border-radius:8px;transition:background 0.2s;" onmouseover="this.style.background='#F7F5F2'" onmouseout="this.style.background='transparent'">
<span style="font-size:20px;">📄</span> Стэйджинг: до и после с реальными примерами <span style="margin-left:auto;">→</span>
</a>
<a href="/sell/documents/" style="display:flex;align-items:center;gap:12px;padding:12px 16px;text-decoration:none;color:#2D3748;font-size:16px;border-radius:8px;transition:background 0.2s;" onmouseover="this.style.background='#F7F5F2'" onmouseout="this.style.background='transparent'">
<span style="font-size:20px;">📄</span> Полный список документов для продажи <span style="margin-left:auto;">→</span>
</a>
<a href="/sell/taxes/" style="display:flex;align-items:center;gap:12px;padding:12px 16px;text-decoration:none;color:#2D3748;font-size:16px;border-radius:8px;transition:background 0.2s;" onmouseover="this.style.background='#F7F5F2'" onmouseout="this.style.background='transparent'">
<span style="font-size:20px;">📄</span> Налоги при продаже: сколько и как платить <span style="margin-left:auto;">→</span>
</a>
<a href="/sell/negotiation/" style="display:flex;align-items:center;gap:12px;padding:12px 16px;text-decoration:none;color:#2D3748;font-size:16px;border-radius:8px;transition:background 0.2s;" onmouseover="this.style.background='#F7F5F2'" onmouseout="this.style.background='transparent'">
<span style="font-size:20px;">📄</span> Переговоры с покупателем: стратегии и тактики <span style="margin-left:auto;">→</span>
</a>
<a href="/sell/showings/" style="display:flex;align-items:center;gap:12px;padding:12px 16px;text-decoration:none;color:#2D3748;font-size:16px;border-radius:8px;transition:background 0.2s;" onmouseover="this.style.background='#F7F5F2'" onmouseout="this.style.background='transparent'">
<span style="font-size:20px;">📄</span> Как провести показ, который закончится сделкой <span style="margin-left:auto;">→</span>
</a>
<a href="/sell/alternative/" style="display:flex;align-items:center;gap:12px;padding:12px 16px;text-decoration:none;color:#2D3748;font-size:16px;border-radius:8px;transition:background 0.2s;" onmouseover="this.style.background='#F7F5F2'" onmouseout="this.style.background='transparent';grid-column:1/-1;">
<span style="font-size:20px;">📄</span> Альтернативные сделки: встречка, цепочка, trade-in <span style="margin-left:auto;">→</span>
</a>
</div>
</div>
</section>

<!-- Блок 5: Pre-footer CTA -->
<section class="de-section" style="padding:64px 0;background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);">
<div style="max-width:500px;margin:0 auto;padding:0 24px;text-align:center;">
<h2 style="font-size:32px;line-height:40px;color:#FFFFFF;margin:0 0 16px;">Готовы продавать?</h2>
<p style="font-size:16px;color:#CBD5E0;margin:0 0 32px;">Начните с бесплатной оценки. Это займёт 2 минуты.</p>
<form data-stage="2" data-action="sell_consult" style="display:flex;flex-direction:column;gap:16px;" onsubmit="return false;">

<!-- Step indicator -->
<div style="display:flex;gap:8px;justify-content:center;margin-bottom:12px;">
  <span class="step-indicator-1 active" style="width:40px;height:4px;border-radius:2px;background:#F5A623;"></span>
  <span class="step-indicator-2" style="width:40px;height:4px;border-radius:2px;background:rgba(255,255,255,0.3);"></span>
</div>

<!-- STEP 1: Вопрос -->
<div class="form-step-1">
<select name="topic" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;width:100%;">
<option value="">Какая ситуация?</option>
<option>Хочу оценить квартиру</option>
<option>Готов продавать</option>
<option>Нужна консультация</option>
<option>Другой вопрос</option>
</select>

<button type="button" class="btn-next" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:8px;border:none;font-weight:600;font-size:16px;cursor:pointer;width:100%;">
Далее →
</button>
</div>

<!-- STEP 2: Контакты (hidden) -->
<div class="form-step-2" style="display:none;">
<input type="text" name="name" placeholder="Имя" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;">
<input type="tel" name="phone" placeholder="Телефон" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;">
<label style="font-size:14px;color:#CBD5E0;display:flex;align-items:center;gap:8px;">
<input type="checkbox" required style="width:18px;height:18px;"> Я согласен на обработку персональных данных
</label>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
<button type="button" class="btn-back" style="background:rgba(255,255,255,0.15);color:#CBD5E0;padding:16px 32px;border-radius:8px;border:none;font-weight:600;font-size:16px;cursor:pointer;">
← Назад
</button>
<button type="submit" class="btn-submit" data-label="Обсудить продажу" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:8px;border:none;font-weight:600;font-size:16px;cursor:pointer;">
Обсудить продажу
</button>
</div>
</div>
</form>
<p style="font-size:12px;color:#718096;margin-top:16px;">Результат носит информационный характер</p>
</div>
</section>

</div>

<script src="/wp-content/scripts/form-handler.js"></script>
HTML;

// Update the page
$result = wp_update_post(array(
    'ID'           => $page_id,
    'post_title'   => 'Владельцам',
    'post_name'    => 'sell',
    'post_content' => $new_content,
    'post_status'  => 'publish',
), true);

if (is_wp_error($result)) {
    WP_CLI::error('Page update failed: ' . $result->get_error_message());
} else {
    WP_CLI::success("Page /sell/ (ID {$page_id}) updated successfully.");
}

// Clear cache
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
WP_CLI::line('Cache flushed.');

// Output summary
WP_CLI::line('---');
WP_CLI::line('Blocks applied:');
WP_CLI::line('  1. Hero (dark gradient + CTA)');
WP_CLI::line('  2. 5 mistakes numbered list');
WP_CLI::line('  3. 3 free steps (cards)');
WP_CLI::line('  4. Knowledge base (7 links, 2 cols)');
WP_CLI::line('  5. Pre-footer CTA (form skeleton)');
WP_CLI::line('Design tokens: navy/gold/green per spec');
WP_CLI::line('Spec: pages/sell/index.md (Gate 3 approved)');
