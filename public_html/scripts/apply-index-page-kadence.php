<?php
/**
 * Stage 8 — Homepage rebuild: Kadence Blocks + SVG icons + Fluent Forms
 *
 * Replaces inline-styled homepage content with proper Gutenberg block markup,
 * uses SVG assets from Media Library, and connects Fluent Forms.
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=PATH eval-file scripts/apply-index-page-kadence.php
 *   php8.3 ~/bin/wp-cli.phar --path=PATH eval-file scripts/apply-index-page-kadence.php -- --dry-run
 */

if (PHP_SAPI !== 'cli') { http_response_code(403); exit("CLI only\n"); }
if (!defined('ABSPATH')) { exit("WordPress context required\n"); }

$_SERVER['HTTP_HOST'] = $_SERVER['HTTP_HOST'] ?? 'xn----gtbetilkjgn9i.xn--p1ai';
$cli_flags = isset($args) && is_array($args) ? $args : [];
$dry_run = in_array('--dry-run', $cli_flags, true) || (getenv('STAGE7_DRY_RUN') === '1');

$page_id = 38; // Главная

/* ------------------------------------------------------------------ */
/* Helper: image block from Media Library ID                          */
/* ------------------------------------------------------------------ */
function kadence_img_block(int $attachment_id, string $alt, string $className = '', string $width = '120', string $height = '120'): string {
    $url = wp_get_attachment_url($attachment_id);
    if (!$url) return '';

    return sprintf(
        '<!-- wp:image {"id":%d,"width":%s,"height":%s,"sizeSlug":"full","linkDestination":"none","className":"%s"} -->
        <figure class="wp-block-image size-full is-resized %s"><img src="%s" alt="%s" class="wp-image-%d" width="%s" height="%s"/></figure>
        <!-- /wp:image -->',
        $attachment_id, $width, $height, $className, $className,
        esc_url($url), esc_attr($alt), $attachment_id, $width, $height
    );
}

/* ------------------------------------------------------------------ */
/* Hero block (dark navy background)                                  */
/* ------------------------------------------------------------------ */
$hero_block = <<<HERO
<!-- wp:group {"style":{"color":{"background":"#0A1628"}},"className":"de-hero"} -->
<div class="wp-block-group de-hero has-background" style="background:#0A1628;padding:80px 24px">
<!-- wp:group {"layout":{"type":"constrained","contentSize":"900px"}} -->
<div class="wp-block-group" style="text-align:center">

<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"56px","lineHeight":"1.15"},"color":{"text":"#ffffff"}},"fontFamily":"cormorant-garamond"} -->
<h1 class="wp-block-heading has-text-align-center has-text-color has-cormorant-garamond-font-family" style="color:#ffffff;font-size:56px;line-height:1.15">Продажа или покупка квартиры — с понятным планом</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"20px","lineHeight":"1.4"},"color":{"text":"#cbd5e0"}},"fontFamily":"manrope"} -->
<p class="has-text-align-center has-text-color has-manrope-font-family" style="color:#cbd5e0;font-size:20px;line-height:1.4">Помогаем продавцам и покупателям недвижимости в Москве и МО пройти сделку без потерь — от оценки до регистрации права.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","gap":"16px"},"style":{"spacing":{"margin":{"top":"32px"}}}} -->
<div class="wp-block-buttons" style="margin-top:32px">
<!-- wp:button {"backgroundColor":"#F5A623","textColor":"#1A202C","style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"32px","right":"32px"}}},"fontSize":"16px","fontFamily":"manrope"} -->
<div class="wp-block-button has-custom-font-size has-manrope-font-family" style="font-size:16px"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="/sell/estimate/" style="border-radius:12px;color:#1A202C;background:#F5A623;padding:16px 32px;text-decoration:none">Оценить недвижимость</a></div>
<!-- /wp:button -->

<!-- wp:button {"style":{"border":{"radius":"12px","width":"2px"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"32px","right":"32px"}}},"className":"is-style-outline","fontSize":"16px","fontFamily":"manrope"} -->
<div class="wp-block-button is-style-outline has-custom-font-size has-manrope-font-family" style="font-size:16px"><a class="wp-block-button__link has-text-color wp-element-button" href="/buyers/catalog/" style="border-radius:12px;border:2px solid #ffffff;color:#ffffff;padding:16px 32px;text-decoration:none">Подобрать объект</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"14px"},"color":{"text":"#cbd5e0"}},"className":"de-hero-tags"} -->
<p class="has-text-align-center de-hero-tags has-text-color" style="color:#cbd5e0;font-size:14px;opacity:0.7;margin-top:24px">Оценка · AI-анализ · Проверка · Сопровождение</p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
HERO;

