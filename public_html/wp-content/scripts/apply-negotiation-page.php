<?php
/**
 * Apply /sell/negotiation/ page content per approved spec (Gate 3)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-negotiation-page.php
 *
 * Spec source: pages/sell/negotiation/index.md
 */

$page_id = 46;

$new_content = <<<HTML
<div class="de-shell">

<!-- Hero -->
<section style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);padding:80px 0;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;text-align:center;">
<h1 style="font-size:40px;line-height:48px;color:#FFFFFF;font-weight:700;margin:0 0 16px;">
Переговоры с покупателем: как обсуждать цену и условия сделки, не уступая лишнего
</h1>
<p style="font-size:18px;line-height:26px;color:#CBD5E0;margin:0 0 16px;">
Переговоры — это не только скидка, но и аванс, сроки, мебель, расчёты, документы и фиксация условий. Деньги теряются не только в скидке, но и в слабом авансе и устных обещаниях.
</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:600;font-size:16px;">
Получить чек-лист переговоров
</a>
</div>
</section>

<!-- Disclaimer -->
<section style="padding:32px 0 0;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">
<div style="background:#FFF8F0;border:1px solid #FEE6C9;border-radius:12px;padding:16px 20px;font-size:14px;color:#8B6F47;line-height:22px;">
<strong>⚠ Информационный характер.</strong> Статья не заменяет юридическую консультацию. Условия аванса, задатка, расчётов и договора лучше проверять с юристом или нотариусом.
</div>
</div>
</section>

<!-- Main content -->
<section style="padding:48px 0 64px;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">

<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0 0 16px;">Переговоры начинаются тогда, когда покупатель уже заинтересовался и переходит к условиям: цена, скидка, аванс, сроки, мебель, техника, форма расчётов, ипотека, документы и освобождение квартиры.</p>
<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0;">Ошибка продавца — думать, что переговоры сводятся к фразе «скинете или нет». На практике деньги теряются не только в скидке, но и в слабом авансе, неудобных сроках, устных обещаниях, рискованной форме расчётов и плохо зафиксированных договорённостях.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 1. До переговоров нужно знать свою нижнюю границу</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Нельзя входить в переговоры с мыслью: «посмотрим, сколько дадут». Так продавец начинает принимать решения под давлением. До разговора о цене нужно определить три цифры:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ol style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li><strong>Желаемая цена</strong> — по которой вы хотите продать.</li>
<li><strong>Рабочая цена</strong> — компромисс, который всё ещё вас устраивает.</li>
<li><strong>Нижняя граница</strong> — цена, ниже которой сделка теряет смысл.</li>
</ol>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 2. Скидка должна обмениваться на условие</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Главное правило: не уступайте просто так. Если покупатель просит скидку, спрашивайте, что он готов дать взамен: быстрее внести аванс, выйти на сделку в удобный срок, взять квартиру без мебели, согласиться на вашу дату освобождения, использовать безопасную форму расчётов, зафиксировать договорённости письменно.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;"><strong>Лучше:</strong> Готовы обсуждать такую цену, если вы вносите аванс до пятницы и выходим на сделку в течение двух недель.</p>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 3. Не называйте скидку первым</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">На вопрос «сколько уступите?» не нужно сразу называть сумму. Лучше: «Цена сформирована с учётом рынка. Если квартира вам подходит, предложите ваши условия — сумму, срок сделки и форму расчётов. Мы рассмотрим предложение целиком.» Так вы переводите разговор с одной цифры на пакет условий.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 4. Переговоры идут не только о цене</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Обсуждаются: цена, сумма аванса или задатка, срок выхода на сделку, дата освобождения квартиры, мебель и техника, форма расчётов, ипотека покупателя, кто оплачивает нотариуса, оценку, банковские комиссии, что фиксируется в предварительном договоре.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;">Иногда меньшая скидка с сильным авансом и понятными сроками выгоднее, чем высокая цена без обязательств.</p>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 5. Аванс, задаток и обеспечительный платёж — не одно и то же</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">На бытовом уровне эти слова часто смешивают. Юридически последствия могут отличаться:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li><strong>Аванс</strong> обычно возвращается, если сделка не состоялась.</li>
<li><strong>Задаток</strong> имеет обеспечительную функцию и регулируется ГК РФ.</li>
<li><strong>Обеспечительный платёж</strong> может использоваться для гибкой фиксации условий.</li>
</ul>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 6. Устные договорённости нужно переводить в письменные</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Опасные устные обещания: «оставим всю мебель», «освободим квартиру через неделю», «скидка сохранится до конца месяца», «цена в договоре будет ниже фактической». Всё существенное должно фиксироваться письменно: цена, срок, аванс/задаток, расчёты, мебель, дата передачи, ответственность сторон.</p>
<div style="background:#FFF8F0;border:1px solid #FEE6C9;border-radius:12px;padding:16px 20px;">
<p style="font-size:14px;color:#8B6F47;margin:0;">Особенно осторожно с предложением занизить цену в договоре. Это может создать налоговые и юридические риски для сторон.</p>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 7. Не соглашайтесь на снятие объявления без обязательств</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Покупатель может сказать: «Снимите объявление, я точно куплю». Если за этим нет аванса, срока и письменной договорённости, продавец берёт риск на себя. Безопаснее: «Готовы зафиксировать договорённости после аванса и согласования сроков.»</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 8. Пауза — нормальный инструмент переговоров</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Не обязательно отвечать сразу на каждое предложение. Если покупатель давит сроками или эмоциями, можно взять паузу: «Нам нужно обсудить условия и проверить сроки. Вернёмся с ответом сегодня вечером.» Пауза помогает не уступить на эмоциях.</p>

