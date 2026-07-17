# Plugin-First Design Preview Implementation Plan

**Project:** Дом-эксперт.рф (site_re)  
**Design Version:** v1.2 — "Экспертность + доверие"  
**Approach:** Plugin-first / minimal-code, no custom PHP  
**Status:** Implementation plan (no code changes yet)

---

## 1. Executive Summary

This plan enables user-testable design preview using **TwentyTwentyFive block theme + Gutenberg blocks + ready plugins**, avoiding all custom PHP/theme modifications. The custom theme `site-re-theme` caused 500 errors and must remain rolled back.

**Strategy:** Seed WordPress database with pages containing Gutenberg block markup that maps 1:1 to the approved design system. CSS custom properties override theme defaults without custom CSS files.

---

## 2. Architecture Decision

| Approach | Pros | Cons | Verdict |
|----------|------|------|---------|
| Custom theme (site-re-theme) | Full control | 500 errors, maintenance burden, PHP required | ❌ Rejected |
| Child theme of TwentyTwentyFive | Some customization | Still PHP, theme dependency | ❌ Rejected |
| **Plugin + TwentyTwentyFive** | Zero PHP, rollback-safe, Gutenberg-native | Limited interactivity | ✅ **Selected** |

---

## 3. Required Plugins (Install via WordPress Admin)

### 3.1 Must-Have Plugins

| Plugin | Purpose | Why |
|--------|---------|-----|
| **Custom CSS & JS** | Inject CSS variables from design system | Override theme colors/typography without child theme |
| **WPCode** (or similar) | Insert `<style>` block site-wide | Alternative to Custom CSS & JS |
| **Advanced Custom Fields** | Already installed via site-re-core | Keep active for future CPT fields |
| **Site Re Core** | Custom post types (property, developer, review, FAQ, glossary) | Keep active, but not required for preview |

### 3.2 Optional Enhancement Plugins

| Plugin | Purpose |
|--------|---------|
| **Kadence Blocks** | Extended block library (tabs, accordions, icons) |
| **Spectra** (formerly Spectra) | More block patterns |
| **Starter Templates** | Pre-built page templates to import |

### 3.3 WordPress Settings to Configure

```php
// wp_options settings (via admin or wp-cli)
// These are standard WordPress settings, not custom code

// 1. Permalink structure
// Settings > Permalinks > Post name
set_option('permalink_structure', '/%postname%/');
set_option('category_base', '');
set_option('tag_base', '');

// 2. Reading settings
// Settings > Reading > Static page = Yes, Homepage = "Главная", Posts page = "Блог"
set_option('show_on_front', 'page');
set_option('page_on_front', {FRONT_PAGE_ID});  // Set after page creation
set_option('page_for_posts', {BLOG_PAGE_ID});  // Set after page creation

// 3. Discussion settings
set_option('default_comment_status', 'closed');  // No comments by default

// 4. Media settings
set_option('thumbnail_size_w', 400);
set_option('thumbnail_size_h', 300);
set_option('medium_size_w', 800);
set_option('medium_size_h', 600);
```

---

## 4. Pages to Seed (Gutenberg Block Markup)

### 4.1 Page List

| Page | Slug | Template | Purpose |
|------|------|----------|---------|
| Главная | `/` | Page (default) | Hero + Seller/Buyer bifurcation + tools + trust |
| Продать квартиру | `/sell/` | Page (default) | Seller landing |
| Купить квартиру | `/buyers/` | Page (default) | Buyer landing |
| Каталог объектов | `/catalog/` | Page (default) | Property catalog |
| Инструменты | `/tools/` | Page (default) | Free diagnostic tools |
| О проекте | `/about/` | Page (default) | About the expert |
| Блог | `/blog/` | Page (default) | Blog listing |
| Контакты | `/contacts/` | Page (default) | Contact information |
| Политика конфиденциальности | `/privacy/` | Page (default) | Legal |
| Пользовательское соглашение | `/terms/` | Page (default) | Legal |

### 4.2 Homepage Block Structure (Detailed)

