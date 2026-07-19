<?php
/**
 * Apply /sell/documents/ page content per approved spec (Gate 3)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-documents-page.php
 *
 * Spec source: pages/sell/documents/index.md
 */

$page_id = 44;

$new_content = <<<HTML
<div class="de-shell">

<!-- Hero -->
<section style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);padding:80px 0;">
<div style="max-width:800px;margin:0 auto;padding:0 24px;text-align:center;">
<h1 style="font-size:40px;line-height:48px;color:#FFFFFF;font-weight:700;margin:0 0 16px;">
Какие документы нужны для продажи квартиры — и почему их лучше готовить до показов
</h1>
<p style="font-size:18px;line-height:26px;color:#CBD5E0;margin:0 0 16px;">
Документы влияют на доверие покупателя, скорость сделки и торг. Готовить их лучше до активных показов, а не после аванса.
</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:600;font-size:16px;">
Получить чек-лист документов
</a>
</div>
</section>

<!-- Disclaimer -->
<section style="padding:32px 0 0;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">
<div style="background:#FFF8F0;border:1px solid #FEE6C9;border-radius:12px;padding:16px 20px;font-size:14px;color:#8B6F47;line-height:22px;">
<strong>⚠ Информационный характер.</strong> Статья не заменяет юридическую консультацию. В сложных ситуациях — доли, дети, ипотека, маткапитал, наследство, перепланировка — документы лучше проверять с юристом или нотариусом.
</div>
</div>
</section>

<!-- Main content -->
<section style="padding:48px 0 64px;background:#FFFFFF;">
<div style="max-width:760px;margin:0 auto;padding:0 24px;">

<h2 style="font-size:26px;color:#172033;font-weight:700;margin:0 0 24px;">Базовые документы продавца</h2>

<div style="display:grid;gap:16px;">
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:17px;color:#172033;font-weight:600;margin:0 0 6px;">1. Паспорт продавца</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Если собственников несколько — паспорта всех собственников. Если собственник младше 14 лет — свидетельство о рождении и документы представителя.</p>
</div>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:17px;color:#172033;font-weight:600;margin:0 0 6px;">2. Правоустанавливающий документ</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Договор купли-продажи, дарения, приватизации, свидетельство о наследстве, решение суда, ДДУ, акт приёма-передачи от застройщика. Покупатель смотрит историю объекта.</p>
</div>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:17px;color:#172033;font-weight:600;margin:0 0 6px;">3. Выписка из ЕГРН</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Показывает собственника, обременения, ипотеку, аресты. Лучше заказывать свежую ближе к авансу или сделке.</p>
</div>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:17px;color:#172033;font-weight:600;margin:0 0 6px;">4. Договор купли-продажи</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Основной документ сделки. Фиксирует стороны, объект, цену, порядок расчётов, сроки передачи, ответственность сторон.</p>
</div>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<h3 style="font-size:17px;color:#172033;font-weight:600;margin:0 0 6px;">5. Акт приёма-передачи</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Подтверждает фактическую передачу квартиры: дату, состояние, ключи, показания счётчиков.</p>
</div>
</div>

<h2 style="font-size:26px;color:#172033;font-weight:700;margin:48px 0 24px;">Документы доверия</h2>
<p style="font-size:16px;line-height:26px;color:#4A5568;margin:0 0 16px;">Не всегда обязательны для регистрации, но помогают покупателю принять решение:</p>
<div style="background:#F8F9FB;border-radius:12px;padding:20px 24px;">
<ul style="margin:0;padding-left:20px;font-size:15px;color:#4A5568;line-height:28px;">
<li>Свежая выписка из ЕГРН</li>
<li>Справка об отсутствии долгов по ЖКУ</li>
<li>Справка по капремонту</li>
<li>Выписка из домовой книги / сведения о зарегистрированных</li>
<li>Техпаспорт или поэтажный план БТИ</li>
<li>Документы по перепланировке (если была)</li>
</ul>
</div>

<h2 style="font-size:26px;color:#172033;font-weight:700;margin:48px 0 24px;">Документы по ситуации</h2>

