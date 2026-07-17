<?php
/**
 * Apply homepage content per approved spec (Gate 3)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-index-page.php
 *
 * Spec source: pages/index.md (утверждён 2026-07-12)
 * Design system: /документация/01-дизайн-контекст-и-правила-агента.md
 */

$page_id = 38; // Главная

$new_content = <<<HTML
<div class="de-shell">

<!-- ============================================ -->
<!-- Блок 1: Hero -->
<!-- ============================================ -->
<section class="de-hero" style="background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);padding:80px 0;text-align:center;">
<div style="max-width:900px;margin:0 auto;padding:0 24px;">
<h1 style="font-size:48px;line-height:56px;color:#FFFFFF;font-weight:700;margin:0 0 20px;">
Продажа или покупка квартиры — с понятным планом
</h1>
<p style="font-size:20px;line-height:28px;color:#CBD5E0;margin:0 0 40px;max-width:700px;margin-left:auto;margin-right:auto;">
Помогаем продавцам и покупателям недвижимости в Москве и МО пройти сделку без потерь — от оценки до регистрации права.
</p>
<div style="display:flex;flex-wrap:wrap;gap:16px;justify-content:center;">
<a class="de-btn" href="/sell/estimate/" style="display:inline-flex;align-items:center;background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:600;font-size:16px;transition:background 0.2s;">
Оценить недвижимость
</a>
<a class="de-btn de-btn--outline" href="/buyers/catalog/" style="display:inline-flex;align-items:center;border:2px solid #FFFFFF;color:#FFFFFF;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:600;font-size:16px;transition:background 0.2s;">
Подобрать объект
</a>
</div>
<p style="font-size:14px;color:#CBD5E0;opacity:0.7;margin:24px 0 0;">
<span style="display:inline-flex;align-items:center;gap:8px;">
<span>Оценка</span>
<span style="opacity:0.4;">·</span>
<span>AI-анализ</span>
<span style="opacity:0.4;">·</span>
<span>Проверка</span>
<span style="opacity:0.4;">·</span>
<span>Сопровождение</span>
</span>
</p>
</div>
</section>

<!-- ============================================ -->
<!-- Блок 2: Владельцам -->
<!-- ============================================ -->
<section class="de-section" style="padding:80px 0;background:#FFFFFF;">
<div style="max-width:1100px;margin:0 auto;padding:0 24px;display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;">
<div>
<h2 style="font-size:38px;line-height:46px;color:#172033;font-weight:700;margin:0 0 16px;">
Продать квартиру быстро и дорого
</h2>
<p style="font-size:17px;line-height:26px;color:#4A5568;margin:0 0 32px;">
80% продавцов теряют деньги из-за неправильной цены и плохой подготовки. Поможем избежать ошибок — бесплатно.
</p>
<a class="de-btn" href="/sell/estimate/" style="display:inline-flex;align-items:center;background:#F5A623;color:#1A202C;padding:14px 28px;border-radius:12px;text-decoration:none;font-weight:600;font-size:15px;">
Оценить недвижимость →
</a>
</div>
<div style="display:grid;place-items:center;min-height:200px;">
<!-- Иконка/иллюстрация: опционально, минималистичная -->
<div style="width:120px;height:120px;border-radius:50%;background:#F7F5F2;display:grid;place-items:center;font-size:48px;color:#C8A468;">
🏠
</div>
</div>
</div>
</section>

<!-- ============================================ -->
<!-- Блок 3: Покупателям -->
<!-- ============================================ -->
<section class="de-section" style="padding:80px 0;background:#F8F9FB;">
<div style="max-width:1100px;margin:0 auto;padding:0 24px;display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;">
<div style="order:2;">
<h2 style="font-size:38px;line-height:46px;color:#172033;font-weight:700;margin:0 0 16px;">
Купить квартиру без сюрпризов
</h2>
<p style="font-size:17px;line-height:26px;color:#4A5568;margin:0 0 32px;">
Проверим риски, подберём вариант, проведём сделку. Прозрачно, по шагам, с экспертом.
</p>
<a class="de-btn" href="/buyers/catalog/" style="display:inline-flex;align-items:center;background:#F5A623;color:#1A202C;padding:14px 28px;border-radius:12px;text-decoration:none;font-weight:600;font-size:15px;">
Подобрать объект →
</a>
</div>
<div style="display:grid;place-items:center;min-height:200px;order:1;">
<div style="width:120px;height:120px;border-radius:50%;background:#FFFFFF;display:grid;place-items:center;font-size:48px;color:#2F7D46;">
🔍
</div>
</div>
</div>
</section>