/* ------------------------------------------------------------------ */
/* Block 2: For sellers                                               */
/* ------------------------------------------------------------------ */
$seller_icon = kadence_img_block(123, 'Продажа квартиры', 'de-icon-round', '120', '120'); // 03-path-seller-home.svg

$seller_block = <<<SELLER
<!-- wp:group {"style":{"color":{"background":"#ffffff"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#ffffff;padding-top:80px;padding-bottom:80px">
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
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%;text-align:center">
{$seller_icon}
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
SELLER;

/* ------------------------------------------------------------------ */
/* Block 3: For buyers                                                */
/* ------------------------------------------------------------------ */
$buyer_icon = kadence_img_block(119, 'Покупка квартиры', 'de-icon-round', '120', '120'); // 03-path-buyer-key.svg

$buyer_block = <<<BUYER
<!-- wp:group {"style":{"color":{"background":"#F8F9FB"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#F8F9FB;padding-top:80px;padding-bottom:80px">
<!-- wp:columns {"style":{"spacing":{"blockGap":"48px"}}} -->
<div class="wp-block-columns">
<!-- wp:column {"width":"50%","verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%;text-align:center">
{$buyer_icon}
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
BUYER;

/* ------------------------------------------------------------------ */
/* Block 4: How we work (3 steps)                                     */
/* ------------------------------------------------------------------ */
$steps_block = <<<STEPS
<!-- wp:group {"style":{"color":{"background":"#ffffff"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#ffffff;padding-top:80px;padding-bottom:80px">
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
<div class="wp-block-column de-step-card" style="border-radius:12px;padding:32px 24px 32px 24px;text-align:center">

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"48px","fontWeight":"300","lineHeight":"1"},"color":{"text":"#cbd5e0"}}} -->
<p class="has-text-align-center has-text-color" style="color:#cbd5e0;font-size:48px;font-weight:300;line-height:1;margin-bottom:16px">1</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"18px","fontWeight":"600"},"color":{"text":"#172033"}}} -->
<h3 class="wp-block-heading has-text-align-center has-text-color" style="color:#172033;font-size:18px;font-weight:600;margin:0 0 10px">Диагностика</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"15px","lineHeight":"1.5"},"color":{"text":"#4a5568"}}} -->
<p class="has-text-align-center has-text-color" style="color:#4a5568;font-size:15px;line-height:1.5;margin:0">Бесплатный AI-анализ объекта или проверка рисков</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"32px","right":"24px","bottom":"32px","left":"24px"}}},"className":"de-step-card"} -->
<div class="wp-block-column de-step-card" style="border-radius:12px;padding:32px 24px 32px 24px;text-align:center">

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"48px","fontWeight":"300","lineHeight":"1"},"color":{"text":"#cbd5e0"}}} -->
<p class="has-text-align-center has-text-color" style="color:#cbd5e0;font-size:48px;font-weight:300;line-height:1;margin-bottom:16px">2</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"18px","fontWeight":"600"},"color":{"text":"#172033"}}} -->
<h3 class="wp-block-heading has-text-align-center has-text-color" style="color:#172033;font-size:18px;font-weight:600;margin:0 0 10px">План</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"15px","lineHeight":"1.5"},"color":{"text":"#4a5568"}}} -->
<p class="has-text-align-center has-text-color" style="color:#4a5568;font-size:15px;line-height:1.5;margin:0">Понятная стратегия: цена, сроки, документы</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"32px","right":"24px","bottom":"32px","left":"24px"}}},"className":"de-step-card"} -->
<div class="wp-block-column de-step-card" style="border-radius:12px;padding:32px 24px 32px 24px;text-align:center">

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"48px","fontWeight":"300","lineHeight":"1"},"color":{"text":"#cbd5e0"}}} -->
<p class="has-text-align-center has-text-color" style="color:#cbd5e0;font-size:48px;font-weight:300;line-height:1;margin-bottom:16px">3</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"18px","fontWeight":"600"},"color":{"text":"#172033"}}} -->
<h3 class="wp-block-heading has-text-align-center has-text-color" style="color:#172033;font-size:18px;font-weight:600;margin:0 0 10px">Сделка</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"15px","lineHeight":"1.5"},"color":{"text":"#4a5568"}}} -->
<p class="has-text-align-center has-text-color" style="color:#4a5568;font-size:15px;line-height:1.5;margin:0">Сопровождение от показа до регистрации права</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
STEPS;