<!-- Calculation callout -->
<div style="margin-top:48px;background:#F8F9FB;border-radius:12px;padding:24px 28px;">
<h3 style="font-size:18px;color:#172033;font-weight:700;margin:0 0 12px;">Расчёт: как уступка превращается в деньги</h3>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 12px;">Квартира стоит <strong>12 000 000 ₽</strong>. Скидка:</p>
<ul style="margin:0;padding-left:20px;font-size:16px;color:#4A5568;line-height:28px;">
<li><strong>3% = <strong style="color:#F5A623;">360 000 ₽</strong></strong></li>
<li><strong>5% = <strong style="color:#F5A623;">600 000 ₽</strong></strong></li>
<li><strong>7% = <strong style="color:#F5A623;">840 000 ₽</strong></strong></li>
</ul>
<p style="font-size:14px;color:#667085;margin:12px 0 0;">Если скидка ничем не компенсирована — это чистое снижение цены. Если скидка обменяна на условия, продавец может получить взамен: быстрый аванс, понятный срок сделки, безопасную форму расчётов, удобную дату освобождения.</p>
</div>

<!-- When agent needed -->
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Когда нужен агент</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Запросите консультацию, если:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>покупатель давит фразой «у меня деньги сегодня»;</li>
<li>вас просят сразу назвать скидку;</li>
<li>предлагают занизить цену в договоре;</li>
<li>хотят снять объявление без аванса;</li>
<li>есть ипотека, цепочка, альтернативная сделка;</li>
<li>вы не понимаете, что лучше: аванс, задаток или обеспечительный платёж;</li>
<li>вы боитесь потерять покупателя и готовы уступать слишком быстро.</li>
</ul>
</div>

<!-- 2 options CTA -->
<div style="margin-top:64px;">
<div style="background:#F8F9FB;border-radius:12px;padding:40px 32px;">
<h2 style="font-size:28px;color:#172033;font-weight:700;text-align:center;margin:0 0 8px;">Что сделать дальше</h2>
<p style="font-size:16px;color:#4A5568;text-align:center;margin:0 0 32px;">Переговоры — это не спор о скидке. Это обсуждение пакета условий сделки.</p>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">📋</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Подготовиться самостоятельно</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Скачайте чек-лист переговоров: минимальная цена, условия уступки, ответы на «дорого», аванс/задаток, фиксация</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;">Получить чек-лист переговоров</a>
</div>
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">💬</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Запросить консультацию</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Если покупатель уже торгуется или предлагает сложные условия</p>
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
<form data-stage="2" data-action="negotiation" style="display:flex;flex-direction:column;gap:16px;" onsubmit="return false;">

<!-- Step indicator -->
<div style="display:flex;gap:8px;justify-content:center;margin-bottom:8px;">
  <span class="step-indicator-1 active" style="width:40px;height:4px;border-radius:2px;background:#F5A623;"></span>
  <span class="step-indicator-2" style="width:40px;height:4px;border-radius:2px;background:rgba(255,255,255,0.3);"></span>
</div>

<!-- STEP 1: Вопрос -->
<div class="form-step-1">
<select name="topic" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;width:100%;">
<option value="">Какая ситуация?</option>
<option>Получить чек-лист переговоров</option>
<option>Нужна консультация (покупатель уже торгуется)</option>
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
    'post_title'   => 'Переговоры с покупателем',
    'post_name'    => 'negotiation',
    'post_content' => $new_content,
    'post_status'  => 'publish',
), true);

if (is_wp_error($result)) {
    WP_CLI::error('Page update failed: ' . $result->get_error_message());
} else {
    WP_CLI::success("Page /sell/negotiation/ (ID {$page_id}) updated successfully.");
}

if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
WP_CLI::line('Cache flushed.');
WP_CLI::line('Blocks: Hero + Disclaimer + Intro + 8 principles + Calculation + Agent block + 2-option CTA + Final form');
WP_CLI::line('Spec: pages/sell/negotiation/index.md (Gate 3)');