<!-- ============================================ -->
<!-- Блок 4: Как мы работаем (3 шага) -->
<!-- ============================================ -->
<section class="de-section" style="padding:80px 0;background:#FFFFFF;">
<div style="max-width:1000px;margin:0 auto;padding:0 24px;">
<h2 style="font-size:38px;line-height:46px;color:#172033;font-weight:700;text-align:center;margin:0 0 56px;">
Как мы работаем
</h2>
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
<div style="background:#FFFFFF;border-radius:12px;padding:32px 24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);text-align:center;position:relative;">
<div style="font-size:48px;font-weight:300;color:#CBD5E0;line-height:1;margin-bottom:16px;">1</div>
<h3 style="font-size:18px;font-weight:600;color:#172033;margin:0 0 10px;">Диагностика</h3>
<p style="font-size:15px;color:#4A5568;margin:0;line-height:22px;">
Бесплатный AI-анализ объекта или проверка рисков
</p>
</div>
<div style="background:#FFFFFF;border-radius:12px;padding:32px 24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);text-align:center;position:relative;">
<div style="font-size:48px;font-weight:300;color:#CBD5E0;line-height:1;margin-bottom:16px;">2</div>
<h3 style="font-size:18px;font-weight:600;color:#172033;margin:0 0 10px;">План</h3>
<p style="font-size:15px;color:#4A5568;margin:0;line-height:22px;">
Понятная стратегия: цена, сроки, документы
</p>
</div>
<div style="background:#FFFFFF;border-radius:12px;padding:32px 24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);text-align:center;position:relative;">
<div style="font-size:48px;font-weight:300;color:#CBD5E0;line-height:1;margin-bottom:16px;">3</div>
<h3 style="font-size:18px;font-weight:600;color:#172033;margin:0 0 10px;">Сделка</h3>
<p style="font-size:15px;color:#4A5568;margin:0;line-height:22px;">
Сопровождение от показа до регистрации права
</p>
</div>
</div>
</div>
</section>

<!-- ============================================ -->
<!-- Блок 5: Отзывы -->
<!-- ============================================ -->
<section class="de-section" style="padding:80px 0;background:#F8F9FB;">
<div style="max-width:900px;margin:0 auto;padding:0 24px;">
<h2 style="font-size:38px;line-height:46px;color:#172033;font-weight:700;text-align:center;margin:0 0 48px;">
Реальные истории клиентов
</h2>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
<blockquote style="background:#FFFFFF;border-radius:12px;padding:28px;box-shadow:0 2px 12px rgba(0,0,0,0.06);margin:0;">
<p style="font-size:16px;line-height:24px;color:#2D3748;font-style:italic;margin:0 0 16px;">
«Продали на 300 тыс. дороже, чем я рассчитывал»
</p>
<footer style="font-size:14px;color:#718096;">
— Антон, Москва
</footer>
</blockquote>
<blockquote style="background:#FFFFFF;border-radius:12px;padding:28px;box-shadow:0 2px 12px rgba(0,0,0,0.06);margin:0;">
<p style="font-size:16px;line-height:24px;color:#2D3748;font-style:italic;margin:0 0 16px;">
«Проверили застройщика — оказались суды. Спасибо, что отговорили»
</p>
<footer style="font-size:14px;color:#718096;">
— Елена, МО
</footer>
</blockquote>
</div>
<div style="text-align:center;margin-top:24px;">
<a href="/reviews/" style="color:#2F7D46;font-weight:600;text-decoration:none;font-size:15px;">
Все отзывы →
</a>
</div>
<p style="font-size:12px;color:#A0AEC0;text-align:center;margin:16px 0 0;">
Результат зависит от объекта, рынка и условий сделки.
</p>
</div>
</section>

<!-- ============================================ -->
<!-- Блок 6: Материалы -->
<!-- ============================================ -->
<section class="de-section" style="padding:80px 0;background:#FFFFFF;">
<div style="max-width:900px;margin:0 auto;padding:0 24px;">
<h2 style="font-size:38px;line-height:46px;color:#172033;font-weight:700;text-align:center;margin:0 0 48px;">
База знаний
</h2>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
<a href="/sell/prepare/" style="display:flex;align-items:center;gap:12px;padding:16px 20px;background:#F8F9FB;border-radius:12px;text-decoration:none;color:#2D3748;font-size:16px;transition:background 0.2s;">
<span style="color:#C8A468;">📄</span>
<span style="flex:1;">Как подготовить квартиру к продаже — чек-лист</span>
<span style="color:#CBD5E0;">→</span>
</a>
<a href="/buyers/new-vs-resale/" style="display:flex;align-items:center;gap:12px;padding:16px 20px;background:#F8F9FB;border-radius:12px;text-decoration:none;color:#2D3748;font-size:16px;transition:background 0.2s;">
<span style="color:#2F7D46;">📄</span>
<span style="flex:1;">Новостройка или вторичка: сравнение</span>
<span style="color:#CBD5E0;">→</span>
</a>
<a href="/buyers/check-developer/" style="display:flex;align-items:center;gap:12px;padding:16px 20px;background:#F8F9FB;border-radius:12px;text-decoration:none;color:#2D3748;font-size:16px;transition:background 0.2s;">
<span style="color:#2E6CCB;">📄</span>
<span style="flex:1;">Как проверить застройщика</span>
<span style="color:#CBD5E0;">→</span>
</a>
<a href="/buyers/mortgage/" style="display:flex;align-items:center;gap:12px;padding:16px 20px;background:#F8F9FB;border-radius:12px;text-decoration:none;color:#2D3748;font-size:16px;transition:background 0.2s;">
<span style="color:#2F7D46;">📄</span>
<span style="flex:1;">Ипотека: что нужно знать</span>
<span style="color:#CBD5E0;">→</span>
</a>
</div>
<div style="text-align:center;margin-top:24px;">
<a href="/blog/" style="color:#2F7D46;font-weight:600;text-decoration:none;font-size:15px;">
Все материалы →
</a>
</div>
</div>
</section>

