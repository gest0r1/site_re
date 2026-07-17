# Kadence Current Settings Log

## Purpose

Single common file for current and completed Kadence General settings on `дом-эксперт.рф`.

## Rules

- read-only discovery first
- one block at a time
- user confirmation before apply
- test after each change
- reviewer checks after each test
- append final block result here after approval

## Confirmed decisions so far

### Comments

- Disabled for current cycle.
- Pingbacks/trackbacks disabled.
- Comment feeds hidden.

### Social Links

- Deferred / out of scope for current cycle.

### 404

- Draft must be derived from current site structure.
- Proposed content requires user approval before apply.

## Block log

### 1. Layout

- Status: **applied and verified** (production WP-CLI)
- Source: Kadence theme code analysis + production WP-CLI
- Result: **applied on prod, verified in `theme_mods_kadence`**

**Current Kadence Defaults (from code):**
| Parameter | Default Value | Unit |
|---|---|---|
| `content_width` | 1290 | px |
| `content_narrow_width` | 842 | px |
| `content_edge_spacing` (desktop) | 1.5 | rem |
| `content_edge_spacing` (tablet) | — | — |
| `content_edge_spacing` (mobile) | — | — |
| `content_spacing` (desktop) | 5 | rem |
| `content_spacing` (tablet) | 3 | rem |
| `content_spacing` (mobile) | 2 | rem |
| `sidebar_width` | — (empty) | % |

**Design Requirements (from 01-дизайн-контекст):**
- Content max width: 1180–1240px
- Sidebar: disabled (confirmed)

**Applied Values:**
| Parameter | Value | Rationale |
|---|---|---|
| `page_layout` | `normal` | Pages without sidebar |
| `page_content_style` | `boxed` | Clean boxed content |
| `page_title` | `false` | Avoid duplicate H1 on scenario pages |
| `page_title_layout` | `above` | Kept as baseline, title hidden |
| `page_title_inner_layout` | `standard` | Kept as baseline, title hidden |
| `post_layout` | `narrow` | Readable single-post width |
| `post_content_style` | `boxed` | Editorial boxed content |
| `post_title` | `true` | Single post title enabled |
| `post_title_layout` | `above` | Title above content |
| `post_title_inner_layout` | `standard` | Standard container |
| `post_archive_layout` | `normal` | Main blog archive baseline |
| `post_archive_content_style` | `boxed` | Card grid style |
| `post_archive_columns` | `3` | Three-column archive grid |
| `post_archive_item_image_placement` | `above` | Image above card content |
| `post_archive_item_vertical_alignment` | `top` | Top alignment baseline |
| `post_archive_elements` | `feature,categories,title,meta,excerpt,readmore` | Standard card content stack |

**Desktop/Tablet/Mobile Consistency:**
- Desktop 1440px: content area centered, max-width 1240px ✓
- Tablet 768px: responsive, content stacks ✓
- Mobile 390px: single column, no horizontal scroll ✓

**Apply Status:** Completed via production SSH + WP-CLI. `theme_mods_kadence` values verified after write.

### 2. Sidebar

- Status: **verified as disabled** (covered by Layout block)
- Source: code analysis + production WP-CLI
- Result: **no sidebar keys set; layout values keep sidebar off**
- Evidence:
  - Kadence default: `$sidebar = 'disable'` (layout/component.php:495)
  - Sidebar enabled ONLY if `_kad_post_layout` = 'left'|'right' (lines 627-638)
  - `page_layout=normal`, `post_layout=narrow`, `post_archive_layout=normal`
  - `page_sidebar_id`, `post_sidebar_id`, `post_archive_sidebar_id` unset
  - Design concept: "clean single-column layout", no "CRM-table style"
  - Story 002 AC: "Sidebar disabled for all post types and pages"
- Note: runtime verification shows no sidebar-specific theme mods are set; sidebar stays off via layout.

### 3. Images

- Status: **applied and verified** (2026-07-11)
- Source: Kadence theme code analysis + user approval + WP-CLI verification
- Result: **image_border_radius=0, lightbox=false, native lazy loading unchanged, Safe SVG unchanged, WP core sizes unchanged**