```html
<!-- wp:group {"className":"de-hero","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group de-hero" style="padding-top:0;padding-bottom:0">

  <!-- wp:cover {"dimRatio":60,"overlayColor":"brand-950","style":{"spacing":{"padding":{"top":"var:preset|spacing|16","bottom":"var:preset|spacing|16"}}}} -->
  <div class="wp-block-cover" style="padding-top:64px;padding-bottom:64px">
    <div aria-hidden="true" class="wp-block-cover__background"></div>
    <div class="wp-block-cover__inner-container">

      <!-- wp:heading {"level":1,"style":{"typography":{"fontFamily":"var:preset|font-family|lora","fontSize":"3rem","lineHeight":"1.12"}}} -->
      <h1 class="wp-block-heading" style="font-family:var(--wp--preset--font-family--lora);font-size:3rem;line-height:1.12">Экспертная оценка недвижимости</h1>
      <!-- /wp:heading -->

      <!-- wp:paragraph {"textColor":"neutral-100","style":{"typography":{"fontSize":"1.25rem"}}} -->
      <p class="has-neutral-100-color has-text-color" style="font-size:1.25rem">Бесплатные инструменты, проверка рисков, объяснение каждого фактора</p>
      <!-- /wp:paragraph -->

      <!-- wp:columns -->
      <div class="wp-block-columns">

        <!-- wp:column {"className":"de-hero-card"} -->
        <div class="wp-block-column de-hero-card">
          <!-- wp:heading {"level":2} -->
          <h2 class="wp-block-heading">Продаю квартиру</h2>
          <!-- /wp:heading -->
          <!-- wp:paragraph -->
          <p>Оценка, фото-чек, диагностика готовности</p>
          <!-- /wp:paragraph -->
          <!-- wp:buttons -->
          <div class="wp-block-buttons">
            <!-- wp:button {"backgroundColor":"action-600","textColor":"neutral-0","className":"is-style-fill"} -->
            <div class="wp-block-button is-style-fill">
              <a class="wp-block-button__link has-action-600-background-color has-neutral-0-color has-text-color has-background" href="/sell/">Начать оценку</a>
            </div>
            <!-- /wp:button -->
          </div>
          <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"de-hero-card"} -->
        <div class="wp-block-column de-hero-card">
          <!-- wp:heading {"level":2} -->
          <h2 class="wp-block-heading">Покупаю квартиру</h2>
          <!-- /wp:heading -->
          <!-- wp:paragraph -->
          <p>Каталог, сравнение, risk-check, проверка</p>
          <!-- /wp:paragraph -->
          <!-- wp:buttons -->
          <div class="wp-block-buttons">
            <!-- wp:button {"backgroundColor":"brand-900","textColor":"neutral-0","className":"is-style-fill"} -->
            <div class="wp-block-button is-style-fill">
              <a class="wp-block-button__link has-brand-900-background-color has-neutral-0-color has-text-color has-background" href="/buyers/">Найти объект</a>
            </div>
            <!-- /wp:button -->
          </div>
          <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

      </div>
      <!-- /wp:columns -->

    </div>
  </div>
  <!-- /wp:cover -->

</div>
<!-- /wp:group -->
```

### 4.3 Trust Strip (Homepage)

```html
<!-- wp:group {"className":"de-trust-strip","style":{"spacing":{"padding":{"top":"var:preset|spacing|12","bottom":"var:preset|spacing|12"}},"color":{"background":"#F4F7FA"}}} -->
<div class="wp-block-group de-trust-strip" style="background-color:#F4F7FA;padding-top:48px;padding-bottom:48px">

  <!-- wp:columns -->
  <div class="wp-block-columns">

    <!-- wp:column -->
    <div class="wp-block-column" style="text-align:center">
      <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"2rem","fontWeight":"700"}}} -->
      <h3 class="wp-block-heading" style="font-size:2rem;font-weight:700">8+</h3>
      <!-- /wp:heading -->
      <!-- wp:paragraph -->
      <p>лет опыта</p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column" style="text-align:center">
      <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"2rem","fontWeight":"700"}}} -->
      <h3 class="wp-block-heading" style="font-size:2rem;font-weight:700">1 200+</h3>
      <!-- /wp:heading -->
      <!-- wp:paragraph -->
      <p>проверок</p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column" style="text-align:center">
      <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"2rem","fontWeight":"700"}}} -->
      <h3 class="wp-block-heading" style="font-size:2rem;font-weight:700">4.9/5</h3>
      <!-- /wp:heading -->
      <!-- wp:paragraph -->
      <p>рейтинг</p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column" style="text-align:center">
      <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem","fontWeight":"600","lineHeight":"1.4"}}} -->
      <h3 class="wp-block-heading" style="font-size:1rem;font-weight:600;line-height:1.4">Независимый эксперт</h3>
      <!-- /wp:heading -->
      <!-- wp:paragraph -->
      <p>не агентство, не застройщик</p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->

  </div>
  <!-- /wp:columns -->

</div>
<!-- /wp:group -->
```

### 4.4 Free Tools Section (Homepage)

