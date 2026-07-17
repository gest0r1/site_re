<?php
/**
 * Apply /sell/diagnostic/ page content per approved spec (Gate 3)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-diagnostic-page.php
 *
 * Spec source: pages/sell/diagnostic/index.md
 */

$page_id = 42;

$new_content = <<<HTML
<div class="de-shell">

<!-- Hero -->
<section style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);padding:80px 0;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;text-align:center;">
<h1 style="font-size:44px;line-height:52px;color:#FFFFFF;font-weight:700;margin:0 0 16px;">
10 точек, где продавец теряет деньги при продаже квартиры
</h1>
<p style="font-size:18px;line-height:26px;color:#CBD5E0;margin:0 0 32px;">
Экономия на агенте может оказаться меньше потерь от ошибок в цене, сроках, подготовке, документах и торге.
</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:600;font-size:16px;">Разобрать продажу с экспертом</a>
<p style="font-size:14px;color:#718096;margin:16px 0 0;">
<a href="#point-1" style="color:#CBD5E0;">Сначала прочитать статью ↓</a>
</p>
</div>
</section>

<!-- Intro -->
<section style="padding:64px 0;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;font-size:17px;line-height:28px;color:#2D3748;">
<p>Продать квартиру самостоятельно кажется выгодным: не нужно платить комиссию агенту. Но на практике экономия часто исчезает в другом месте — в сроках, торге, слабой подготовке, ошибках в документах и неверной стартовой стратегии.</p>
<p>Комиссия агента обычно обсуждается индивидуально. На вторичном рынке часто встречается ориентир <strong>2–3% от цены сделки</strong>. Но ошибка в цене, срочная скидка или слабые переговоры могут стоить <strong>5–15% и больше</strong>.</p>
<p>Поэтому главный вопрос не «платить агенту или нет». Главный вопрос другой:</p>
<blockquote style="font-size:19px;font-style:italic;color:#172033;border-left:4px solid #F5A623;padding:16px 24px;margin:24px 0;background:#F8F9FB;border-radius:8px;">
Где вы потеряете больше — на комиссии или на ошибках?
</blockquote>
<p>Ниже — 10 точек, где продавцы чаще всего теряют деньги.</p>
</div>
</section>

<!-- 10 points -->
<section style="padding:0 0 64px;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">

<!-- Point 1 -->
<div id="point-1" style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 12px;">1. Завышенная стартовая цена</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Завышенная цена опасна не тем, что её потом придётся снижать. Коррекция цены — нормальная часть рынка. Главная потеря в другом: <strong>ошибка в стартовой цене ломает тайминг продажи</strong>.</p>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Первые 2–3 недели после публикации объявление получает максимум внимания. Если цена выше рынка на 10–15%, покупатели просто уходят к конкурентам.</p>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Дальше запускается цепочка: объявление стареет → просмотров меньше → звонков меньше → цена снижается уже после паузы → торг жёстче → продажа затягивается — и продавец может потерять встречный объект.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;margin:16px 0;">
<p style="font-size:14px;color:#667085;margin:0 0 8px;"><strong>Пример расчёта</strong></p>
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;">Квартира <strong>12 000 000 ₽</strong>. Завышенная цена → 2 месяца потери времени. Альтернативная доходность 12% годовых: <strong style="color:#F5A623;">240 000 ₽</strong>. Скидка 2–3% после старения: ещё <strong style="color:#F5A623;">240 000–360 000 ₽</strong>. Итого: <strong style="color:#F5A623;">480 000–600 000 ₽</strong>.</p>
</div>
</div>

<!-- Point 2 -->
<div id="point-2" style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 12px;">2. Срочная продажа и слишком большой дисконт</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Вторая крайность — продать быстро любой ценой. Срочность почти всегда считывается покупателем как слабая позиция.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;margin:16px 0;">
<p style="font-size:14px;color:#667085;margin:0 0 8px;"><strong>Пример расчёта</strong></p>
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;">Квартира <strong>12 000 000 ₽</strong>. Скидка 10% при срочной продаже: <strong style="color:#F5A623;">1 200 000 ₽</strong>.</p>
</div>
</div>

<!-- Point 3 -->
<div id="point-3" style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 12px;">3. Долгая продажа — это тоже потеря денег</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Пока квартира продаётся, владелец платит ипотеку, коммуналку, налоги. А деньги от продажи не работают.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;margin:16px 0;">
<p style="font-size:14px;color:#667085;margin:0 0 8px;"><strong>Пример расчёта</strong></p>
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;">Квартира <strong>12 000 000 ₽</strong>. 3 месяца лишней продажи. Упущенная доходность 12% годовых: <strong style="color:#F5A623;">360 000 ₽</strong>.</p>
</div>
<p style="font-size:15px;color:#667085;margin:16px 0 0;">Не уверены в цене? <a href="#cta" style="color:#2F7D46;font-weight:600;">Разберите стратегию до публикации →</a></p>
</div>