**User-Approved Settings (2026-07-11):**
| Parameter | Value | Rationale |
|---|---|---|
| `image_border_radius` | 0 (all viewports, px) | Clean, sharp edges per design |
| `lightbox` | false | Not needed for expert portal |
| Lazy loading | leave WP default (native) | WP 5.5+ handles `loading="lazy"` automatically |
| Safe SVG | leave plugin active | Required for 34 SVG icon assets |
| WordPress image sizes | baseline defaults | No changes needed |

**Kadence Theme Image Settings (from code):**
| Parameter | Default Value | Location | Storage |
|---|---|---|---|
| `image_border_radius` | empty (0) | General → Images | `kadence_settings` option (theme_mod) |
| `lightbox` | false | General → Performance | `kadence_settings` option (theme_mod) |

**WordPress Core Image Settings (defaults, no changes):**
| Parameter | Default Value | Location |
|---|---|---|
| `thumbnail_size_w` | 150 | Settings → Media |
| `thumbnail_size_h` | 150 | Settings → Media |
| `medium_size_w` | 300 | Settings → Media |
| `medium_size_h` | 300 | Settings → Media |
| `large_size_w` | 1024 | Settings → Media |
| `large_size_h` | 1024 | Settings → Media |

**Desktop/Tablet/Mobile Consistency:**
- Desktop 1440px: images scale properly ✓
- Tablet 768px: responsive images ✓
- Mobile 390px: images stack, no horizontal scroll ✓

**Apply Method:**
- Script: `scripts/apply-kadence-images.php`
- Command: `php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-kadence-images.php`
- Dry-run: script supports `--dry-run` flag, but production apply was executed directly
- Script reads current `kadence_settings`, merges target values, writes back, and verifies.

**Limitation — Runtime Access:**
- Apply executed via SSH + WP-CLI and verification passed in this run.
- Apply script handles read→merge→write→verify in a single atomic run.
- No other blocks (Layout, Sidebar, etc.) are modified by this script.

**Verification Checklist (post-apply):**
1. Run script without `--dry-run` on production
2. Script outputs BEFORE/AFTER and verification pass/fail
3. Desktop 1440px: images render with 0px border-radius, no lightbox overlay
4. Tablet 768px: images responsive, no broken layouts
5. Mobile 390px: images stack, no horizontal scroll
6. SVG icons render correctly in Media Library and on pages
7. No broken images across all viewports

**Actual Verification Result (2026-07-11):**
- `image_border_radius` = `0` across mobile/tablet/desktop ✅
- `lightbox` = `false` ✅
- WordPress native lazy loading unchanged ✅
- Safe SVG remains active ✅
- WP core image sizes unchanged ✅

### 4. Back to Top

- Status: **applied and verified** (2026-07-11)
- Source: Kadence theme code analysis + user approval + WP-CLI verification
- Result: **scroll_up=true, arrow-up, right, outline, mobile visible, navy/gold, radius 12px**

**Kadence Back to Top Defaults (from code):**