<div style="background:#FFF8F0;border-radius:12px;padding:20px 24px;margin-bottom:16px;border:1px solid #FEE6C9;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">🏛 Квартира куплена в браке</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Обычно требуется нотариальное согласие супруга — даже если право оформлено на одного человека.</p>
</div>
<div style="background:#FFF8F0;border-radius:12px;padding:20px 24px;margin-bottom:16px;border:1px solid #FEE6C9;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">👥 Несколько собственников или доли</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">В сделке участвуют все собственники или их представители. Для доли может требоваться нотариальная форма.</p>
</div>
<div style="background:#FFF8F0;border-radius:12px;padding:20px 24px;margin-bottom:16px;border:1px solid #FEE6C9;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">👶 Несовершеннолетний собственник</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Требуется разрешение органов опеки. Такие сделки готовятся заранее.</p>
</div>
<div style="background:#FFF8F0;border-radius:12px;padding:20px 24px;margin-bottom:16px;border:1px solid #FEE6C9;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">🏦 Ипотека или обременение</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Продажу нужно согласовать с банком. Схема зависит от банка и остатка долга.</p>
</div>
<div style="background:#FFF8F0;border-radius:12px;padding:20px 24px;margin-bottom:16px;border:1px solid #FEE6C9;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">👪 Материнский капитал</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Проверить выделены ли доли детям, есть ли несовершеннолетние собственники, нужна ли опека.</p>
</div>
<div style="background:#FFF8F0;border-radius:12px;padding:20px 24px;margin-bottom:16px;border:1px solid #FEE6C9;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">📜 Наследство</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Проверяются сроки вступления, круг наследников, споры, риски претензий. Само наследство не запрещает продажу.</p>
</div>
<div style="background:#FFF8F0;border-radius:12px;padding:20px 24px;margin-bottom:16px;border:1px solid #FEE6C9;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">📝 Доверенность</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Нотариальная доверенность с конкретными полномочиями. Можно проверить через реестр нотариальных доверенностей.</p>
</div>
<div style="background:#FFF8F0;border-radius:12px;padding:20px 24px;border:1px solid #FEE6C9;">
<h3 style="font-size:16px;color:#172033;font-weight:600;margin:0 0 6px;">🔨 Перепланировка</h3>
<p style="font-size:15px;color:#4A5568;margin:0;">Несогласованная перепланировка может осложнить ипотеку, затянуть сделку и стать поводом для торга.</p>
</div>

<!-- 2 options CTA -->
<div style="margin-top:64px;">
<div style="background:#F8F9FB;border-radius:12px;padding:40px 32px;">
<h2 style="font-size:28px;color:#172033;font-weight:700;text-align:center;margin:0 0 8px;">Что сделать дальше</h2>
<p style="font-size:16px;color:#4A5568;text-align:center;margin:0 0 32px;">Документы — это способ заранее снять вопросы покупателя, банка и Росреестра.</p>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">📋</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Подготовить самостоятельно</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Скачайте чек-лист документов по вашей ситуации</p>
<a href="#cta" style="display:inline-block;background:#F5A623;color:#1A202C;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;">Получить чек-лист</a>
</div>
<div style="background:#FFFFFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);text-align:center;">
<div style="font-size:36px;margin-bottom:12px;">💬</div>
<h3 style="font-size:18px;color:#172033;margin:0 0 8px;">Запросить консультацию</h3>
<p style="font-size:14px;color:#4A5568;margin:0 0 16px;">Особенно если есть ипотека, доли, дети, наследство</p>
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
<h2 style="font-size:28px;color:#FFFFFF;margin:0 0 12px;">Разберём вашу ситуацию за 15 минут</h2>
<p style="font-size:16px;color:#CBD5E0;margin:0 0 32px;">Перезвоним в рабочее время и покажем, каких документов не хватает.</p>
<form data-stage="2" data-action="documents" style="display:flex;flex-direction:column;gap:16px;" onsubmit="return false;">

<!-- Step indicator -->
<div style="display:flex;gap:8px;justify-content:center;margin-bottom:8px;">
  <span class="step-indicator-1 active" style="width:40px;height:4px;border-radius:2px;background:#F5A623;"></span>
  <span class="step-indicator-2" style="width:40px;height:4px;border-radius:2px;background:rgba(255,255,255,0.3);"></span>
</div>

<!-- STEP 1: Вопрос -->
<div class="form-step-1">
<select name="topic" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;width:100%;">
<option value="">Какая ситуация?</option>
<option>Получить чек-лист документов</option>
<option>Нужна консультация (доли/дети/ипотека)</option>
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
    'post_title'   => 'Документы для продажи квартиры',
    'post_name'    => 'documents',
    'post_content' => $new_content,
    'post_status'  => 'publish',
), true);

if (is_wp_error($result)) {
    WP_CLI::error('Page update failed: ' . $result->get_error_message());
} else {
    WP_CLI::success("Page /sell/documents/ (ID {$page_id}) updated successfully.");
}

if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
WP_CLI::line('Cache flushed.');
WP_CLI::line('Blocks: Hero + Disclaimer + Base docs (5) + Trust docs + Situational docs (8) + 2-option CTA + Final form');
WP_CLI::line('Spec: pages/sell/documents/index.md (Gate 3)');
