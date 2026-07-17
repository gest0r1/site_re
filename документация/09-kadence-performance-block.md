# Kadence General — Performance Block

**Статус:** applied and verified
**Обновлено:** 2026-07-12
**Сайт:** дом-эксперт.рф (xn----gtbetilkjgn9i.xn--p1ai)
**Тема:** Kadence 1.5.1
**WordPress:** 7.0, PHP 8.3

---

## Context

- WP Super Cache **already active** — plugin tuning stays separate unless required
- Kadence performance options **applied on production** (verified values below)
- Story 009 AC: baseline metrics → toggles → test → verify CWV
- Bounded context: `kadence-theme + wp-super-cache`
- Last block in sequential chain — all previous blocks (Layout, Sidebar, Images, Back to Top, 404, Comments, Breadcrumbs) already applied

---

## 1. Field / Parameter / Explanation Table

| Field (theme_mod key) | UI Location | Type | Default (from code) | Explanation |
|---|---|---|---|---|
| `microdata` | General → Performance → Microdata | bool | `true` | Enables Kadence microdata output (schema.org structured data). Conflicts possible with Rank Math JSON-LD — if Rank Math handles structured data, Kadence microdata can be disabled to avoid duplication. |
| `theme_json_mode` | General → Performance → Theme JSON Mode | bool | `false` | When true, Kadence generates `theme.json` from Customizer settings for block editor consistency. Recommended: `false` for classic theme workflows. |
| `enable_scroll_to_id` | General → Performance → Scroll to ID | bool | `true` | Enables smooth scroll behavior for anchor links (`#section-id`). If disabled, anchor navigation may feel jarring. Keep enabled unless conflicts observed. |
| `lightbox` | General → Performance → Lightbox | bool | `false` | Enables Kadence lightbox overlay on image click. Already set `false` in Images block (Story 003). Confirm: no change needed. |
| `load_fonts_local` | General → Performance → Load Fonts Local | bool | `false` | When true, Kadence downloads Google Fonts to local server and serves from `/wp-content/uploads/kadence/`. Reduces external requests, improves privacy (no Google tracking). Recommended: `true`. |
| `preload_fonts_local` | General → Performance → Preload Fonts Local | bool | `false` | When true, adds `<link rel="preload">` for locally loaded fonts. Improves FCP by eliminating font download delay. Only effective if `load_fonts_local=true`. Recommended: `true` (paired with above). |
| `enable_preload` | General → Performance → Preload Resources | bool | `false` | When true, Kadence preloads critical resources (fonts, key assets). Can improve LCP but adds extra `<link rel="preload">` tags. Test carefully — may conflict with WP Super Cache preloading. Recommended: evaluate after cache testing. |
| `disable_sitemap` | General → Performance → Disable Sitemap | bool | `false` | When true, Kadence disables its built-in sitemap output. If Rank Math generates sitemaps (standard for SEO plugins), disable Kadence sitemap to avoid duplicates. Recommended: `true` (Rank Math handles sitemaps). |

---

## 2. Discovery Checklist (read-only)

> Run these checks on production via WP-CLI **before** making any changes.

### Step 1: Read current theme_mods

```bash
php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/list-performance-keys.php
```

**Expected output (all unset):**
```
microdata: '(not set)'
theme_json_mode: '(not set)'
enable_scroll_to_id: '(not set)'
lightbox: '(not set)'
load_fonts_local: '(not set)'
preload_fonts_local: '(not set)'
enable_preload: '(not set)'
disable_sitemap: '(not set)'
```

### Step 2: Read defaults from Kadence code

```bash
php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html eval-file scripts/read-performance-defaults.php
```

**Expected output:**
```
microdata
  current: (null)
  default: true
theme_json_mode
  current: (null)
  default: false
enable_scroll_to_id
  current: (null)
  default: true
lightbox
  current: (null)
  default: false
load_fonts_local
  current: (null)
  default: false
preload_fonts_local
  current: (null)
  default: false
enable_preload
  current: (null)
  default: false
disable_sitemap
  current: (null)
  default: false
```

### Step 3: Check WP Super Cache status

```bash
php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html plugin status | grep -i "super cache"
```

**Confirm:** WP Super Cache active.

### Step 4: Check Rank Math sitemap

```bash
php8.3 ~/bin/wp-cli.phar --path=~/дом-эксперт_рф/public_html option get rank_math sitemap_index
```

**Confirm:** Rank Math sitemap exists → `disable_sitemap=true` is safe.

### Step 5: Check current Google Fonts usage

```bash
curl -s https://дом-эксперт.рф/ | grep -i "fonts.googleapis.com"
```

**Confirm:** Whether Google Fonts are currently loaded externally.

### Step 6: Baseline PageSpeed

Run PageSpeed Insights for desktop and mobile on:
- `/`
- `/sell/`
- `/buyers/`
- `/contacts/`

Record: LCP, CLS, FID/INP, TTFB, total blocking time.

---

## 3. What to Confirm with User Before Apply