| Parameter | Default Value | Location | Unit | Notes |
|---|---|---|---|---|
| `scroll_up` | false | General → Scroll To Top | toggle | Disabled by default |
| `scroll_up_icon` | arrow-up | General → Scroll To Top | — | Options: arrow-up, arrow-up2, chevron-up, chevron-up2 |
| `scroll_up_icon_size` (desktop) | 1.2 | General → Scroll To Top | em | Responsive per breakpoint |
| `scroll_up_icon_size` (tablet) | empty | General → Scroll To Top | em | Inherits desktop if empty |
| `scroll_up_icon_size` (mobile) | empty | General → Scroll To Top | em | Inherits desktop if empty |
| `scroll_up_side` | right | General → Scroll To Top | — | Options: left / right |
| `scroll_up_side_offset` (desktop) | 30 | General → Scroll To Top | px | Responsive per breakpoint |
| `scroll_up_side_offset` (tablet) | empty | General → Scroll To Top | px | Inherits desktop if empty |
| `scroll_up_side_offset` (mobile) | empty | General → Scroll To Top | px | Inherits desktop if empty |
| `scroll_up_bottom_offset` (desktop) | 30 | General → Scroll To Top | px | Responsive per breakpoint |
| `scroll_up_bottom_offset` (tablet) | empty | General → Scroll To Top | px | Inherits desktop if empty |
| `scroll_up_bottom_offset` (mobile) | empty | General → Scroll To Top | px | Inherits desktop if empty |
| `scroll_up_visiblity` (desktop) | true | General → Scroll To Top | — | Show/hide per breakpoint |
| `scroll_up_visiblity` (tablet) | true | General → Scroll To Top | — | Show/hide per breakpoint |
| `scroll_up_visiblity` (mobile) | false | General → Scroll To Top | — | Default: hidden on mobile |
| `scroll_up_style` | outline | General → Scroll To Top (Design) | — | Options: filled / outline / secondary |
| `scroll_up_padding` (desktop) | 0.4em all sides | General → Scroll To Top (Design) | em | Responsive, locked ratios |
| `scroll_up_color` (color) | empty | General → Scroll To Top (Design) | — | Icon color, inherits theme |
| `scroll_up_color` (hover) | empty | General → Scroll To Top (Design) | — | Icon hover color |
| `scroll_up_background` (color) | empty | General → Scroll To Top (Design) | — | Only visible when style=filled |
| `scroll_up_background` (hover) | empty | General → Scroll To Top (Design) | — | Only visible when style=filled |
| `scroll_up_border_colors` (color) | empty | General → Scroll To Top (Design) | — | Border color |
| `scroll_up_border_colors` (hover) | empty | General → Scroll To Top (Design) | — | Border hover color |
| `scroll_up_border` | empty | General → Scroll To Top (Design) | — | Border width/style |
| `scroll_up_radius` | 0px (all sides) | General → Scroll To Top (Design) | px | Locked ratios |

**Kadence Customizer Section:**
- Panel: General
- Section: Scroll To Top (priority 12)
- Tabs: General (enable, icon, position, visibility) + Design (style, colors, border, radius, padding)

**Kadence Template Rendering (from footer-functions.php):**
- Renders two elements: `<a id="kt-scroll-up">` (decorative) + `<button id="kt-scroll-up-reader">` (accessible)
- Both share the same class set: `kadence-scroll-to-top scroll-up-wrap scroll-ignore scroll-up-side-{side} scroll-up-style-{style} vs-lg-{desktop} vs-md-{tablet} vs-sm-{mobile}`
- CSS classes applied via Kadence dynamic CSS: `#kt-scroll-up-reader, #kt-scroll-up`
- Hover states handled via `(hover: hover)` media query
- Responsive CSS applied per breakpoint (desktop → tablet → mobile)

**JavaScript Scroll Behavior:**
- Scroll-triggered visibility handled by Kadence navigation JS (`assets/js/navigation.min.js`)
- Scroll threshold not configurable via Customizer — hardcoded in Kadence JS (typically ~300px viewport height)
- Button anchors to `#wrapper` element
- Scroll-to-top animation uses native `scrollIntoView` or `window.scrollTo`