```html
<!-- wp:group {"className":"de-tools","style":{"spacing":{"padding":{"top":"var:preset|spacing|16","bottom":"var:preset|spacing|16"}}}} -->
<div class="wp-block-group de-tools" style="padding-top:64px;padding-bottom:64px">

  <!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontFamily":"var:preset|font-family|lora","fontSize":"2.5rem"}}} -->
  <h2 class="wp-block-heading has-text-align-center" style="font-family:var(--wp--preset--font-family--lora);font-size:2.5rem">Бесплатные инструменты</h2>
  <!-- /wp:heading -->

  <!-- wp:paragraph {"textAlign":"center","textColor":"neutral-700","style":{"typography":{"fontSize":"1.125rem"}}} -->
  <p class="has-text-align-center has-neutral-700-color has-text-color" style="font-size:1.125rem">Получите результат до контакта</p>
  <!-- /wp:paragraph -->

  <!-- wp:columns -->
  <div class="wp-block-columns">

    <!-- wp:column {"className":"de-tool-card"} -->
    <div class="wp-block-column de-tool-card">
      <!-- wp:group {"style":{"color":{"background":"#EAF0F6"},"border":{"radius":"18px"},"spacing":{"padding":{"top":"var:preset|spacing|8","bottom":"var:preset|spacing|8","left":"var:preset|spacing|6","right":"var:preset|spacing|6"}}}} -->
      <div class="wp-block-group" style="background-color:#EAF0F6;border-radius:18px;padding-top:32px;padding-bottom:32px;padding-right:24px;padding-left:24px">
        <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"600"}}} -->
        <h3 class="wp-block-heading" style="font-size:1.5rem;font-weight:600">Оценка квартиры</h3>
        <!-- /wp:heading -->
        <!-- wp:paragraph {"textColor":"neutral-700"} -->
        <p class="has-neutral-700-color has-text-color">Диапазон цены с учётом района, состояния и рынка</p>
        <!-- /wp:paragraph -->
        <!-- wp:buttons -->
        <div class="wp-block-buttons">
          <!-- wp:button {"backgroundColor":"action-600","textColor":"neutral-0","className":"is-style-fill"} -->
          <div class="wp-block-button is-style-fill">
            <a class="wp-block-button__link has-action-600-background-color has-neutral-0-color has-text-color has-background" href="/tools/estimate/">Получить оценку</a>
          </div>
          <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column {"className":"de-tool-card"} -->
    <div class="wp-block-column de-tool-card">
      <!-- wp:group {"style":{"color":{"background":"#EAF0F6"},"border":{"radius":"18px"},"spacing":{"padding":{"top":"var:preset|spacing|8","bottom":"var:preset|spacing|8","left":"var:preset|spacing|6","right":"var:preset|spacing|6"}}}} -->
      <div class="wp-block-group" style="background-color:#EAF0F6;border-radius:18px;padding-top:32px;padding-bottom:32px;padding-right:24px;padding-left:24px">
        <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"600"}}} -->
        <h3 class="wp-block-heading" style="font-size:1.5rem;font-weight:600">Фото-чек</h3>
        <!-- /wp:heading -->
        <!-- wp:paragraph {"textColor":"neutral-700"} -->
        <p class="has-neutral-700-color has-text-color">Оценка фотографий объявления и рекомендации</p>
        <!-- /wp:paragraph -->
        <!-- wp:buttons -->
        <div class="wp-block-buttons">
          <!-- wp:button {"backgroundColor":"action-600","textColor":"neutral-0","className":"is-style-fill"} -->
          <div class="wp-block-button is-style-fill">
            <a class="wp-block-button__link has-action-600-background-color has-neutral-0-color has-text-color has-background" href="/tools/photo-check/">Загрузить фото</a>
          </div>
          <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column {"className":"de-tool-card"} -->
    <div class="wp-block-column de-tool-card">
      <!-- wp:group {"style":{"color":{"background":"#EAF0F6"},"border":{"radius":"18px"},"spacing":{"padding":{"top":"var:preset|spacing|8","bottom":"var:preset|spacing|8","left":"var:preset|spacing|6","right":"var:preset|spacing|6"}}}} -->
      <div class="wp-block-group" style="background-color:#EAF0F6;border-radius:18px;padding-top:32px;padding-bottom:32px;padding-right:24px;padding-left:24px">
        <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"600"}}} -->
        <h3 class="wp-block-heading" style="font-size:1.5rem;font-weight:600">Risk-check</h3>
        <!-- /wp:heading -->
        <!-- wp:paragraph {"textColor":"neutral-700"} -->
        <p class="has-neutral-700-color has-text-color">Проверка объекта на юридические и инфраструктурные риски</p>
        <!-- /wp:paragraph -->
        <!-- wp:buttons -->
        <div class="wp-block-buttons">
          <!-- wp:button {"backgroundColor":"action-600","textColor":"neutral-0","className":"is-style-fill"} -->
          <div class="wp-block-button is-style-fill">
            <a class="wp-block-button__link has-action-600-background-color has-neutral-0-color has-text-color has-background" href="/tools/risk-check/">Проверить объект</a>
          </div>
          <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:column -->

  </div>
  <!-- /wp:columns -->

</div>
<!-- /wp:group -->
```

