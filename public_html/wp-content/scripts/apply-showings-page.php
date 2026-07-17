<?php
/**
 * Apply /sell/showings/ page content per approved spec (Gate 3)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-showings-page.php
 *
 * Spec source: pages/sell/showings/index.md
 */

$page_id = 45;

$new_content = <<<HTML
<div class="de-shell">

<!-- Hero -->
<section style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);padding:80px 0;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;text-align:center;">
<h1 style="font-size:40px;line-height:48px;color:#FFFFFF;font-weight:700;margin:0 0 16px;">
Как провести показ квартиры, чтобы не потерять покупателя и не дать лишний повод для торга
</h1>
<p style="font-size:18px;line-height:26px;color:#CBD5E0;margin:0 0 16px;">
Показ — это не экскурсия, а управляемая презентация объекта. Поведение на показе влияет на интерес покупателя и торг.
</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:600;font-size:16px;">
Получить чек-лист показа
</a>
</div>
</section>

<!-- Disclaimer -->
<section style="padding:32px 0 0;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">
<div style="background:#FFF8F0;border:1px solid #FEE6C9;border-radius:12px;padding:16px 20px;font-size:14px;color:#8B6F47;line-height:22px;">
<strong>⚠ Информационный характер.</strong> Статья не заменяет юридическую консультацию. Сроки сделки, документы и условия лучше проверять с юристом или нотариусом.
</div>
</div>
</section>

<!-- Main content -->
<section style="padding:48px 0 64px;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">

<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0 0 16px;">Показ квартиры — это момент, когда покупатель примеряет квартиру на себя и решает, хочет ли двигаться дальше. Продавцу кажется, что главное — открыть дверь и ответить на вопросы. Но на показе легко самому обесценить объект: извиниться за ремонт, заранее сказать «торг возможен», не знать ответы по документам или начать спорить с покупателем.</p>
<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0 0 16px;">Хороший показ не гарантирует продажу. Но плохой показ может сорвать интерес даже к сильной квартире.</p>
<p style="font-size:17px;line-height:28px;color:#2D3748;margin:0;">Если покупатель уже заинтересовался и началось обсуждение цены, аванса, сроков и условий сделки — это уже переговоры. Для этого есть отдельная статья: <a href="/sell/negotiation/" style="color:#2F7D46;text-decoration:underline;">/sell/negotiation/</a>.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 1. Показ начинается до входа в квартиру</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Покупатель начинает оценивать объект ещё до двери: двор, парковку, подъезд, лифт, запахи, освещение, состояние лестничной площадки.</p>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Продавец не может за день изменить дом. Но он может убрать то, что контролирует: мусор у двери, перегоревшую лампочку на площадке, коробки в тамбуре, резкий запах в квартире, лишние вещи у входа.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 2. Время показа влияет на восприятие</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Одна и та же квартира может выглядеть по-разному утром, вечером, в солнечный день и в дождь. Если квартира светлая — показывайте её в то время, когда максимум естественного света. Если вид из окна слабый — иногда лучше вечерний показ.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 3. Маршрут должен начинаться с сильного места</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Не нужно сразу вести покупателя в самую слабую комнату или тесный коридор. Начните с того, что создаёт лучший первый эффект: светлая гостиная, кухня, вид из окна, просторная комната, аккуратный санузел после ремонта.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 4. Не продавать словами то, что квартира должна показать сама</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">На показе не нужно говорить без остановки. Чем больше продавец оправдывается, тем больше покупатель ищет подвох. Лучше дать человеку осмотреться, а затем коротко подсветить то, что не видно сразу: заменена проводка, хороший напор воды, окна во двор, зимой тепло, один собственник, быстрый выход на сделку, документы готовы к проверке.</p>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 5. Некоторые фразы сразу снижают позицию продавца</h2>
<div style="background:#FFF8F0;border:1px solid #FEE6C9;border-radius:12px;padding:20px 24px;margin-bottom:16px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 8px;">Опасные фразы</h3>
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>«Здесь всё равно ремонт делать»</li>
<li>«Кухня маленькая, но что поделать»</li>
<li>«Мы срочно продаём»</li>
<li>«Торг уместен»</li>
<li>«Если что, уступим»</li>
<li>«У нас уже много смотрели, но никто не взял»</li>
</ul>
</div>