<!-- ============================================ -->
<!-- Блок 7: Pre-footer CTA -->
<!-- ============================================ -->
<section class="de-section" style="padding:80px 0;background:linear-gradient(135deg,#0A1628 0%,#1A2A4A 100%);">
<div style="max-width:500px;margin:0 auto;padding:0 24px;text-align:center;">
<h2 style="font-size:32px;line-height:40px;color:#FFFFFF;font-weight:700;margin:0 0 12px;">
Готовы начать?
</h2>
<p style="font-size:16px;color:#CBD5E0;margin:0 0 36px;">
Оставьте заявку — мы перезвоним в рабочее время в течение 30 минут.
</p>
<form data-stage="2" data-action="consult" style="display:flex;flex-direction:column;gap:16px;" onsubmit="return false;">

<!-- Step indicator -->
<div style="display:flex;gap:8px;justify-content:center;margin-bottom:12px;">
  <span class="step-indicator-1 active" style="width:40px;height:4px;border-radius:2px;background:#F5A623;"></span>
  <span class="step-indicator-2" style="width:40px;height:4px;border-radius:2px;background:rgba(255,255,255,0.3);"></span>
</div>

<!-- STEP 1: Вопрос -->
<div class="form-step-1">
<textarea name="question" placeholder="Что вас интересует? (продажа / покупка / консультация)" rows="3" style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;width:100%;box-sizing:border-box;resize:vertical;font-family:inherit;"></textarea>

<button type="button" class="btn-next" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;width:100%;transition:background 0.2s;">
Далее →
</button>
</div>

<!-- STEP 2: Контакты (hidden) -->
<div class="form-step-2" style="display:none;">
<input type="text" name="name" placeholder="Имя" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;">
<input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;height:48px;box-sizing:border-box;">
<label style="font-size:14px;color:#CBD5E0;display:flex;align-items:center;gap:8px;justify-content:center;cursor:pointer;">
<input type="checkbox" required style="width:18px;height:18px;cursor:pointer;">
Я согласен на обработку
<a href="/privacy-policy/" style="color:#F5A623;text-decoration:underline;margin-left:4px;">персональных данных</a>
</label>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
<button type="button" class="btn-back" style="background:rgba(255,255,255,0.15);color:#CBD5E0;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;">
← Назад
</button>
<button type="submit" class="btn-submit" data-label="Получить консультацию" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;transition:background 0.2s;">
Получить консультацию
</button>
</div>
</div>
</form>
</div>
</section>

</div>
<script src="/wp-content/scripts/form-handler.js"></script>
HTML;

// Update the page
$result = wp_update_post(array(
    'ID'           => $page_id,
    'post_title'   => 'Главная',
    'post_name'    => 'glavnaya',
    'post_content' => $new_content,
    'post_status'  => 'publish',
), true);

if (is_wp_error($result)) {
    WP_CLI::error('Page update failed: ' . $result->get_error_message());
} else {
    WP_CLI::success("Homepage (ID {$page_id}) updated successfully.");
}

// Clear cache
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
WP_CLI::line('Cache flushed.');

// Output summary
WP_CLI::line('---');
WP_CLI::line('Blocks applied:');
WP_CLI::line('  1. Hero (dark gradient #0A1628→#1A2A4A, 2 CTA buttons + signature)');
WP_CLI::line('  2. For sellers (2 columns: text + icon, CTA to /sell/estimate/)');
WP_CLI::line('  3. For buyers (2 columns: text + icon, CTA to /buyers/catalog/)');
WP_CLI::line('  4. How we work (3 step cards: Диагностика / План / Сделка)');
WP_CLI::line('  5. Reviews (2 testimonial cards + disclaimer + link to /reviews/)');
WP_CLI::line('  6. Knowledge base (4 links 2x2 grid + link to /blog/)');
WP_CLI::line('  7. Pre-footer CTA (name + phone + consent form)');
WP_CLI::line('Design tokens: navy/gold/green per 01-дизайн-контекст');
WP_CLI::line('Accent CTA: #F5A623 per pages/index.md spec');
WP_CLI::line('Spec: pages/index.md (Gate 3 approved)');