### 4.5 CTA Section (Homepage)

```html
<!-- wp:group {"className":"de-cta","style":{"spacing":{"padding":{"top":"var:preset|spacing|16","bottom":"var:preset|spacing|16"}},"color":{"background":"#0B1F3A"}}} -->
<div class="wp-block-group de-cta" style="background-color:#0B1F3A;padding-top:64px;padding-bottom:64px">

  <!-- wp:columns -->
  <div class="wp-block-columns">

    <!-- wp:column -->
    <div class="wp-block-column" style="display:flex;flex-direction:column;justify-content:center">
      <!-- wp:heading {"level":2,"textColor":"neutral-0","style":{"typography":{"fontFamily":"var:preset|font-family|lora","fontSize":"2.5rem"}}} -->
      <h2 class="wp-block-heading has-neutral-0-color has-text-color" style="font-family:var(--wp--preset--font-family--lora);font-size:2.5rem">Обсудите выводы с экспертом</h2>
      <!-- /wp:heading -->
      <!-- wp:paragraph {"textColor":"neutral-300","style":{"typography":{"fontSize":"1.125rem"}}} -->
      <p class="has-neutral-300-color has-text-color" style="font-size:1.125rem">Бесплатная 20-минутная консультация по результатам проверки</p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column {"style":{"spacing":{"padding":{"left":"var:preset|spacing|8"}}}} -->
    <div class="wp-block-column" style="padding-left:32px">
      <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
      <div class="wp-block-buttons" style="justify-content:center;display:flex">
        <!-- wp:button {"backgroundColor":"action-600","textColor":"neutral-0","className":"is-style-fill","style":{"typography":{"fontSize":"1.125rem"},"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"2rem","right":"2rem"}}}} -->
        <div class="wp-block-button is-style-fill" style="font-size:1.125rem">
          <a class="wp-block-button__link has-action-600-background-color has-neutral-0-color has-text-color has-background" href="/contacts/">Записаться на консультацию</a>
        </div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->

  </div>
  <!-- /wp:columns -->

</div>
<!-- /wp:group -->
```

---

## 5. CSS Custom Properties Injection

### 5.1 Theme.json Override (Preferred)

Create `child-theme/theme.json` in TwentyTwentyFive child theme directory. **However**, since we cannot create custom PHP files, we use **WPCode plugin** to inject `<style>` block.

### 5.2 CSS Variables to Inject (via WPCode or Custom CSS plugin)