<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 8px;">Как говорить иначе</h3>
<table style="width:100%;border-collapse:collapse;font-size:14px;">
<tr style="border-bottom:1px solid #E2E8F0;">
<td style="padding:8px 12px;color:#E53E3E;font-weight:500;">Здесь всё равно ремонт делать</td>
<td style="padding:8px 12px;color:#2F7D46;font-weight:500;">Состояние позволяет сделать ремонт под себя</td>
</tr>
<tr style="border-bottom:1px solid #E2E8F0;">
<td style="padding:8px 12px;color:#E53E3E;font-weight:500;">Кухня маленькая</td>
<td style="padding:8px 12px;color:#2F7D46;font-weight:500;">Компактная кухня, зато изолированные комнаты</td>
</tr>
<tr style="border-bottom:1px solid #E2E8F0;">
<td style="padding:8px 12px;color:#E53E3E;font-weight:500;">Срочно продаём</td>
<td style="padding:8px 12px;color:#2F7D46;font-weight:500;">Готовы оперативно выйти на сделку</td>
</tr>
<tr style="border-bottom:1px solid #E2E8F0;">
<td style="padding:8px 12px;color:#E53E3E;font-weight:500;">Торг уместен</td>
<td style="padding:8px 12px;color:#2F7D46;font-weight:500;">Готовы обсуждать условия после просмотра и понимания сроков</td>
</tr>
<tr>
<td style="padding:8px 12px;color:#E53E3E;font-weight:500;">Если что, уступим</td>
<td style="padding:8px 12px;color:#2F7D46;font-weight:500;">Цена сформирована с учётом рынка</td>
</tr>
</table>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 6. Торг не нужно начинать на пороге</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Покупатель может спросить сразу: «Сколько уступите?» Плохой ответ: «Ну, тысяч 300 точно уступим.» Так продавец сам снижает цену ещё до того, как покупатель оценил квартиру.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<p style="font-size:16px;line-height:26px;color:#2D3748;margin:0;"><strong>Лучше ответить спокойно:</strong> Цена сформирована с учётом рынка. Готовы обсуждать условия, если квартира вам подходит и понятны сроки сделки.</p>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 7. На вопросы по документам нужно отвечать спокойно и коротко</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Не нужно превращать показ в юридическую проверку. Но важно не теряться и не отвечать: «потом разберёмся». Лучше подготовить короткие спокойные ответы заранее.</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>«Собственник один, документы готовы к проверке».</li>
<li>«Ипотеки нет, обременений нет».</li>
<li>«Вопрос по перепланировке проверим по документам».</li>
<li>«Все документы покажем на этапе аванса/проверки».</li>
</ul>
</div>

<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Принцип 8. Если вам сложно спокойно вести показ — лучше не делать это одному</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Собственник знает квартиру лучше всех. Но именно поэтому ему сложнее проводить показ спокойно. Когда покупатель критикует ремонт, планировку, цену или подъезд, собственник может воспринимать это лично.</p>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0;">Варианты: попросить нейтрального человека, передать показ агенту, присутствовать, но не вести разговор. Главная задача — показать ценность объекта и не дать эмоциям превратить показ в торг.</p>