<!-- Point 4 -->
<div id="point-4" style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 12px;">4. Плохая подготовка квартиры</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Покупатель редко оценивает квартиру только рационально. Запахи, беспорядок, тёмные комнаты, лишняя мебель — всё это провоцирует торг.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;margin:16px 0;">
<p style="font-size:14px;color:#667085;margin:0 0 8px;"><strong>Пример расчёта</strong></p>
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;">Квартира <strong>12 000 000 ₽</strong>. Слабый вид → дополнительный торг 2–3%: <strong style="color:#F5A623;">240 000–360 000 ₽</strong>. Базовая подготовка (30–80 тыс.) может быть выгоднее скидки.</p>
</div>
</div>

<!-- Point 5 -->
<div id="point-5" style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 12px;">5. Некачественные фотографии</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Первый показ квартиры происходит не в квартире, а на экране телефона. Плохие фото = меньше кликов, звонков, показов и слабее позиция в торге. Зарубежное исследование Redfin показывало, что объекты с профессиональными фото продавались на 32% быстрее — это данные не российского рынка, но логика универсальна.</p>
</div>

<!-- Point 6 -->
<div id="point-6" style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 12px;">6. Слабое объявление и неверная упаковка</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Объявление должно отвечать на вопросы покупателя до звонка. Слабая упаковка → торг.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;margin:16px 0;">
<p style="font-size:14px;color:#667085;margin:0 0 8px;"><strong>Пример</strong></p>
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;">Дополнительный торг всего 2% из-за слабой упаковки: <strong style="color:#F5A623;">240 000 ₽</strong>.</p>
</div>
</div>

<!-- Point 7 -->
<div id="point-7" style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 12px;">7. Ошибки на показах</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Показ — это переговоры ещё до обсуждения цены. Продавец может сам обесценить квартиру: извиняться за ремонт, говорить о срочности, не знать ответов на вопросы.</p>
</div>

<!-- Point 8 -->
<div id="point-8" style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 12px;">8. Неподготовленные документы</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Если документы не готовы, покупатель видит риск. Риск превращается в паузу, торг или отказ.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;margin:16px 0;">
<p style="font-size:14px;color:#667085;margin:0 0 8px;"><strong>Пример расчёта</strong></p>
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;">Задержка сделки из-за документов может стоить <strong style="color:#F5A623;">240 000–360 000 ₽</strong>.</p>
</div>
<p style="font-size:15px;color:#667085;margin:16px 0 0;">Проверьте документы и риски до показа. <a href="#cta" style="color:#2F7D46;font-weight:600;">Получить консультацию →</a></p>
</div>

<!-- Point 9 -->
<div id="point-9" style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 12px;">9. Неправильный торг</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Продавец либо боится потерять покупателя и уступает слишком много, либо не уступает вовсе. Оба сценария ведут к потерям. Стратегия торга должна быть готова до первого показа.</p>
</div>

<!-- Point 10 -->
<div id="point-10" style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 12px;">10. Ошибки в альтернативной сделке</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Продажа часто не заканчивается получением денег. Встречная покупка, ипотека, раздел имущества — в альтернативной сделке ошибка в сроках может стоить дорого: потеря задатка, уход покупателя, развал цепочки.</p>
</div>

