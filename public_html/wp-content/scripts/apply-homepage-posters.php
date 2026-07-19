<?php
/**
 * Phase 1: Add WebP posters to homepage (tasks 101-108)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-homepage-posters.php
 *
 * Media IDs:
 *   290 - home-hero-desktop-v2.webp
 *   291 - home-hero-mobile-v2.webp
 *   292 - home-sellers-poster-v1.webp
 *   293 - home-buyers-poster-v1.webp
 *   294 - home-process-poster-v1.webp
 *   295 - home-consultation-poster-v1.webp
 *   296 - home-materials-sellers-v1.webp
 *   297 - home-materials-buyers-v1.webp
 *   298 - home-materials-documents-v1.webp
 */

$page_id = 38;

// Get current content
$current = get_post_field('post_content', $page_id);

// Build new content with posters
$new_content = <<<HTML
<!-- wp:group {"className":"de-shell"} -->
<div class="wp-block-group de-shell">

<!-- ===== TASK 101: Hero с desktop/mobile poster ===== -->
<!-- wp:group {"style":{"color":{"background":"#0A1628"}},"className":"de-hero"} -->
<div class="wp-block-group de-hero has-background" style="background:#0A1628;padding:80px 24px">
<style>
.de-hero__inner{max-width:1180px;margin:0 auto;display:grid;grid-template-columns:minmax(0,1fr) minmax(360px,.9fr);gap:48px;align-items:center}
.de-hero__content{text-align:left}
.de-hero__poster{margin:0;line-height:0}
.de-hero__poster img{display:block;width:100%;height:auto;border-radius:16px}
@media (max-width:767px){.de-hero{padding:48px 0}.de-hero__inner{display:flex;flex-direction:column;gap:32px}.de-hero__content{text-align:center}.de-hero__poster{width:100%}}
</style>
<div class="de-hero__inner">
<div class="de-hero__content">
<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"48px","lineHeight":"56px"},"color":{"text":"#ffffff"}},"fontFamily":"cormorant-garamond"} -->
<h1 class="wp-block-heading has-text-color has-cormorant-garamond-font-family" style="color:#ffffff;font-size:48px;line-height:56px;font-weight:700;margin:0 0 20px;">Продажа или покупка квартиры — с понятным планом</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"20px","lineHeight":"28px"},"color":{"text":"#cbd5e0"}}} -->
<p class="has-text-color" style="color:#cbd5e0;font-size:20px;line-height:28px;margin:0 0 40px;">Помогаем продавцам и покупателям недвижимости в Москве и МО пройти сделку без потерь — от оценки до регистрации права.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","flexWrap":"wrap","gap":"16px"}} -->
<div class="wp-block-buttons" style="display:flex;flex-wrap:wrap;gap:16px">
<!-- wp:button {"backgroundColor":"#F5A623","textColor":"#1A202C","style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"32px","right":"32px"}}},"fontSize":"16px"} -->
<div class="wp-block-button has-custom-font-size" style="font-size:16px"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="/sell/estimate/" style="border-radius:12px;color:#1A202C;background:#F5A623;padding:16px 32px;text-decoration:none;font-weight:600">Оценить недвижимость</a></div>
<!-- /wp:button -->

<!-- wp:button {"style":{"border":{"radius":"12px","width":"2px"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"32px","right":"32px"}}},"className":"is-style-outline","fontSize":"16px"} -->
<div class="wp-block-button is-style-outline has-custom-font-size" style="font-size:16px"><a class="wp-block-button__link has-text-color wp-element-button" href="/buyers/catalog/" style="border-radius:12px;border:2px solid #ffffff;color:#ffffff;padding:16px 32px;text-decoration:none;font-weight:600">Подобрать объект</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<p style="font-size:14px;color:#cbd5e0;opacity:0.7;margin-top:24px">Оценка · AI-анализ · Проверка · Сопровождение</p>
</div>
<figure class="de-hero__poster">
<picture>
<source media="(max-width: 767px)" srcset="http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/home-hero-mobile-v2.webp">
<img src="http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/home-hero-desktop-v2.webp" alt="Современный жилой комплекс — экспертные решения для продажи и покупки недвижимости" loading="eager" fetchpriority="high">
</picture>
</figure>
</div>
</div>
<!-- /wp:group -->