<!-- Calculation callout -->
<div style="margin-top:48px;background:#F8F9FB;border-radius:12px;padding:24px 28px;">
<h3 style="font-size:18px;color:#172033;font-weight:700;margin:0 0 12px;">Расчёт: как показ связан с деньгами</h3>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 12px;">Квартира стоит <strong>12 000 000 ₽</strong>. Если продавец сам даёт повод для скидки <strong>3–5%</strong>, это:</p>
<ul style="margin:0;padding-left:20px;font-size:16px;color:#4A5568;line-height:28px;">
<li><strong>3% = <strong style="color:#F5A623;">360 000 ₽</strong></strong></li>
<li><strong>5% = <strong style="color:#F5A623;">600 000 ₽</strong></strong></li>
</ul>
<p style="font-size:14px;color:#667085;margin:12px 0 0;">Поводом может быть не объект, а поведение на показе: «нам срочно», «уступим», «тут ремонт делать», «документы потом покажем», «показы уже месяц идут». Показ не гарантирует цену. Но слабый показ может превратить обычный торг в жёсткий.</p>
</div>

<!-- When agent needed -->
<h2 style="font-size:22px;color:#172033;font-weight:700;margin:48px 0 16px;">Когда нужен агент</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Запросите консультацию, если:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>не знаете, как показывать слабые стороны квартиры;</li>
<li>боитесь сказать лишнее;</li>
<li>покупатели приходят, но не возвращаются;</li>
<li>все начинают разговор с торга;</li>
<li>есть сложные документы;</li>
<li>собственник эмоционально реагирует на критику;</li>
<li>нужно продать быстро, но без панической скидки.</li>
</ul>
</div>

<!-- 2 options CTA -->
<div style="margin-top:64px;">
<div style="background:#F8F9FB;border-radius:12px;padding:40px 32px;">
<h2 style="font-size:28px;color:#172033;font-weight:700;text-align:center;margin:0 0 8px;">Что сделать дальше</h2>
<p style="font-size:16px;color:#4A5568;text-align:center;margin:0 0 32px;">Показ квартиры — это сценарий: подготовка, правильное время, маршрут, ответы, документы и спокойная позиция по цене.</p>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">📋</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Подготовить показ самостоятельно</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Скачайте чек-лист показа и проверьте квартиру по этапам</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;">Получить чек-лист показа</a>
</div>
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">💬</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Запросить консультацию</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Если не хотите терять покупателя на показе или не уверены, как отвечать на вопросы</p>
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
<form data-stage="2" data-action="showings" style="display:flex;flex-direction:column;gap:16px;" onsubmit="return false;">

<!-- Step indicator -->
<div style="display:flex;gap:8px;justify-content:center;margin-bottom:8px;">
  <span class="step-indicator-1 active" style="width:40px;height:4px;border-radius:2px;background:#F5A623;"></span>
  <span class="step-indicator-2" style="width:40px;height:4px;border-radius:2px;background:rgba(255,255,255,0.3);"></span>
</div>

<!-- STEP 1: Вопрос -->
<div class="form-step-1">
<select name="topic" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;width:100%;">
<option value="">Что нужно?</option>
<option>Получить чек-лист показа</option>
<option>Запросить консультацию</option>
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
<label style="font-size:13px;color:#CBD5E0;display:flex;align-items:center;gap:8px;justify-content:center;cursor:pointer;">
<input type="checkbox" required style="width:16px;height:16px;cursor:pointer;">
Согласен на обработку <a href="/privacy-policy/" style="color:#F5A623;text-decoration:underline;">персональных данных</a>
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
    'post_title'   => 'Показы квартиры',
    'post_name'    => 'showings',
    'post_content' => $new_content,
    'post_status'  => 'publish',
), true);

if (is_wp_error($result)) {
    WP_CLI::error('Page update failed: ' . $result->get_error_message());
} else {
    WP_CLI::success("Page /sell/showings/ (ID {$page_id}) updated successfully.");
}

if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
WP_CLI::line('Cache flushed.');
WP_CLI::line('Blocks: Hero + Disclaimer + Intro + 8 principles + Table + Calculation + Agent block + 2-option CTA + Final form');
WP_CLI::line('Spec: pages/sell/showings/index.md (Gate 3)');