```css
/* === Дом-эксперт.рф Design System CSS Variables === */
/* Source: design_iterations/dom-expert-design-final-v1.2/02-design-system.json */

:root {
  /* Brand Colors */
  --de-color-brand-950: #071426;
  --de-color-brand-900: #0B1F3A;
  --de-color-brand-800: #123155;
  --de-color-brand-700: #1B456E;
  --de-color-brand-100: #EAF0F6;
  --de-color-brand-50: #F4F7FA;

  /* Action Colors */
  --de-color-action-700: #23644F;
  --de-color-action-600: #2F7D62;
  --de-color-action-500: #3D9274;
  --de-color-action-100: #DDEFE8;
  --de-color-action-50: #F1F8F5;

  /* Neutral Colors */
  --de-color-neutral-1000: #101722;
  --de-color-neutral-900: #172033;
  --de-color-neutral-700: #455064;
  --de-color-neutral-600: #5D687B;
  --de-color-neutral-500: #7E8796;
  --de-color-neutral-400: #A8AFBA;
  --de-color-neutral-300: #CDD2D9;
  --de-color-neutral-200: #E2E5E9;
  --de-color-neutral-100: #EEF0F2;
  --de-color-neutral-50: #F7F7F6;
  --de-color-neutral-0: #FFFFFF;

  /* Warm Colors */
  --de-color-warm-100: #EEEAE2;
  --de-color-warm-50: #F7F5F0;

  /* Info Colors */
  --de-color-info-700: #225B96;
  --de-color-info-100: #DCEBFA;
  --de-color-info-50: #F1F7FD;

  /* Warning Colors */
  --de-color-warning-700: #8A5A0A;
  --de-color-warning-600: #B77913;
  --de-color-warning-100: #F8E8BF;
  --de-color-warning-50: #FFF8E8;

  /* Danger Colors */
  --de-color-danger-700: #982F36;
  --de-color-danger-600: #C54850;
  --de-color-danger-100: #F6DADD;
  --de-color-danger-50: #FFF2F3;

  /* Risk Scores */
  --de-risk-excellent-fg: #23644F;
  --de-risk-excellent-bg: #DDEFE8;
  --de-risk-good-fg: #2F7D62;
  --de-risk-good-bg: #EAF5F0;
  --de-risk-attention-fg: #8A5A0A;
  --de-risk-attention-bg: #FFF3D6;
  --de-risk-high-fg: #A5442F;
  --de-risk-high-bg: #FBE2D9;
  --de-risk-critical-fg: #982F36;
  --de-risk-critical-bg: #F6DADD;
  --de-risk-unknown-fg: #5D687B;
  --de-risk-unknown-bg: #EEF0F2;

  /* Spacing */
  --de-space-0: 0;
  --de-space-1: 4px;
  --de-space-2: 8px;
  --de-space-3: 12px;
  --de-space-4: 16px;
  --de-space-5: 20px;
  --de-space-6: 24px;
  --de-space-8: 32px;
  --de-space-10: 40px;
  --de-space-12: 48px;
  --de-space-16: 64px;
  --de-space-20: 80px;
  --de-space-24: 96px;
  --de-space-32: 128px;

  /* Layout */
  --de-content-max: 1296px;
  --de-reading-max: 760px;
  --de-page-gutter-desktop: 72px;
  --de-page-gutter-tablet: 32px;
  --de-page-gutter-mobile: 20px;
  --de-section-gap-desktop: 96px;
  --de-section-gap-mobile: 64px;

  /* Radius */
  --de-radius-xs: 6px;
  --de-radius-sm: 10px;
  --de-radius-md: 14px;
  --de-radius-card: 18px;
  --de-radius-lg: 24px;
  --de-radius-xl: 32px;
  --de-radius-pill: 999px;

  /* Shadows */
  --de-shadow-xs: 0 1px 2px rgba(11,31,58,0.06);
  --de-shadow-sm: 0 4px 16px rgba(11,31,58,0.08);
  --de-shadow-card: 0 10px 32px rgba(11,31,58,0.10);
  --de-shadow-elevated: 0 18px 56px rgba(11,31,58,0.16);
  --de-shadow-focus: 0 0 0 4px rgba(47,125,98,0.20);

  /* Typography */
  --de-font-display: 'Lora', Georgia, 'Times New Roman', serif;
  --de-font-body: 'Inter', Arial, sans-serif;
  --de-font-mono: 'IBM Plex Mono', Consolas, monospace;
}

/* === Theme Palette Override === */
/* Map TwentyTwentyFive color slugs to design system values */

/* In theme.json, override palette:
{
  "settings": {
    "color": {
      "palette": [
        {"color": "#FFFFFF", "name": "Base", "slug": "base"},
        {"color": "#172033", "name": "Contrast", "slug": "contrast"},
        {"color": "#2F7D62", "name": "Accent 1", "slug": "accent-1"},
        {"color": "#0B1F3A", "name": "Accent 2", "slug": "accent-2"},
        {"color": "#EAF0F6", "name": "Accent 3", "slug": "accent-3"},
        {"color": "#F7F5F0", "name": "Accent 4", "slug": "accent-4"},
        {"color": "#EEF0F2", "name": "Accent 5", "slug": "accent-5"},
        {"color": "#CDD2D9", "name": "Accent 6", "slug": "accent-6"}
      ]
    }
  }
}
*/

/* === Component Styles === */

/* Hero Cards */
.de-hero-card {
  background: rgba(255, 255, 255, 0.08);
  border-radius: var(--de-radius-card);
  padding: var(--de-space-8);
  border: 1px solid rgba(255, 255, 255, 0.12);
}

/* Tool Cards */
.de-tool-card .wp-block-group {
  box-shadow: var(--de-shadow-sm);
  transition: transform 200ms ease, box-shadow 200ms ease;
}

.de-tool-card .wp-block-group:hover {
  transform: translateY(-2px);
  box-shadow: var(--de-shadow-card);
}

/* Risk Badges */
.de-risk-excellent { background: var(--de-risk-excellent-bg); color: var(--de-risk-excellent-fg); }
.de-risk-good { background: var(--de-risk-good-bg); color: var(--de-risk-good-fg); }
.de-risk-attention { background: var(--de-risk-attention-bg); color: var(--de-risk-attention-fg); }
.de-risk-high { background: var(--de-risk-high-bg); color: var(--de-risk-high-fg); }
.de-risk-critical { background: var(--de-risk-critical-bg); color: var(--de-risk-critical-fg); }

/* Property Card */
.de-property-card {
  border-radius: var(--de-radius-card);
  box-shadow: var(--de-shadow-sm);
  overflow: hidden;
  transition: transform 200ms ease, box-shadow 200ms ease;
}

.de-property-card:hover {
  transform: translateY(-2px);
  box-shadow: var(--de-shadow-card);
}

.de-property-card img {
  aspect-ratio: 4 / 3;
  object-fit: cover;
}

.de-property-card .price {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--de-color-neutral-900);
}

.de-property-card .price-per-meter {
  font-size: 0.875rem;
  color: var(--de-color-neutral-600);
}

/* Disclaimer Block */
.de-disclaimer {
  background: var(--de-color-brand-50);
  border: 1px solid var(--de-color-neutral-300);
  border-radius: var(--de-radius-md);
  padding: var(--de-space-6);
  font-size: 0.8125rem;
  line-height: 1.5;
  color: var(--de-color-neutral-700);
}

.de-disclaimer::before {
  content: "ℹ";
  margin-right: var(--de-space-2);
  color: var(--de-color-info-700);
}

/* Sticky Mobile CTA */
@media (max-width: 768px) {
  .de-sticky-cta {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: 72px;
    background: rgba(255, 255, 255, 0.96);
    border-top: 1px solid var(--de-color-neutral-200);
    box-shadow: 0 -8px 24px rgba(11,31,58,0.10);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    padding-bottom: env(safe-area-inset-bottom);
  }
}

/* Page Layout */
.wp-site-blocks {
  max-width: var(--de-content-max);
  margin: 0 auto;
}

/* Section Spacing */
.de-section {
  padding: var(--de-section-gap-desktop) var(--de-page-gutter-desktop);
}

@media (max-width: 768px) {
  .de-section {
    padding: var(--de-section-gap-mobile) var(--de-page-gutter-mobile);
  }
}

/* Button Overrides */
.wp-block-button__link {
  border-radius: var(--de-radius-sm) !important;
  font-weight: 600 !important;
  min-height: 48px;
  padding: 0 var(--de-space-6) !important;
}

/* Header Override */
@media (min-width: 769px) {
  .wp-block-navigation {
    height: 72px;
  }
}

@media (max-width: 768px) {
  .wp-block-navigation {
    height: 64px;
  }
}
```

