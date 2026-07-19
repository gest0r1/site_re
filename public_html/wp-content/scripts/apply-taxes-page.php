<?php
/**
 * Apply /sell/taxes/ page content per approved spec (Gate 3)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-taxes-page.php
 *
 * Spec source: pages/sell/taxes/index.md
 */

$page_id = 47;

$new_content = <<<HTML
<div class="de-shell">

<!-- Hero -->
<section style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);padding:80px 0;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;text-align:center;">
<h1 style="font-size:40px;line-height:48px;color:#FFFFFF;font-weight:700;margin:0 0 16px;">
Налоги при продаже квартиры: когда платить НДФЛ и как законно уменьшить налог
</h1>
<p style="font-size:18px;line-height:26px;color:#CBD5E0;margin:0 0 16px;">
Налоги при продаже квартиры нужно считать до сделки, а не после неё. Иначе можно договориться о цене, а потом выяснить, что часть денег уйдёт на НДФЛ.
</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:600;font-size:16px;">
Получить чек-лист по налогам
</a>
</div>
</section>

<!-- Disclaimer -->
<section style="padding:32px 0 0;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">
<div style="background:#FFF8F0;border:1px solid #FEE6C9;border-radius:12px;padding:16px 20px;font-size:14px;color:#8B6F47;line-height:22px;">
<strong>⚠ Информационный характер.</strong> Статья не заменяет консультацию ФНС, юриста или налогового консультанта. Перед сделкой проверяйте актуальные нормы на nalog.gov.ru и в НК РФ. Правила актуальны на июль 2026 года.
</div>
</div>
</section>

<!-- Main content -->
<section style="padding:48px 0 64px;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">

<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0 0 16px;">Эта статья не про документы для сделки. Документы мы разобрали отдельно: <a href="/sell/documents/" style="color:#2F7D46;text-decoration:underline;">/sell/documents/</a>.</p>
<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0 0 16px;">Здесь говорим о налоговых последствиях: когда возникает НДФЛ, как работает срок владения 3/5 лет, какие есть вычеты, когда нужна декларация, как работает правило 70% кадастровой стоимости, почему опасно занижать цену в договоре.</p>

<!-- Why read before negotiations -->
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;margin-bottom:32px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 8px;">Почему эту статью нужно читать до переговоров</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Налог влияет на реальную сумму, которая останется у продавца после сделки. Например, покупатель просит скидку 300 тыс. ₽. Продавец соглашается. Но если налог не посчитан, итоговая сумма «на руках» может оказаться ниже ожидаемой ещё на сотни тысяч рублей. О переговорах — отдельная статья: <a href="/sell/negotiation/" style="color:#2F7D46;text-decoration:underline;">/sell/negotiation/</a>.</p>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 1. Сначала проверяем срок владения</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">НДФЛ не платится, если квартира находилась в собственности дольше минимального срока владения и соблюдены условия ст. 217.1 НК РФ. Минимальный срок бывает <strong>3 года</strong> или <strong>5 лет</strong>.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;margin-bottom:16px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">5 лет</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Это общий срок для большинства квартир, купленных после 1 января 2016 года.</p>
</div>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">3 года</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Трёхлетний срок может применяться, если квартира: получена по наследству от близкого родственника, подарена членом семьи, приватизирована, получена по договору ренты, является единственным жильём продавца, куплена до 1 января 2016 года.</p>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 2. Ставка зависит от резидентства и размера базы</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Для налоговых резидентов РФ с 2025 года действует прогрессивная ставка:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li><strong>13%</strong> — в пределах установленного порога.</li>
<li><strong>15%</strong> — с суммы превышения.</li>
<li>Для нерезидентов — <strong>30%</strong>.</li>
</ul>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 3. Налог считается не всегда со всей цены квартиры</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Если квартира продаётся раньше минимального срока, налог считают с дохода. Доход можно уменьшить одним из способов:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;margin-bottom:16px;">
<ol style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li><strong>Имущественный вычет до 1 000 000 ₽.</strong></li>
<li><strong>Фактические расходы на покупку квартиры</strong>, если они подтверждены документами.</li>
</ol>
</div>