<!-- ===== TASK 102: Владельцам ===== -->
<!-- wp:group {"style":{"color":{"background":"#ffffff"},"spacing":{"padding":{"top":"48px","bottom":"48px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#ffffff;padding-top:48px;padding-bottom:48px">
<!-- wp:columns {"style":{"spacing":{"blockGap":"48px"}}} -->
<div class="wp-block-columns">
<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%;">
<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"38px","lineHeight":"1.2"},"color":{"text":"#172033"}},"fontFamily":"cormorant-garamond"} -->
<h2 class="wp-block-heading has-text-color has-cormorant-garamond-font-family" style="color:#172033;font-size:38px;line-height:1.2">Продать квартиру быстро и дорого</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"17px","lineHeight":"1.6"},"color":{"text":"#4a5568"}},"fontFamily":"manrope"} -->
<p class="has-text-color has-manrope-font-family" style="color:#4a5568;font-size:17px;line-height:1.6">80% продавцов теряют деньги из-за неправильной цены и плохой подготовки. Поможем избежать ошибок — бесплатно.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"backgroundColor":"#F5A623","textColor":"#1A202C","style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"14px","bottom":"14px","left":"28px","right":"28px"}}},"fontSize":"15px"} -->
<div class="wp-block-button has-custom-font-size" style="font-size:15px"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="/sell/estimate/" style="border-radius:12px;color:#1A202C;background:#F5A623;padding:14px 28px;text-decoration:none">Оценить недвижимость →</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%","verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%;text-align:right">
<!-- wp:image {"id":292,"sizeSlug":"full","linkDestination":"none","className":"de-poster-round","align":"right"} -->
<figure class="wp-block-image alignright size-full is-resized de-poster-round"><img src="http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/home-sellers-poster-v1.webp" alt="Продажа квартиры: оценка, подготовка и сопровождение" class="wp-image-292" loading="lazy" style="width:100%;max-width:400px;height:auto;border-radius:18px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- ===== TASK 103: Покупателям ===== -->
<!-- wp:group {"style":{"color":{"background":"#F8F9FB"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#F8F9FB;padding-top:48px;padding-bottom:48px">
<!-- wp:columns {"style":{"spacing":{"blockGap":"48px"}}} -->
<div class="wp-block-columns">
<!-- wp:column {"width":"50%","verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%;text-align:center">
<!-- wp:image {"id":293,"sizeSlug":"full","linkDestination":"none","className":"de-poster-round"} -->
<figure class="wp-block-image size-full is-resized de-poster-round"><img src="http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/home-buyers-poster-v1.webp" alt="Покупка квартиры: подбор, проверка и сопровождение" class="wp-image-293" loading="lazy" style="width:100%;max-width:400px;height:auto;border-radius:18px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%;">
<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"38px","lineHeight":"1.2"},"color":{"text":"#172033"}},"fontFamily":"cormorant-garamond"} -->
<h2 class="wp-block-heading has-text-color has-cormorant-garamond-font-family" style="color:#172033;font-size:38px;line-height:1.2">Купить квартиру без сюрпризов</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"17px","lineHeight":"1.6"},"color":{"text":"#4a5568"}},"fontFamily":"manrope"} -->
<p class="has-text-color has-manrope-font-family" style="color:#4a5568;font-size:17px;line-height:1.6">Проверим риски, подберём вариант, проведём сделку. Прозрачно, по шагам, с экспертом.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"backgroundColor":"#F5A623","textColor":"#1A202C","style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"14px","bottom":"14px","left":"28px","right":"28px"}}},"fontSize":"15px"} -->
<div class="wp-block-button has-custom-font-size" style="font-size:15px"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="/buyers/catalog/" style="border-radius:12px;color:#1A202C;background:#F5A623;padding:14px 28px;text-decoration:none">Подобрать объект →</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- ===== TASK 104: Процесс + poster ===== -->
<!-- wp:group {"style":{"color":{"background":"#ffffff"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#ffffff;padding-top:48px;padding-bottom:48px">
<!-- wp:group {"layout":{"type":"constrained","contentSize":"1000px"}} -->
<div class="wp-block-group">
<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"38px","lineHeight":"1.2"},"color":{"text":"#172033"}},"fontFamily":"cormorant-garamond"} -->
<h2 class="wp-block-heading has-text-align-center has-text-color has-cormorant-garamond-font-family" style="color:#172033;font-size:38px;line-height:1.2">Как мы работаем</h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"32px"} -->
<div style="height:32px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"style":{"spacing":{"blockGap":"24px"}}} -->
<div class="wp-block-columns">
<!-- wp:column {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"32px","right":"24px","bottom":"32px","left":"24px"}}},"className":"de-step-card"} -->
<div class="wp-block-column de-step-card" style="border-radius:12px;padding:32px 24px;text-align:center"><p style="font-size:48px;font-weight:300;color:#cbd5e0;line-height:1;margin-bottom:16px">1</p><h3 style="font-size:18px;font-weight:600;color:#172033;margin:0 0 10px">Диагностика</h3><p style="font-size:15px;color:#4a5568;margin:0">Бесплатный AI-анализ объекта или проверка рисков</p></div>
<!-- /wp:column -->
<!-- wp:column {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"32px","right":"24px","bottom":"32px","left":"24px"}}},"className":"de-step-card"} -->
<div class="wp-block-column de-step-card" style="border-radius:12px;padding:32px 24px;text-align:center"><p style="font-size:48px;font-weight:300;color:#cbd5e0;line-height:1;margin-bottom:16px">2</p><h3 style="font-size:18px;font-weight:600;color:#172033;margin:0 0 10px">План</h3><p style="font-size:15px;color:#4a5568;margin:0">Понятная стратегия: цена, сроки, документы</p></div>
<!-- /wp:column -->
<!-- wp:column {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"32px","right":"24px","bottom":"32px","left":"24px"}}},"className":"de-step-card"} -->
<div class="wp-block-column de-step-card" style="border-radius:12px;padding:32px 24px;text-align:center"><p style="font-size:48px;font-weight:300;color:#cbd5e0;line-height:1;margin-bottom:16px">3</p><h3 style="font-size:18px;font-weight:600;color:#172033;margin:0 0 10px">Сделка</h3><p style="font-size:15px;color:#4a5568;margin:0">Сопровождение от показа до регистрации права</p></div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:image {"id":294,"sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full"><img src="http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/home-process-poster-v1.webp" alt="Как мы работаем: диагностика, план, сделка" class="wp-image-294" loading="lazy" style="width:100%;max-width:800px;height:auto;border-radius:18px;margin-top:32px"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- ===== REVIEWS (unchanged) ===== -->
<!-- wp:group {"style":{"color":{"background":"#F8F9FB"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#F8F9FB;padding-top:48px;padding-bottom:48px">
<!-- wp:group {"layout":{"type":"constrained","contentSize":"900px"}} -->
<div class="wp-block-group">
<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"38px","lineHeight":"1.2"},"color":{"text":"#172033"}},"fontFamily":"cormorant-garamond"} -->
<h2 class="wp-block-heading has-text-align-center has-text-color has-cormorant-garamond-font-family" style="color:#172033;font-size:38px;line-height:1.2">Реальные истории клиентов</h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"32px"} -->
<div style="height:32px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"style":{"spacing":{"blockGap":"24px"}}} -->
<div class="wp-block-columns">
<!-- wp:column {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"28px","right":"28px","bottom":"28px","left":"28px"}}},"backgroundColor":"white"} -->
<div class="wp-block-column has-white-background-color has-background" style="border-radius:12px;padding:28px"><p style="color:#2d3748;font-size:16px;font-style:italic;margin:0 0 16px">«Продали на 300 тыс. дороже, чем я рассчитывал»</p><p style="color:#718096;font-size:14px;margin:0">— Антон, Москва</p></div>
<!-- /wp:column -->
<!-- wp:column {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"28px","right":"28px","bottom":"28px","left":"28px"}}},"backgroundColor":"white"} -->
<div class="wp-block-column has-white-background-color has-background" style="border-radius:12px;padding:28px"><p style="color:#2d3748;font-size:16px;font-style:italic;margin:0 0 16px">«Проверили застройщика — оказались суды. Спасибо, что отговорили»</p><p style="color:#718096;font-size:14px;margin:0">— Елена, МО</p></div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<p style="color:#a0aec0;font-size:12px;text-align:center;margin-top:16px">Результат зависит от объекта, рынка и условий сделки.</p>
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- ===== TASKS 106-108: Материалы ===== -->
<!-- wp:group {"style":{"color":{"background":"#ffffff"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#ffffff;padding-top:48px;padding-bottom:48px">
<!-- wp:group {"layout":{"type":"constrained","contentSize":"900px"}} -->
<div class="wp-block-group">
<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"38px","lineHeight":"1.2"},"color":{"text":"#172033"}},"fontFamily":"cormorant-garamond"} -->
<h2 class="wp-block-heading has-text-align-center has-text-color has-cormorant-garamond-font-family" style="color:#172033;font-size:38px;line-height:1.2">База знаний</h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"32px"} -->
<div style="height:32px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"style":{"spacing":{"blockGap":"16px"}}} -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"16px","right":"20px","bottom":"16px","left":"20px"}}},"backgroundColor":"#F8F9FB"} -->
<div class="wp-block-group has-background" style="background:#F8F9FB;border-radius:12px;padding:16px 20px"><p style="font-size:16px;color:#2d3748;margin:0"><a href="/sell/prepare/" style="text-decoration:none;color:#2d3748;display:flex;align-items:center;gap:8px;">📄 Как подготовить квартиру к продаже — чек-лист <span style="margin-left:auto;color:#cbd5e0;">→</span></a></p></div>
<!-- /wp:group -->
<div style="height:8px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"16px","right":"20px","bottom":"16px","left":"20px"}}},"backgroundColor":"#F8F9FB"} -->
<div class="wp-block-group has-background" style="background:#F8F9FB;border-radius:12px;padding:16px 20px"><p style="font-size:16px;color:#2d3748;margin:0"><a href="/buyers/new-vs-resale/" style="text-decoration:none;color:#2d3748;display:flex;align-items:center;gap:8px;">📄 Новостройка или вторичка: сравнение <span style="margin-left:auto;color:#cbd5e0;">→</span></a></p></div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"16px","right":"20px","bottom":"16px","left":"20px"}}},"backgroundColor":"#F8F9FB"} -->
<div class="wp-block-group has-background" style="background:#F8F9FB;border-radius:12px;padding:16px 20px"><p style="font-size:16px;color:#2d3748;margin:0"><a href="/buyers/check-developer/" style="text-decoration:none;color:#2d3748;display:flex;align-items:center;gap:8px;">📄 Как проверить застройщика <span style="margin-left:auto;color:#cbd5e0;">→</span></a></p></div>
<!-- /wp:group -->
<div style="height:8px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"16px","right":"20px","bottom":"16px","left":"20px"}}},"backgroundColor":"#F8F9FB"} -->
<div class="wp-block-group has-background" style="background:#F8F9FB;border-radius:12px;padding:16px 20px"><p style="font-size:16px;color:#2d3748;margin:0"><a href="/buyers/mortgage/" style="text-decoration:none;color:#2d3748;display:flex;align-items:center;gap:8px;">📄 Ипотека: что нужно знать <span style="margin-left:auto;color:#cbd5e0;">→</span></a></p></div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<p style="color:#2f7d46;font-size:15px;text-align:center;margin-top:24px"><a href="/blog/" style="color:#2f7d46;text-decoration:none;font-weight:600">Все материалы →</a></p>

