<?php
/**
 * Apply /sell/alternative/ page content per approved spec (Gate 3)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-alternative-page.php
 *
 * Spec source: pages/sell/alternative/index.md
 */

$page_id = 48;

$new_content = <<<HTML
<div class="de-shell">

<!-- Hero -->
<section style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);padding:80px 0;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;text-align:center;">
<h1 style="font-size:40px;line-height:48px;color:#FFFFFF;font-weight:700;margin:0 0 16px;">
Альтернативная сделка: как продать свою квартиру и купить другую без срыва сроков
</h1>
<p style="font-size:18px;line-height:26px;color:#CBD5E0;margin:0 0 16px;">
Альтернативная сделка — это цепочка зависимых действий. Если одно звено срывается, может остановиться вся цепочка.
</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:600;font-size:16px;">
Получить чек-лист альтернативной сделки
</a>
</div>
</section>

<!-- Disclaimer -->
<section style="padding:32px 0 0;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">
<div style="background:#FFF8F0;border:1px solid #FEE6C9;border-radius:12px;padding:16px 20px;font-size:14px;color:#8B6F47;line-height:22px;">
<strong>⚠ Информационный характер.</strong> Статья не заменяет юридическую консультацию. Конкретная схема зависит от состава участников, документов, банка, сроков и формы расчётов.
</div>
</div>
</section>

<!-- Main content -->
<section style="padding:48px 0 64px;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">

<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0 0 16px;">Альтернативная сделка — это ситуация, когда вы продаёте свою квартиру и почти одновременно покупаете другую. Деньги от продажи не остаются у вас надолго: они идут дальше — продавцу встречной квартиры.</p>
<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0 0 16px;">На словах схема простая: продал одну, купил другую. На практике это цепочка зависимых действий: нужно найти покупателя, выбрать встречный объект, согласовать сроки, аванс, расчёты, документы, ипотеку и освобождение квартир.</p>
<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0;">Эта статья не повторяет: документы сделки — <a href="/sell/documents/" style="color:#2F7D46;text-decoration:underline;">/sell/documents/</a>; переговоры о цене и условиях — <a href="/sell/negotiation/" style="color:#2F7D46;text-decoration:underline;">/sell/negotiation/</a>; налоги — <a href="/sell/taxes/" style="color:#2F7D46;text-decoration:underline;">/sell/taxes/</a>; показы — <a href="/sell/showings/" style="color:#2F7D46;text-decoration:underline;">/sell/showings/</a>.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 1. Альтернатива — это не одна сделка, а цепочка</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">В свободной продаже участвуют две стороны: продавец и покупатель. В альтернативной сделке минимум три стороны: ваш покупатель, вы как продавец и одновременно покупатель, продавец квартиры, которую вы хотите купить.</p>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Если встречный продавец тоже покупает другую квартиру, появляется ещё одно звено. Чем длиннее цепочка, тем выше риск срыва. Альтернативные сделки — распространённая схема на вторичном рынке. Но это не делает их простыми. Их нужно вести как проект: сроки, документы, авансы, расчёты и резервные сценарии.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 2. Нельзя обещать сроки, пока не зафиксирована встречная покупка</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Главная ошибка продавца — обещать покупателю быстрый выход на сделку и освобождение квартиры, пока встречный объект ещё не найден или не закреплён авансом.</p>
<div style="background:#FFF8F0;border:1px solid #FEE6C9;border-radius:12px;padding:20px 24px;margin-bottom:16px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 8px;">Опасные обещания</h3>
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>«освободим квартиру через две недели»;</li>
<li>«сделка точно будет в этом месяце»;</li>
<li>«мы уже почти выбрали вариант»;</li>
<li>«можете не переживать, всё успеем».</li>
</ul>
</div>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;"><strong>Безопаснее говорить:</strong> У нас альтернативная сделка. Сроки будем фиксировать после согласования встречного объекта и схемы расчётов.</p>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 3. Сначала считаем бюджет и доплату</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">До запуска сделки нужно понять: сколько реально стоит ваша квартира, какую квартиру вы хотите купить, сколько нужна доплата, есть ли ипотека, какие расходы на сделку, сколько времени можно держать покупателя в ожидании.</p>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Если продавец продаёт свою квартиру, но не понимает бюджет покупки, он рискует принять аванс, а потом не найти подходящий вариант. Это превращает сильную позицию в слабую: покупатель ждёт, встречный объект не найден, сроки давят, приходится уступать.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 4. Аванс должен учитывать альтернативный характер сделки</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">В обычной продаже аванс фиксирует намерение сторон. В альтернативной сделке аванс должен учитывать, что продавец ищет или уже закрепляет встречный объект.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 8px;">Важно письменно зафиксировать:</p>
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>что сделка альтернативная;</li>
<li>срок на подбор или подтверждение встречного объекта;</li>
<li>условия возврата аванса;</li>
<li>дату выхода на сделку;</li>
<li>срок освобождения квартиры;</li>
<li>что происходит, если одно звено цепочки срывается.</li>
</ul>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 5. Документы проверяются по всей цепочке</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">В обычной продаже продавец проверяет документы своей квартиры. В альтернативе нужно понимать документы по каждому объекту, от которого зависит сделка.</p>
<div style="background:#FFF8F0;border:1px solid #FEE6C9;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 8px;">Риски</h3>
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>у встречного продавца ипотека;</li>
<li>доли или несовершеннолетние;</li>
<li>нет согласия супруга;</li>
<li>наследство, перепланировка;</li>
<li>долги, неясные сроки освобождения.</li>
</ul>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 6. Расчёты должны быть синхронизированы</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">В альтернативной сделке деньги часто проходят через несколько сторон. Поэтому особенно важны безопасные инструменты расчётов:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>аккредитив;</li>
<li>банковская ячейка;</li>
<li>сервис безопасных расчётов;</li>
<li>депозит нотариуса — если подходит по ситуации.</li>
</ul>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 7. Регистрация должна быть согласована по времени</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Каждая сделка в цепочке юридически отдельная. Но для участников они связаны: одна продажа нужна, чтобы оплатить следующую покупку. Поэтому важно заранее согласовать дату подписания договоров, порядок подачи документов, электронную или бумажную регистрацию, что делать при приостановке одного звена.</p>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Риск альтернативы — частичная регистрация: одна сделка прошла, другая задержалась. Это редкий, но болезненный сценарий.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 8. Налоги нужно посчитать до выбора схемы</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Если вы продаёте и покупаете в одном периоде, налоговые последствия могут быть важны: срок владения, вычеты, расходы на покупку, продажа долей, материнский капитал, единственное жильё. Не стоит считать налог после того, как аванс уже принят и встречная покупка выбрана.</p>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Разбор налогов — <a href="/sell/taxes/" style="color:#2F7D46;text-decoration:underline;">/sell/taxes/</a>.</p>