<!-- Example callout -->
<div style="background:#F0F4F8;border:1px solid #E2E8F0;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 8px;">Пример</h3>
<p style="font-size:15px;color:#4A5568;margin:0 0 8px;">Квартира продана за <strong>12 млн ₽</strong>.</p>
<p style="font-size:15px;color:#4A5568;margin:0 0 4px;"><strong>Вариант А:</strong> вычет 1 млн ₽ → база <strong>11 млн ₽</strong></p>
<p style="font-size:15px;color:#4A5568;margin:0;"><strong>Вариант Б:</strong> расходы на покупку 10 млн ₽ → база <strong>2 млн ₽</strong></p>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 4. Доли и несколько продаж в одном году считаются отдельно</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Если продаётся доля, порядок применения вычета зависит от того, как оформлена сделка. Если в одном году продаётся несколько объектов, фиксированный вычет <strong>1 млн ₽</strong> применяется по правилам ст. 220 НК РФ за налоговый период. Поэтому при долях, нескольких продажах за год или совместной собственности лучше делать расчёт заранее.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 5. Кадастровая стоимость ограничивает занижение цены</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Если цена в договоре ниже 70% кадастровой стоимости на 1 января года продажи, налоговая база рассчитывается от <strong>70% кадастровой стоимости</strong>.</p>
<div style="background:#F0F4F8;border:1px solid #E2E8F0;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 8px;">Пример</h3>
<p style="font-size:15px;color:#4A5568;margin:0 0 4px;">Кадастровая стоимость — <strong>10 млн ₽</strong>. 70% кадастра = <strong>7 млн ₽</strong>.</p>
<p style="font-size:15px;color:#4A5568;margin:0;">Если в договоре указать <strong>6 млн ₽</strong>, для расчёта НДФЛ будет использоваться <strong>7 млн ₽</strong>, а не 6 млн ₽.</p>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 6. Декларация 3-НДФЛ нужна не всегда</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Если минимальный срок владения выдержан, декларация 3-НДФЛ по продаже квартиры обычно не требуется. Если срок не выдержан, нужно проверить: есть ли налог к уплате, какая база, перекрывается ли доход вычетом, нужно ли подавать декларацию.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<p style="font-size:15px;color:#4A5568;margin:0;">Обычно декларацию подают до <strong>30 апреля</strong> года, следующего за годом продажи. Налог уплачивают до <strong>15 июля</strong>. Например: квартира продана в 2026 году → декларация до 30 апреля 2027 года, налог до 15 июля 2027 года.</p>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 7. Особые случаи нужно считать отдельно</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Отдельной проверки требуют:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>наследство, дарение, продажа долей;</li>
<li>материнский капитал, ипотека;</li>
<li>альтернативная сделка, реновация;</li>
<li>единственное жильё, многодетная семья;</li>
<li>нерезидентство, продажа нескольких объектов в одном году.</li>
</ul>
</div>

<!-- Calculation callout -->
<div style="margin-top:48px;background:#F8F9FB;border-radius:12px;padding:24px 28px;">
<h3 style="font-size:18px;color:#172033;font-weight:700;margin:0 0 12px;">Расчёт: почему налог важно считать до торга</h3>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 12px;">Квартира продаётся за <strong>12 млн ₽</strong>. Куплена за <strong>10 млн ₽</strong>. Срок владения меньше минимального. Налоговая база: <strong>2 млн ₽</strong>. При ставке 13%: <strong>260 000 ₽</strong>.</p>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Если покупатель просит скидку <strong>300 000 ₽</strong>, а налог уже <strong>260 000 ₽</strong>, продавец теряет больше, чем видит в переговорах.</p>
</div>

<!-- Risks warning -->
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Риски занижения цены в договоре</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Занижение цены часто предлагают как способ уменьшить налог. Но это рискованно:</p>
<div style="background:#FFF8F0;border:1px solid #FEE6C9;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>ФНС применит правило 70% кадастровой стоимости;</li>
<li>покупатель не сможет подтвердить полную стоимость покупки;</li>
<li>банк может отказать в ипотеке или одобрить меньшую сумму;</li>
<li>при расторжении сделки в документах будет указана меньшая цена;</li>
<li>могут возникнуть налоговые вопросы и споры.</li>
</ul>
</div>

<!-- Common mistakes -->
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Частые ошибки продавца</h2>
<div style="display:grid;gap:16px;">
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">1. Считать налог после аванса</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Сначала продавец соглашается на цену, потом понимает, что налог съедает часть суммы. Правильно: считать налог до переговоров.</p>
</div>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">2. Потерять документы о покупке</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Без договора покупки, расписок и банковских документов сложнее подтвердить расходы. Тогда может остаться только фиксированный вычет 1 млн ₽.</p>
</div>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">3. Путать гражданство и налоговое резидентство</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Налоговое резидентство зависит от времени пребывания в РФ, а не только от паспорта.</p>
</div>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">4. Думать, что вычет 1 млн ₽ даётся на каждую квартиру</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Вычет применяется по правилам ст. 220 НК РФ и зависит от налогового периода и ситуации.</p>
</div>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">5. Соглашаться на занижение цены</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Это может создать больше рисков, чем экономии.</p>
</div>
</div>