<!-- ===== TASK 106: Materials sellers poster ===== -->
<!-- wp:columns {"style":{"spacing":{"blockGap":"16px","margin":{"top":"32px"}}}} -->
<div class="wp-block-columns" style="margin-top:32px">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:image {"id":296,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/home-materials-sellers-v1.webp" alt="Материалы для владельцев недвижимости" class="wp-image-296" loading="lazy" style="width:100%;height:auto;border-radius:12px"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:image {"id":297,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/home-materials-buyers-v1.webp" alt="Материалы для покупателей недвижимости" class="wp-image-297" loading="lazy" style="width:100%;height:auto;border-radius:12px"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:image {"id":298,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/home-materials-documents-v1.webp" alt="Материалы о документах и рисках" class="wp-image-298" loading="lazy" style="width:100%;height:auto;border-radius:12px"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- ===== TASK 105: CTA Консультация ===== -->
<!-- wp:group {"style":{"color":{"background":"#0A1628"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#0A1628;padding-top:48px;padding-bottom:48px">
<!-- wp:group {"layout":{"type":"constrained","contentSize":"500px"}} -->
<div class="wp-block-group" style="text-align:center">

<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"32px","lineHeight":"1.25"},"color":{"text":"#ffffff"}},"fontFamily":"cormorant-garamond"} -->
<h2 class="wp-block-heading has-text-align-center has-text-color has-cormorant-garamond-font-family" style="color:#ffffff;font-size:32px;line-height:1.25">Давайте начнём!</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px"},"color":{"text":"#cbd5e0"}}} -->
<p class="has-text-align-center has-text-color" style="color:#cbd5e0;font-size:16px">Оставьте заявку — мы перезвоним в рабочее время в течение 30 минут.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":295,"sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full"><img src="http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/home-consultation-poster-v1.webp" alt="Получить консультацию эксперта по недвижимости" class="wp-image-295" loading="lazy" style="width:100%;max-width:400px;height:auto;border-radius:18px;margin-bottom:24px"/></figure>
<!-- /wp:image -->

<form data-stage="2" data-action="consult" style="display:flex;flex-direction:column;gap:16px;" onsubmit="return false;">

<div style="display:flex;gap:8px;justify-content:center;margin-bottom:12px;">
  <span class="step-indicator-1 active" style="width:40px;height:4px;border-radius:2px;background:#F5A623;"></span>
  <span class="step-indicator-2" style="width:40px;height:4px;border-radius:2px;background:rgba(255,255,255,0.3);"></span>
</div>

<div class="form-step-1">
<textarea name="question" placeholder="Что вас интересует? (продажа / покупка / консультация)" rows="3" style="padding:14px 16px;border-radius:8px;border:none;font-size:16px;background:#FFFFFF;color:#172033;width:100%;box-sizing:border-box;resize:vertical;font-family:inherit;"></textarea>
<button type="button" class="btn-next" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;width:100%;">
Далее →
</button>
</div>

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
<button type="submit" class="btn-submit" data-label="Получить консультацию" style="background:#F5A623;color:#1A202C;padding:16px 32px;border-radius:12px;border:none;font-weight:600;font-size:16px;cursor:pointer;">
Получить консультацию
</button>
</div>
</div>
</form>

<script src="/wp-content/scripts/form-handler.js"></script>

</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->
HTML;

// Update the page
$result = wp_update_post(array(
    'ID' => $page_id,
    'post_content' => $new_content
), true);

if (is_wp_error($result)) {
    echo "ERROR: " . $result->get_error_message() . "\n";
} else {
    echo "OK: Page $page_id updated with new poster content.\n";
    echo "New content length: " . strlen($new_content) . " chars\n";
}