<!-- Calculation callout -->
<div style="margin-top:48px;background:#F8F9FB;border-radius:12px;padding:24px 28px;">
<h3 style="font-size:18px;color:#172033;font-weight:700;margin:0 0 12px;">Расчёт: как срыв сроков превращается в деньги</h3>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 12px;">Вы продаёте квартиру за <strong>12 млн ₽</strong> и покупаете встречную за <strong>14 млн ₽</strong>. Покупатель вашей квартиры готов ждать 3 недели. Но встречный объект не закреплён, банк задержал одобрение, а продавец встречной квартиры получил другого покупателя.</p>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 12px;">Если из-за срыва сроков приходится дать скидку <strong>3%</strong> от квартиры за 12 млн ₽:</p>
<ul style="margin:0;padding-left:20px;font-size:16px;color:#4A5568;line-height:28px;">
<li><strong>3% = <strong style="color:#F5A623;">360 000 ₽</strong></strong></li>
<li><strong>5% = <strong style="color:#F5A623;">600 000 ₽</strong></strong></li>
</ul>
</div>

<!-- When expert needed -->
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Когда нужен эксперт</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Запросите консультацию, если:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>вы продаёте и одновременно покупаете другую квартиру;</li>
<li>встречный объект ещё не найден;</li>
<li>в цепочке больше трёх сторон;</li>
<li>есть ипотека хотя бы у одного участника;</li>
<li>есть дети, доли, наследство, доверенность или маткапитал;</li>
<li>покупатель просит обещать точные сроки освобождения;</li>
<li>вы не понимаете, что писать в авансе;</li>
<li>нужно синхронизировать расчёты и регистрацию.</li>
</ul>
</div>

<!-- 2 options CTA -->
<div style="margin-top:64px;">
<div style="background:#F8F9FB;border-radius:12px;padding:40px 32px;">
<h2 style="font-size:28px;color:#172033;font-weight:700;text-align:center;margin:0 0 8px;">Что сделать дальше</h2>
<p style="font-size:16px;color:#4A5568;text-align:center;margin:0 0 32px;">Альтернативная сделка требует не только покупателя, но и сценария: что продаём, что покупаем, кто ждёт, где деньги, какие сроки и что будет, если звено выпадет.</p>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">📋</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Проверить схему самостоятельно</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Скачайте чек-лист альтернативной сделки: этапы, аванс, документы, расчёты, регистрация</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;">Получить чек-лист альтернативной сделки</a>
</div>
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">💬</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Запросить консультацию</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Если вы продаёте и покупаете одновременно, лучше разобрать схему до аванса</p>
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
<form data-stage="2" data-action="alternative" style="display:flex;flex-direction:column;gap:16px;" onsubmit="return false;">

<!-- Step indicator -->
<div style="display:flex;gap:8px;justify-content:center;margin-bottom:8px;">
  <span class="step-indicator-1 active" style="width:40px;height:4px;border-radius:2px;background:#F5A623;"></span>
  <span class="step-indicator-2" style="width:40px;height:4px;border-radius:2px;background:rgba(255,255,255,0.3);"></span>
</div>

<!-- STEP 1: Вопрос -->
<div class="form-step-1">
<select name="topic" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;width:100%;">
<option value="">Какая ситуация?</option>
<option>Получить чек-лист альтернативной сделки</option>
<option>Нужна консультация (продаю и покупаю одновременно)</option>
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
    'post_title'   => 'Альтернативная сделка',
    'post_name'    => 'alternative',
    'post_content' => $new_content,
    'post_status'  => 'publish',
), true);

if (is_wp_error($result)) {
    WP_CLI::error('Page update failed: ' . $result->get_error_message());
} else {
    WP_CLI::success("Page /sell/alternative/ (ID {$page_id}) updated successfully.");
}

if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
WP_CLI::line('Cache flushed.');
WP_CLI::line('Blocks: Hero + Disclaimer + Intro + 8 principles + Calculation + Expert block + 2-option CTA + Final form');
WP_CLI::line('Spec: pages/sell/alternative/index.md (Gate 3)');