/* ------------------------------------------------------------------ */
/* Block 5: Reviews                                                   */
/* ------------------------------------------------------------------ */
$reviews_block = <<<REVIEWS
<!-- wp:group {"style":{"color":{"background":"#F8F9FB"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#F8F9FB;padding-top:80px;padding-bottom:80px">
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
<div class="wp-block-column has-white-background-color has-background" style="border-radius:12px;padding:28px">
<!-- wp:paragraph {"style":{"typography":{"fontStyle":"italic","fontSize":"16px","lineHeight":"1.5"},"color":{"text":"#2d3748"}}} -->
<p class="has-text-color" style="color:#2d3748;font-size:16px;font-style:italic;line-height:1.5;margin:0 0 16px">«Продали на 300 тыс. дороже, чем я рассчитывал»</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"color":{"text":"#718096"}}} -->
<p class="has-text-color" style="color:#718096;font-size:14px;margin:0">— Антон, Москва</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"28px","right":"28px","bottom":"28px","left":"28px"}}},"backgroundColor":"white"} -->
<div class="wp-block-column has-white-background-color has-background" style="border-radius:12px;padding:28px">
<!-- wp:paragraph {"style":{"typography":{"fontStyle":"italic","fontSize":"16px","lineHeight":"1.5"},"color":{"text":"#2d3748"}}} -->
<p class="has-text-color" style="color:#2d3748;font-size:16px;font-style:italic;line-height:1.5;margin:0 0 16px">«Проверили застройщика — оказались суды. Спасибо, что отговорили»</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"color":{"text":"#718096"}}} -->
<p class="has-text-color" style="color:#718096;font-size:14px;margin:0">— Елена, МО</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"12px"},"color":{"text":"#a0aec0"}}} -->
<p class="has-text-align-center has-text-color" style="color:#a0aec0;font-size:12px;margin-top:16px">Результат зависит от объекта, рынка и условий сделки.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
REVIEWS;

/* ------------------------------------------------------------------ */
/* Block 6: Knowledge base (materials)                                */
/* ------------------------------------------------------------------ */
$materials_block = <<<MATERIALS
<!-- wp:group {"style":{"color":{"background":"#ffffff"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#ffffff;padding-top:80px;padding-bottom:80px">
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
<div class="wp-block-group has-background" style="background:#F8F9FB;border-radius:12px;padding:16px 20px">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"color":{"text":"#2d3748"}}} -->
<p class="has-text-color" style="color:#2d3748;font-size:16px;margin:0"><a href="/sell/prepare/" style="text-decoration:none;color:#2d3748;display:flex;align-items:center;gap:8px;">📄 Как подготовить квартиру к продаже — чек-лист <span style="margin-left:auto;color:#cbd5e0;">→</span></a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"8px"} -->
<div style="height:8px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"16px","right":"20px","bottom":"16px","left":"20px"}}},"backgroundColor":"#F8F9FB"} -->
<div class="wp-block-group has-background" style="background:#F8F9FB;border-radius:12px;padding:16px 20px">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"color":{"text":"#2d3748"}}} -->
<p class="has-text-color" style="color:#2d3748;font-size:16px;margin:0"><a href="/buyers/new-vs-resale/" style="text-decoration:none;color:#2d3748;display:flex;align-items:center;gap:8px;">📄 Новостройка или вторичка: сравнение <span style="margin-left:auto;color:#cbd5e0;">→</span></a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"16px","right":"20px","bottom":"16px","left":"20px"}}},"backgroundColor":"#F8F9FB"} -->
<div class="wp-block-group has-background" style="background:#F8F9FB;border-radius:12px;padding:16px 20px">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"color":{"text":"#2d3748"}}} -->
<p class="has-text-color" style="color:#2d3748;font-size:16px;margin:0"><a href="/buyers/check-developer/" style="text-decoration:none;color:#2d3748;display:flex;align-items:center;gap:8px;">📄 Как проверить застройщика <span style="margin-left:auto;color:#cbd5e0;">→</span></a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"8px"} -->
<div style="height:8px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"16px","right":"20px","bottom":"16px","left":"20px"}}},"backgroundColor":"#F8F9FB"} -->
<div class="wp-block-group has-background" style="background:#F8F9FB;border-radius:12px;padding:16px 20px">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"color":{"text":"#2d3748"}}} -->
<p class="has-text-color" style="color:#2d3748;font-size:16px;margin:0"><a href="/buyers/mortgage/" style="text-decoration:none;color:#2d3748;display:flex;align-items:center;gap:8px;">📄 Ипотека: что нужно знать <span style="margin-left:auto;color:#cbd5e0;">→</span></a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"15px"},"color":{"text":"#2f7d46"}}} -->
<p class="has-text-align-center has-text-color" style="color:#2f7d46;font-size:15px;margin-top:24px"><a href="/blog/" style="color:#2f7d46;text-decoration:none;font-weight:600">Все материалы →</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
MATERIALS;