<!-- When consultation needed -->
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Когда нужна консультация</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Запросите консультацию, если:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>срок владения меньше 3 или 5 лет;</li>
<li>квартира получена по наследству или дарению;</li>
<li>использовался материнский капитал;</li>
<li>квартира продаётся долями;</li>
<li>продавец не является налоговым резидентом РФ;</li>
<li>планируется альтернативная сделка;</li>
<li>покупатель предлагает занизить цену в договоре;</li>
<li>нет документов, подтверждающих расходы на покупку;</li>
<li>вы не понимаете, какой вычет выгоднее;</li>
<li>в том же году продаётся несколько объектов.</li>
</ul>
</div>

<!-- 2 options CTA -->
<div style="margin-top:64px;">
<div style="background:#F8F9FB;border-radius:12px;padding:40px 32px;">
<h2 style="font-size:28px;color:#172033;font-weight:700;text-align:center;margin:0 0 8px;">Что сделать дальше</h2>
<p style="font-size:16px;color:#4A5568;text-align:center;margin:0 0 32px;">Налоги лучше считать до переговоров, а не после подписания аванса.</p>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">📋</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Проверить налог самостоятельно</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Скачайте чек-лист и пройдите базовую проверку: срок владения, основание, вычет, расходы</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;">Получить чек-лист по налогам</a>
</div>
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">💬</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Запросить консультацию</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Если есть сложная ситуация или вы не уверены в расчёте</p>
<a href="#cta" style="display:inline-block;background:#2F7D46;color:#FFFFFF;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;">Запросить консультацию</a>
</div>
</div>
</div>
</div>

</div>
</section>

<!-- Final CTA -->
<div id="cta" style="padding:64px 0;background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);">
<div style="max-width:500px;margin:0 auto;padding:0 24px;text-align:center;">
<h2 style="font-size:28px;color:#FFFFFF;margin:0 0 12px;">Перезвоним в рабочее время и разберём вашу ситуацию за 15 минут</h2>
<p style="font-size:16px;color:#CBD5E0;margin:0 0 32px;">Без обязательств.</p>
<form data-stage="2" data-action="taxes" style="display:flex;flex-direction:column;gap:16px;" onsubmit="return false;">

<!-- Step indicator -->
<div style="display:flex;gap:8px;justify-content:center;margin-bottom:8px;">
  <span class="step-indicator-1 active" style="width:40px;height:4px;border-radius:2px;background:#F5A623;"></span>
  <span class="step-indicator-2" style="width:40px;height:4px;border-radius:2px;background:rgba(255,255,255,0.3);"></span>
</div>

<!-- STEP 1: Вопрос -->
<div class="form-step-1">
<select name="topic" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;width:100%;">
<option value="">Какая ситуация?</option>
<option>Получить чек-лист по налогам</option>
<option>Нужна консультация (сложный случай)</option>
<option>Другое</option>
</select>

<button type="button" class="btn-next" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;width:100%;">
Далее →
</button>
</div>

<!-- STEP 2: Контакты (hidden) -->
<div class="form-step-2" style="display:none;">
<input type="text" name="name" placeholder="Имя" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;">
<input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;">
<label style="font-size:11px;color:#718096;display:flex;align-items:flex-start;gap:6px;cursor:pointer;justify-content:center;">
<input type="checkbox" required style="width:14px;height:14px;margin-top:2px;cursor:pointer;">
<span>Нажимая на кнопку, вы соглашаетесь с <a href="/privacy-policy/" style="color:#2F7D46;text-decoration:underline;">Политикой обработки персональных данных</a></span>
</label>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
<button type="button" class="btn-back" style="background:rgba(255,255,255,0.15);color:#CBD5E0;padding:16px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;">
← Назад
</button>
<button type="submit" class="btn-submit" data-label="Запросить консультацию" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;">
Запросить консультацию
</button>
</div>
</div>
</form>
</div>
</div>

</div>
<script src="/wp-content/scripts/form-handler.js"></script>
HTML;

$result = wp_update_post(array(
    'ID'           => $page_id,
    'post_title'   => 'Налоги при продаже квартиры',
    'post_name'    => 'taxes',
    'post_content' => $new_content,
    'post_status'  => 'publish',
), true);

if (is_wp_error($result)) {
    WP_CLI::error('Page update failed: ' . $result->get_error_message());
} else {
    WP_CLI::success("Page /sell/taxes/ (ID {$page_id}) updated successfully.");
}

if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
WP_CLI::line('Cache flushed.');
WP_CLI::line('Blocks: Hero + Disclaimer + Intro + 7 principles + Calculation + Risks + Common mistakes + Consultation block + 2-option CTA + Final form');
WP_CLI::line('Spec: pages/sell/taxes/index.md (Gate 3)');