---

## 6. Gutenberg Patterns to Create

### 6.1 Pattern Registry (via wp-block-patterns.php or plugins)

| Pattern Name | Description | Blocks Used |
|--------------|-------------|-------------|
| `de/hero-split` | Hero with Seller/Buyer cards | group, heading, paragraph, columns, buttons |
| `de/trust-strip` | Trust metrics row | group, columns, heading, paragraph |
| `de/tool-card` | Single tool card | group, heading, paragraph, button |
| `de/cta-banner` | CTA section with expert | group, columns, heading, paragraph, button |
| `de/property-card` | Property listing card | group, image, heading, paragraph |
| `de/risk-badge` | Risk score indicator | group, heading, paragraph |
| `de/disclaimer` | Legal disclaimer block | group, paragraph |
| `de/empty-state` | Empty results state | group, heading, paragraph, buttons |

### 6.2 Pattern Registration (Plugin approach)

Since we cannot create PHP files, use **Kadence Blocks** or **Spectra** to create custom block patterns via their visual builders.

---

## 7. WordPress Options to Set

### 7.1 Via Admin Panel (Manual)

| Setting | Path | Value |
|---------|------|-------|
| Site Title | Settings > General | Дом-эксперт.рф |
| Tagline | Settings > General | Экспертная оценка недвижимости |
| Timezone | Settings > General | Europe/Moscow |
| Date Format | Settings > General | d.m.Y |
| Permalink | Settings > Permalinks | /%postname%/ |
| Front Page | Settings > Reading | Static → Главная |
| Posts Page | Settings > Reading | Static → Блог |
| Comments | Settings > Discussion | Disable by default |
| Media | Settings > Media | Thumbnail 400×300, Medium 800×600 |

### 7.2 Via WP-CLI (Alternative)

```bash
# Site identity
wp option update blogname "Дом-эксперт.рф"
wp option update blogdescription "Экспертная оценка недвижимости"

# Permalink structure
wp rewrite structure '/%postname%/' --hard

# Reading settings
wp option update show_on_front "page"
wp option update page_on_front $(wp post list --post_type=page --name=main --field=ID)
wp option update page_for_posts $(wp post list --post_type=page --name=blog --field=ID)

# Discussion
wp option update default_comment_status "closed"

# Media
wp option update thumbnail_size_w 400
wp option update thumbnail_size_h 300
wp option update medium_size_w 800
wp option update medium_size_h 600
```