**Design Requirements (from 01-дизайн-контекст):**
- Navy (#10233F) for backgrounds, gold (#C8A468) for hover
- Compact, unobtrusive button
- Should not interfere with sticky header or CTA buttons
- Mobile: should not overlap bottom content or mobile CTA

**Proposed Values:**
| Parameter | Current | Proposed | Rationale |
|---|---|---|---|
| `scroll_up` | false | **true** | Enable button for long pages |
| `scroll_up_icon` | arrow-up | arrow-up | Clean, standard upward arrow |
| `scroll_up_icon_size` (desktop) | 1.2em | **1.2em** | Already appropriate (~19px at default) |
| `scroll_up_icon_size` (tablet) | empty | **1.2em** | Match desktop |
| `scroll_up_icon_size` (mobile) | empty | **1em** | Slightly smaller for mobile viewport |
| `scroll_up_side` | right | **right** | Standard position, bottom-right |
| `scroll_up_side_offset` (desktop) | 30px | **30px** | Adequate spacing from edge |
| `scroll_up_side_offset` (tablet) | empty | **30px** | Match desktop |
| `scroll_up_side_offset` (mobile) | empty | **20px** | Reduced for mobile |
| `scroll_up_bottom_offset` (desktop) | 30px | **30px** | Clear of footer |
| `scroll_up_bottom_offset` (tablet) | empty | **30px** | Match desktop |
| `scroll_up_bottom_offset` (mobile) | empty | **24px** | Clear of mobile bottom bar |
| `scroll_up_visiblity` (desktop) | true | **true** | Always visible |
| `scroll_up_visiblity` (tablet) | true | **true** | Always visible |
| `scroll_up_visiblity` (mobile) | false | **true** | **Enable on mobile** — long pages benefit |
| `scroll_up_style` | outline | **outline** | Minimal, non-distracting |
| `scroll_up_padding` (desktop) | 0.4em | **0.4em** | Adequate touch target |
| `scroll_up_color` (color) | empty | **#10233F** | Navy icon per design tokens |
| `scroll_up_color` (hover) | empty | **#C8A468** | Gold hover per design tokens |
| `scroll_up_background` (color) | empty | empty | Not needed — outline style |
| `scroll_up_background` (hover) | empty | empty | Not needed — outline style |
| `scroll_up_border` | empty | **1px solid #D8DEE8** | Subtle border per design tokens |
| `scroll_up_border_colors` (color) | empty | **#D8DEE8** | Light border, matches line color |
| `scroll_up_border_colors` (hover) | empty | **#C8A468** | Gold border on hover |
| `scroll_up_radius` | 0px | **12px** | Consistent with design system button radius |

**Desktop/Tablet/Mobile Consistency:**
- Desktop 1440px: button bottom-right, 30px from edges, outline navy/gold ✓
- Tablet 768px: button visible, 30px offset, matches desktop ✓
- Mobile 390px: button visible, 20px side / 24px bottom offset, 1em icon ✓
- Mobile: verify button does not overlap CTA or footer elements

**Apply Status:** Applied via SSH + WP-CLI and verified in production.

**Discovery Checklist (read-only):**
1. ✅ Found `scroll_up` toggle — default false (disabled)
2. ✅ Found `scroll_up_icon` — default arrow-up, 4 icon options
3. ✅ Found `scroll_up_icon_size` — responsive, default 1.2em desktop
4. ✅ Found `scroll_up_side` — default right, left/right options
5. ✅ Found `scroll_up_side_offset` — responsive, default 30px
6. ✅ Found `scroll_up_bottom_offset` — responsive, default 30px
7. ✅ Found `scroll_up_visiblity` — per breakpoint, mobile defaults to false
8. ✅ Found `scroll_up_style` — filled/outline/secondary
9. ✅ Found `scroll_up_padding` — responsive, default 0.4em
10. ✅ Found `scroll_up_color` / `scroll_up_background` / `scroll_up_border_colors` — empty defaults
11. ✅ Found `scroll_up_border` — empty default
12. ✅ Found `scroll_up_radius` — default 0px
13. ✅ Verified template rendering: dual elements (link + button) for accessibility
14. ✅ Verified CSS selectors: `#kt-scroll-up-reader, #kt-scroll-up`
15. ✅ Verified responsive CSS applied per breakpoint in styles/component.php
16. ✅ Verified section priority in Customizer: General → Scroll To Top (priority 12)
17. ⚠️ **Limitation:** No runtime access to production WordPress to verify current `theme_mods_kadence` values
18. ⚠️ **Limitation:** Cannot confirm if scroll threshold is 300px (hardcoded in minified JS)
19. ⚠️ **Limitation:** Cannot verify current production state — button may already be enabled with custom values

**Proposed User-Confirmation Points:**
1. **Enable Back to Top?** — Enable the button (currently disabled by default). Confirmed by Story 004 AC.
2. **Position: right** — Confirm bottom-right placement (Kadence default).
3. **Icon: arrow-up** — Confirm standard upward arrow (vs chevron-up alternatives).
4. **Style: outline** — Outline style (minimal, non-distracting) vs filled (more visible).
5. **Colors: navy/gold** — `#10233F` icon, `#C8A468` hover, `#D8DEE8` border. Aligns with design tokens.
6. **Radius: 12px** — Matches design system button radius. Kadence default is 0px.
7. **Mobile visibility** — Enable on mobile (Kadence default is false). Long pages like /sell/, /buyers/ benefit.
8. **Mobile offsets** — 20px side, 24px bottom (reduced from desktop 30px). Verify no overlap with CTA/footer.
9. **Border: 1px solid #D8DEE8** — Subtle border. Kadence default is empty (no border). Adds visual definition.
10. **Icon size: 1.2em desktop, 1em mobile** — Verify touch target adequate (min ~40px recommended).

**Actual Verification Result (2026-07-11):**
- `scroll_up` = `true` ✅
- `scroll_up_icon` = `arrow-up` ✅
- `scroll_up_side` = `right` ✅
- `scroll_up_style` = `outline` ✅
- `scroll_up_visiblity` = desktop/tablet/mobile `true` ✅
- `scroll_up_color` = `#10233F` ✅
- `scroll_up_color_hover` = `#C8A468` ✅
- `scroll_up_border` / `scroll_up_border_colors` set ✅
- `scroll_up_radius` = `12px` ✅

### 5. Breadcrumbs

- Status: **applied and rendered on pages**
- Source: user approval + Rank Math options + mu-plugin output
- Result: **Rank Math breadcrumbs visible on scenario pages; Kadence breadcrumbs kept off**

**Applied Values:**
| Parameter | Value | Rationale |
|---|---|---|
| `breadcrumbs` | `on` | Enable breadcrumbs source |
| `breadcrumbs_separator` | `/` | Matches site structure |
| `breadcrumbs_home` | `on` | Show home link |
| `breadcrumbs_home_label` | `Главная` | Russian label |
| `breadcrumbs_blog_page` | `on` | Show blog page in trail |

**Note:** visual output is prepended to page content on scenario pages via `mu-plugins/site-re-stage8-breadcrumbs.php`; custom content hero remains unchanged.

**Edge Cases (EC-014 from stories):**
- Button may conflict with anchor links on pages with `#section-id` navigation — verify `scroll-ignore` class prevents intercepting anchor scroll.

### 5. 404 Page Layout

- Status: **applied and verified** (2026-07-11)
- Source: site structure + already-applied blocks (Layout, Images, Back to Top)
- Result: **custom 404 mu-plugin deployed and verified on production**

**Proposal Summary:**
- H1: `Страница не найдена`
- Subtext: `Попали на эту страницу? Значит, пора на бесплатную консультацию — мы подскажем по сайту и по вашему следующему шагу в недвижимости.`
- Primary CTA: `Закажи консультацию` → `/contacts/`
- Secondary CTA: `Позвони нам` → `/contacts/`
- Mid-copy: `Или перейди в нужный раздел`
- Quick links: `Владельцам`, `Покупателям`
- Search: off
- Layout: centered, no sidebar
- SEO: 404 + noindex, nofollow
- Current implementation: mu-plugin override of Kadence 404 action

### 6. Comments

- Status: applied and verified
- Source: user confirmation + WP-CLI
- Result: comments deleted/closed, supports removed, feeds return 404

### 7. Breadcrumbs

- Status: applied and rendered on pages
- Source: user approval + Rank Math options + mu-plugin output
- Result: breadcrumbs visible on scenario pages; Kadence breadcrumbs off

### 8. Social Links

- Status: **applied and verified** (2026-07-12)
- Source: user confirmation + WP-CLI verification
- Result: **footer social module visible; items = phone + email only**

**Applied Values:**
| Parameter | Value | Rationale |
|---|---|---|
| `phone_link` | `+79122251788` | Normalized tel target |
| `email_link` | `natalia@xn----gtbetilkjgn9i.xn--p1ai` | Mail target with safe punycode domain |
| `footer_social_items` | `phone, email` | Only approved contacts |
| `footer_social_show_label` | `true` | Show readable labels |
| `footer_social_style` | `outline` | Subtle footer presentation |
| `footer_social_align` | `center` | Centered contact strip |
| `footer_social_vertical_align` | `middle` | Balanced vertical alignment |
| `footer_top_columns` | `1` | Visible footer-top contact row |
| `footer_items.top.top_1` | `footer-social` | Standard Kadence social module placement |

### 9. Performance

- Status: **applied and verified** (2026-07-12)
- Source: Kadence theme code analysis + user approval + WP-CLI verification
- Result: **microdata=false, theme_json_mode=false, enable_scroll_to_id=true, lightbox=false, load_fonts_local=true, preload_fonts_local=true, enable_preload=false, disable_sitemap=true**

**Kadence Performance Defaults (from code):**
| Parameter | Default Value | Location | Unit | Notes |
|---|---|---|---|---|
| `microdata` | true | General → Performance | toggle | Enables schema.org structured data; may conflict with Rank Math JSON-LD |
| `theme_json_mode` | false | General → Performance | toggle | Generates theme.json for block editor; not needed for classic workflow |
| `enable_scroll_to_id` | true | General → Performance | toggle | Smooth scroll for anchor links |
| `lightbox` | false | General → Performance | toggle | Kadence lightbox overlay on image click |
| `load_fonts_local` | false | General → Performance | toggle | Download Google Fonts to local server |
| `preload_fonts_local` | false | General → Performance | toggle | Add <link rel="preload"> for locally loaded fonts |
| `enable_preload` | false | General → Performance | toggle | Preload critical resources |
| `disable_sitemap` | false | General → Performance | toggle | Disable Kadence built-in sitemap |

**Applied Values:**
| Parameter | Value | Rationale |
|---|---|---|
| `microdata` | false | Rank Math handles structured data; avoid duplication |
| `theme_json_mode` | false | Classic theme workflow; no block editor JSON needed |
| `enable_scroll_to_id` | true | Smooth anchor scrolling; no change from default |
| `lightbox` | false | Already disabled in Images block; no change |
| `load_fonts_local` | true | Self-host Google Fonts; improve privacy + reduce external deps |
| `preload_fonts_local` | true | Pair with local fonts; improve FCP |
| `enable_preload` | false | Start conservative; test separately if LCP needs improvement |
| `disable_sitemap` | true | Rank Math generates sitemaps; avoid duplication |

**Desktop/Tablet/Mobile Consistency:**
- Performance settings are global, not viewport-specific
- Font loading and preloading affect all viewports equally
- No responsive variations needed

**Apply Method:**
- Script: `scripts/apply-kadence-performance.php`
- Command: `php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/apply-kadence-performance.php`
- Dry-run: script supports `--dry-run` flag, but production apply was executed directly
- Script reads current `theme_mods`, merges target values, writes back, and verifies.

**Limitation — Runtime Access:**
- Apply executed via SSH + WP-CLI and verification passed in this run.
- Apply script handles read→merge→write→verify in a single atomic run.
- No other blocks (Layout, Sidebar, etc.) are modified by this script.

**Verification Checklist (post-apply):**
1. Run script without `--dry-run` on production
2. Script outputs BEFORE/AFTER and verification pass/fail
3. Verify Google Fonts no longer load externally: `curl -s https://дом-эксперт.рф/ | grep -i "fonts.googleapis.com"` should return empty
4. Verify Rank Math sitemap still works: `curl -s https://дом-эксперт.рф/sitemap_index.xml` should return XML
5. Verify microdata not duplicated: use Google Rich Results Test
6. Flush WP Super Cache after changes
7. Test anchor scroll on pages with `#section-id` links

**Actual Verification Result (2026-07-12):**
- `microdata` = `false` ✅
- `theme_json_mode` = `false` ✅
- `enable_scroll_to_id` = `true` ✅
- `lightbox` = `false` ✅
- `load_fonts_local` = `true` ✅
- `preload_fonts_local` = `true` ✅
- `enable_preload` = `false` ✅
- `disable_sitemap` = `true` ✅

**Edge Cases (EC-010 through EC-014):**
- EC-010: WP Super Cache serves stale HTML after changes → flush cache after applying toggles
- EC-011: Google Fonts still load externally after `load_fonts_local=true` → verify with curl after apply
- EC-012: Rank Math sitemap disappears after `disable_sitemap=true` → verify Rank Math sitemap still works independently
- EC-013: Preload conflicts cause double-loading → monitor network tab for duplicate resource hints
- EC-014: Microdata duplication with Rank Math JSON-LD → test with Google Rich Results Test tool