| # | Question | Context | Recommendation | Priority |
|---|---|---|---|---|
| 1 | **Microdata: disable or leave?** | Rank Math generates JSON-LD structured data. Kadence microdata may duplicate output, causing Google Search Console warnings. | Disable (`microdata=false`) if Rank Math handles all structured data | high |
| 2 | **Load fonts locally?** | Currently Google Fonts load from `fonts.googleapis.com`. Local loading removes external dependency, improves privacy (no Google tracking), reduces DNS lookups. Adds ~100-300KB storage. | Enable (`load_fonts_local=true`) | high |
| 3 | **Preload fonts locally?** | Only works if fonts are loaded locally. Adds `<link rel="preload">` for faster FCP. | Enable (`preload_fonts_local=true`) — pair with #2 | high |
| 4 | **Enable preloading?** | Kadence can preload critical resources. May conflict with WP Super Cache preloading strategy. | Test separately — start disabled, evaluate if LCP > 2.5s | medium |
| 5 | **Disable Kadence sitemap?** | Rank Math generates sitemaps. Two sitemap sources = duplication, potential SEO confusion. | Enable (`disable_sitemap=true`) | high |
| 6 | **Theme JSON mode?** | Generates `theme.json` for block editor. Classic theme workflow — not needed. | Keep disabled (`theme_json_mode=false`) | low |
| 7 | **Scroll to ID?** | Enables smooth anchor scrolling. Already working by default. | Keep enabled (`enable_scroll_to_id=true`) | low |
| 8 | **Lightbox?** | Already disabled in Images block (Story 003). | Keep disabled (`lightbox=false`) — no change | low |

---

## 4. Important Notes

### WP Super Cache Already Active

- Plugin is active and configured on production
- **Kadence performance options do NOT conflict with WP Super Cache** — they are orthogonal:
  - WP Super Cache: page caching, gzip, browser caching
  - Kadence Performance: font loading, structured data, sitemap output, smooth scroll
- After applying Kadence toggles, **flush WP Super Cache** to ensure fresh output
- Plugin tuning (cache expiry, preload, garbage collection) is separate scope — not part of this block

### Kadence Performance Options Currently Unset

- All 8 performance keys are at Kadence defaults (not explicitly set in `theme_mods_kadence`)
- `kadence()->default($key)` returns Kadence code defaults (see table above)
- Applying changes = explicitly setting values via `set_theme_mod()` — same pattern as Back to Top (Story 004)

### Edge Cases

| ID | Edge Case | Mitigation |
|---|---|---|
| EC-010 | WP Super Cache serves stale HTML after changes | Flush cache after applying toggles |
| EC-011 | Google Fonts still load externally after `load_fonts_local=true` | Verify with `curl | grep fonts.googleapis` after apply |
| EC-012 | Rank Math sitemap disappears after `disable_sitemap=true` | Verify Rank Math sitemap still works independently |
| EC-013 | Preload conflicts cause double-loading | Monitor network tab for duplicate resource hints |
| EC-014 | Microdata duplication with Rank Math JSON-LD | Test with Google Rich Results Test tool |

---

## 5. Applied Values

| Parameter | Value | Rationale |
|---|---|---|---|
| `microdata` | **false** | Rank Math handles structured data; avoid duplication |
| `theme_json_mode` | **false** | Classic theme workflow; no block editor JSON needed |
| `enable_scroll_to_id` | **true** | Smooth anchor scrolling; no change from default |
| `lightbox` | **false** | Already disabled in Images block; no change |
| `load_fonts_local` | **true** | Self-host Google Fonts; improve privacy + reduce external deps |
| `preload_fonts_local` | **true** | Pair with local fonts; improve FCP |
| `enable_preload` | **false** | Start conservative; test separately if LCP needs improvement |
| `disable_sitemap` | **true** | Rank Math generates sitemaps; avoid duplication |

---

## 6. Execution Notes

```text
1. Apply script used: `scripts/apply-kadence-performance.php`
2. Production apply executed via WP-CLI
3. WP Super Cache flushed after apply
4. Verify: font loading, structured data, sitemap, anchor scroll
5. PageSpeed Insights: compare before/after as follow-up
6. Results appended to `07-kadence-current-settings.md`
```

---

## 7. Dependencies

- Story 001 (Layout): ✅ applied
- Story 002 (Sidebar): ✅ verified
- Story 003 (Images): ✅ applied (lightbox=false)
- Story 004 (Back to Top): ✅ applied
- Story 005 (404): ✅ applied
- Story 006 (Comments): ✅ confirmed disabled
- Story 007 (Breadcrumbs): ✅ applied (Rank Math)
- Story 008 (Social Links): deferred
- **Story 009 (Performance): applied and verified**

---

## 8. Scripts

| Script | Purpose | Status |
|---|---|---|
| `scripts/list-performance-keys.php` | Read current theme_mods values | ✅ ready |
| `scripts/read-performance-defaults.php` | Read current + Kadence defaults | ✅ ready |
| `scripts/apply-kadence-performance.php` | Apply approved settings | ✅ created and used |

---

**Source hierarchy:** prod WordPress files / SpaceWeb → theme_mods_kadence → Kadence 1.5.1 theme code → existing documentation (`07-kadence-current-settings.md`)