---

## 8. Implementation Steps

### Phase 1: Environment Setup (30 min)

1. **Deactivate custom theme**
   - Theme is already rolled back to TwentyTwentyFive
   - Verify: `wp theme status twentytwentyfive` shows active

2. **Install required plugins**
   - Custom CSS & JS (or WPCode)
   - Kadence Blocks (for extended blocks)
   - Verify: `wp plugin list`

3. **Set WordPress options**
   - Follow Section 7 above
   - Verify: `wp option get blogname`

### Phase 2: Design System Injection (45 min)

1. **Inject CSS variables**
   - Use Custom CSS & JS plugin
   - Paste CSS from Section 5.2
   - Verify: Inspect `:root` in browser dev tools

2. **Load Google Fonts (Lora + Inter)**
   - Add to Custom CSS & JS plugin header:
   ```html
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">
   ```
   - Verify: Fonts load in Network tab

### Phase 3: Page Creation (2 hours)

1. **Create pages via Gutenberg**
   - Use block markup from Section 4
   - Start with Homepage
   - Verify: Page renders correctly

2. **Create remaining pages**
   - /sell/, /buyers/, /catalog/, /tools/, /about/, /blog/, /contacts/, /privacy/, /terms/
   - Use simplified block structures (hero + content + CTA)

3. **Set menu navigation**
   - Appearance > Menus > Create header menu
   - Items: Главная, Продать, Купить, Каталог, Инструменты, О проекте, Контакты

### Phase 4: Testing (1 hour)

1. **Visual testing**
   - Desktop (1440px)
   - Tablet (768px)
   - Mobile (390px)

2. **Functionality testing**
   - Navigation works
   - Links resolve correctly
   - No 500 errors

3. **Accessibility testing**
   - Keyboard navigation
   - Screen reader compatibility
   - Focus states visible

---

## 9. Validation Steps

### 9.1 Pre-Deployment Checklist

```bash
# 1. Verify theme is TwentyTwentyFive
wp theme status | grep active

# 2. Verify plugins are active
wp plugin list --status=active

# 3. Verify pages exist
wp post list --post_type=page --fields=ID,post_title,post_name

# 4. Verify permalink structure
wp option get permalink_structure

# 5. Verify front page setting
wp option get show_on_front
wp option get page_on_front

# 6. Check for PHP errors
wp eval 'echo "No errors";'

# 7. Verify no custom theme files are loaded
wp eval 'echo wp_get_theme()->get("Name");'
```

### 9.2 Post-Deployment Checklist

```bash
# 1. Test homepage loads
curl -s -o /dev/null -w "%{http_code}" http://site-re.local:8080/

# 2. Test each page loads
for page in sell buyers catalog tools about blog contacts privacy terms; do
  status=$(curl -s -o /dev/null -w "%{http_code}" "http://site-re.local:8080/$page/")
  echo "$page: $status"
done

# 3. Check for 500 errors
grep -r "500" /var/log/apache2/error.log

# 4. Verify CSS variables load
curl -s http://site-re.local:8080/ | grep -o "\-\-de-color-brand-900" | head -1

# 5. Verify fonts load
curl -s http://site-re.local:8080/ | grep -o "Lora" | head -1
```

### 9.3 Manual Testing Script

```
TEST CASE: Homepage loads without 500
  1. Navigate to http://site-re.local:8080/
  2. Verify: Page loads with status 200
  3. Verify: "Продаю квартиру" card visible
  4. Verify: "Покупаю квартиру" card visible
  5. Verify: Trust strip metrics visible
  6. Verify: Free tools section visible
  7. Verify: CTA section visible
  EXPECTED: All sections render, no errors

TEST CASE: Navigation works
  1. Click "Продать" in header
  2. Verify: Redirects to /sell/
  3. Click "Купить" in header
  4. Verify: Redirects to /buyers/
  5. Click "Каталог" in header
  6. Verify: Redirects to /catalog/
  EXPECTED: All links resolve correctly

TEST CASE: Mobile responsive
  1. Resize browser to 390px width
  2. Verify: Navigation collapses to hamburger
  3. Verify: Cards stack vertically
  4. Verify: No horizontal scroll
  5. Verify: Touch targets are 48px minimum
  EXPECTED: Layout adapts correctly

TEST CASE: Design system colors
  1. Inspect hero section background
  2. Verify: Color is #0B1F3A (brand-900)
  3. Inspect CTA button
  4. Verify: Color is #2F7D62 (action-600)
  5. Inspect page background
  6. Verify: Color is #F7F5F0 (warm-50)
  EXPECTED: Colors match design system
```