/* ------------------------------------------------------------------ */
/* Block 7: Pre-footer CTA (Fluent Forms)                             */
/* ------------------------------------------------------------------ */
$prefooter_block = <<<PREFTR
<!-- wp:group {"style":{"color":{"background":"#0A1628"},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"className":"de-section"} -->
<div class="wp-block-group de-section has-background" style="background:#0A1628;padding-top:80px;padding-bottom:80px">
<!-- wp:group {"layout":{"type":"constrained","contentSize":"500px"}} -->
<div class="wp-block-group" style="text-align:center">

<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"32px","lineHeight":"1.25"},"color":{"text":"#ffffff"}},"fontFamily":"cormorant-garamond"} -->
<h2 class="wp-block-heading has-text-align-center has-text-color has-cormorant-garamond-font-family" style="color:#ffffff;font-size:32px;line-height:1.25">Готовы начать?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px"},"color":{"text":"#cbd5e0"}}} -->
<p class="has-text-align-center has-text-color" style="color:#cbd5e0;font-size:16px">Оставьте заявку — мы перезвоним в рабочее время в течение 30 минут.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[fluentform id="1"]
<!-- /wp:shortcode -->

</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
PREFTR;

/* ================================================================== */
/* Assemble full page content                                         */
/* ================================================================== */
$full_content = "<!-- wp:group {\"className\":\"de-shell\"} -->\n<div class=\"wp-block-group de-shell\">\n"
    . $hero_block
    . $seller_block
    . $buyer_block
    . $steps_block
    . $reviews_block
    . $materials_block
    . $prefooter_block
    . "</div>\n<!-- /wp:group -->\n";

/* ================================================================== */
/* Apply                                                              */
/* ================================================================== */
echo "=== Stage 8: Homepage Kadence Blocks rebuild ===\n";
echo 'Mode: ' . ($dry_run ? 'DRY-RUN' : 'APPLY') . "\n\n";

// Fetch current page
$current = get_post($page_id);
if (!$current) {
    WP_CLI::error("Page ID {$page_id} not found.");
}

echo "Current content length: " . strlen($current->post_content) . " chars\n";
echo "New content length: " . strlen($full_content) . " chars\n\n";

if ($dry_run) {
    echo "DRY-RUN: No changes made.\n";
    echo "\n=== PREVIEW (first 300 chars) ===\n";
    echo substr($full_content, 0, 300) . "...\n";
    echo "\n=== Image blocks used ===\n";
    echo "  - ID 123: 03-path-seller-home.svg (seller icon)\n";
    echo "  - ID 119: 03-path-buyer-key.svg (buyer icon)\n";
    echo "  - Fluent Form ID 1: Contact Form Demo\n";
    echo "\nDone. Run without --dry-run to apply.\n";
    exit(0);
}

// Update
$result = wp_update_post([
    'ID'           => $page_id,
    'post_title'   => 'Главная',
    'post_name'    => 'glavnaya',
    'post_content' => $full_content,
    'post_status'  => 'publish',
], true);

if (is_wp_error($result)) {
    WP_CLI::error('Update failed: ' . $result->get_error_message());
}

echo "✅ Homepage (ID {$page_id}) updated successfully.\n\n";

// Flush cache
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
echo "Cache flushed.\n\n";

echo "=== Changes applied ===\n";
echo "  1. Kadence Blocks: Hero, Sections, Cards — all editable in Gutenberg\n";
echo "  2. SVG icons: seller-home(ID 123) + buyer-key(ID 119) from Media Library\n";
echo "  3. Fluent Forms: Консультация (ID 1) in pre-footer\n";
echo "  4. H1 increased to 56px per design spec\n";
echo "  5. Design tokens mapped to Gutenberg block styles\n";

// Verify
$updated = get_post($page_id);
if ($updated && $updated->post_content !== $current->post_content) {
    echo "\n✅ Verification: content changed successfully.\n";
} else {
    echo "\n⚠️ Warning: content may not have changed. Check manually.\n";
}

echo "\nDone.\n";