<!-- Summary table -->
<div style="padding:32px 0;border-top:1px solid #E2E8F0;">
<h2 style="font-size:24px;color:#172033;font-weight:700;margin:0 0 20px;">Расчёт: как ошибки могут съесть больше комиссии</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Квартира <strong>12 000 000 ₽</strong>. Комиссия агента 2,5%: <strong>300 000 ₽</strong>.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;overflow-x:auto;">
<table style="width:100%;border-collapse:collapse;font-size:15px;color:#2D3748;">
<thead><tr style="border-bottom:2px solid #E2E8F0;">
<th style="text-align:left;padding:8px 12px;">Ошибка</th>
<th style="text-align:right;padding:8px 12px;">Возможная потеря</th>
</tr></thead>
<tbody>
<tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:8px 12px;">Неверная стартовая стратегия + 2 месяца</td><td style="padding:8px 12px;text-align:right;"><strong style="color:#F5A623;">240 000 ₽</strong></td></tr>
<tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:8px 12px;">Скидка 2–3% после старения</td><td style="padding:8px 12px;text-align:right;"><strong style="color:#F5A623;">240 000–360 000 ₽</strong></td></tr>
<tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:8px 12px;">Срочная скидка 10%</td><td style="padding:8px 12px;text-align:right;"><strong style="color:#F5A623;">1 200 000 ₽</strong></td></tr>
<tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:8px 12px;">3 месяца лишней продажи</td><td style="padding:8px 12px;text-align:right;"><strong style="color:#F5A623;">360 000 ₽</strong></td></tr>
<tr style="border-bottom:1px solid #E2E8F0;"><td style="padding:8px 12px;">Слабая подготовка + доп. торг</td><td style="padding:8px 12px;text-align:right;"><strong style="color:#F5A623;">240 000–360 000 ₽</strong></td></tr>
<tr><td style="padding:8px 12px;">Ошибки в документах</td><td style="padding:8px 12px;text-align:right;"><strong style="color:#F5A623;">240 000–360 000 ₽</strong></td></tr>
</tbody>
</table>
</div>
<p style="font-size:14px;color:#667085;margin:16px 0 0;"><em>Расчёты приведены как пример. Итоговая цена, срок продажи и размер торга зависят от объекта, рынка и условий сделки.</em></p>
</div>

<!-- Final CTA -->
<div id="cta" style="padding:48px 0;border-top:1px solid #E2E8F0;">
<div style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);border-radius:12px;padding:48px 32px;text-align:center;">
<h2 style="font-size:28px;color:#FFFFFF;margin:0 0 12px;">Перед тем как снижать цену — разберите ситуацию с экспертом</h2>
<p style="font-size:16px;color:#CBD5E0;margin:0 0 32px;">На консультации покажем: где вы теряете деньги, какая цена реалистична, нужна ли подготовка и как выстроить торг.</p>
<form data-stage="2" data-action="diagnostic" style="max-width:400px;margin:0 auto;display:flex;flex-direction:column;gap:16px;" onsubmit="return false;">

<!-- Step indicator -->
<div style="display:flex;gap:8px;justify-content:center;margin-bottom:8px;">
  <span class="step-indicator-1 active" style="width:40px;height:4px;border-radius:2px;background:#F5A623;"></span>
  <span class="step-indicator-2" style="width:40px;height:4px;border-radius:2px;background:rgba(255,255,255,0.3);"></span>
</div>

<!-- STEP 1: Вопрос -->
<div class="form-step-1">
<textarea name="question" placeholder="Опишите вашу ситуацию (район, тип квартиры, срочность)" rows="2" style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;width:100%;box-sizing:border-box;resize:vertical;font-family:inherit;"></textarea>

<button type="button" class="btn-next" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;width:100%;">Далее →</button>
</div>

<!-- STEP 2: Контакты (hidden) -->
<div class="form-step-2" style="display:none;">
<input type="text" name="name" placeholder="Имя" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;">
<input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;">
<label style="font-size:13px;color:#CBD5E0;display:flex;align-items:center;gap:8px;justify-content:center;cursor:pointer;"><input type="checkbox" required style="width:16px;height:16px;cursor:pointer;">Согласен на обработку <a href="/privacy-policy/" style="color:#F5A623;text-decoration:underline;">персональных данных</a></label>
<div style="display:flex;gap:8px;">
<button type="button" class="btn-back" style="background:rgba(255,255,255,0.15);color:#CBD5E0;padding:16px 24px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;white-space:nowrap;">← Назад</button><button type="submit" class="btn-submit" data-label="Разобрать продажу с экспертом" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;flex:1;">Разобрать продажу с экспертом</button>
</div>
</div>
</form>
<p style="font-size:14px;color:#718096;margin:16px 0 0;">Перезвоним в рабочее время и обсудим вашу ситуацию.</p>
</div>
</div>

</div>
</section>

</div>

<script src="/wp-content/scripts/form-handler.js"></script>
HTML;

$result = wp_update_post(array(
    'ID'           => $page_id,
    'post_title'   => 'Диагностика потерь при продаже',
    'post_name'    => 'diagnostic',
    'post_content' => $new_content,
    'post_status'  => 'publish',
), true);

if (is_wp_error($result)) {
    WP_CLI::error('Page update failed: ' . $result->get_error_message());
} else {
    WP_CLI::success("Page /sell/diagnostic/ (ID {$page_id}) updated successfully.");
}

if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
WP_CLI::line('Cache flushed.');
WP_CLI::line('Blocks: Hero + Intro + 10 points + Summary table + CTA form');
WP_CLI::line('Spec: pages/sell/diagnostic/index.md (Gate 3)');