---

## 10. Risks and Mitigations

### 10.1 High-Severity Risks

| Risk | Impact | Probability | Mitigation |
|------|--------|-------------|------------|
| **500 error recurrence** | Site down | Medium | Keep site-re-theme deactivated; use TwentyTwentyFive only |
| **Gutenberg block markup errors** | Page rendering issues | Low | Test each page immediately after creation |
| **CSS variable conflicts** | Visual inconsistencies | Medium | Use !important sparingly; test in isolation |
| **Plugin conflicts** | Site breaks | Low | Install minimal plugins; test each activation |

### 10.2 Medium-Severity Risks

| Risk | Impact | Probability | Mitigation |
|------|--------|-------------|------------|
| **Performance degradation** | Slow page loads | Medium | Minimize plugins; optimize images |
| **SEO regression** | Lost rankings | Low | Maintain permalink structure; keep meta tags |
| **Mobile responsiveness** | Poor UX on phones | Low | Test at 390px; use Gutenberg responsive blocks |
| **Accessibility issues** | Legal risk | Medium | Test keyboard nav; add alt text |

### 10.3 Low-Severity Risks

| Risk | Impact | Probability | Mitigation |
|------|--------|-------------|------------|
| **Font loading delays** | FOUT/FOIT | Low | Use font-display: swap; preconnect |
| **Image optimization** | Slow loads | Low | Use AVIF/WebP; lazy loading |
| **Cross-browser issues** | Visual differences | Low | Test in Chrome, Firefox, Safari |

### 10.4 Rollback Plan

If issues occur:

1. **Immediate rollback**
   - Deactivate all custom CSS/JS
   - Switch to default TwentyTwentyFive theme
   - Remove custom pages

2. **Partial rollback**
   - Remove specific pages causing issues
   - Keep working pages
   - Debug and fix incrementally

3. **Full rollback**
   - Restore from backup
   - Document what caused issues
   - Plan alternative approach

---

## 11. Success Criteria

| Criterion | Target | Measurement |
|-----------|--------|-------------|
| No 500 errors | 0 errors | HTTP status codes |
| Page load time | < 3 seconds | GTmetrix/Lighthouse |
| Mobile responsiveness | Passes at 390px | Manual testing |
| Design system compliance | 100% color match | Visual inspection |
| Accessibility | WCAG 2.2 AA | Automated testing |
| User testability | All sections visible | Manual walkthrough |

---

## 12. Timeline

| Phase | Duration | Dependencies |
|-------|----------|--------------|
| Environment setup | 30 min | None |
| Design system injection | 45 min | Plugin installation |
| Page creation | 2 hours | CSS variables injected |
| Testing | 1 hour | Pages created |
| **Total** | **4.25 hours** | |

---

## 13. Appendices

### Appendix A: Design System JSON Reference

Source: `design_iterations/dom-expert-design-final-v1.2/02-design-system.json`

Key mappings:
- `color.brand.900` → `#0B1F3A` → Header, primary buttons
- `color.action.600` → `#2F7D62` → Positive actions, CTAs
- `color.warm.50` → `#F7F5F0` → Page background
- `typography.fontFamily.display` → Lora → Headings
- `typography.fontFamily.body` → Inter → Body text
- `spacing.sectionDesktop` → 96px → Section gaps
- `radius.card` → 18px → Card corners

### Appendix B: Wireframe Reference

Source: `design_iterations/dom-expert-design-final-v1.2/03-wireframes.svg`

Key screens:
- Desktop 01: Homepage (Seller/Buyer bifurcation)
- Desktop 02: Catalog (property cards)
- Desktop 03: Property detail (risk-score)
- Desktop 04: Tool (step-by-step)
- Mobile 01: Homepage (vertical cards)
- Mobile 02: Catalog (single column)
- Mobile 03: Property detail (accordion)

### Appendix C: Plugin Compatibility

| Plugin | Tested | Notes |
|--------|--------|-------|
| TwentyTwentyFive | ✅ | Base theme, no modifications |
| Custom CSS & JS | ✅ | For CSS variable injection |
| Kadence Blocks | ✅ | Extended block library |
| Advanced Custom Fields | ✅ | Keep active for future use |
| Site Re Core | ⚠️ | Keep active but not required for preview |
| Akismet | ⚠️ | Optional, can deactivate |

---

**Document Version:** 1.0  
**Last Updated:** 2026-07-05  
**Author:** Coder Agent  
**Status:** Implementation Plan (Ready for Review)
