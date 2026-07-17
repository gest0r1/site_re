# Kadence General Block: 404 Page Layout

**Статус:** applied and verified
**Дата:** 2026-07-11
**Блок:** Kadence → General → 404 Page Layout (Story 005)
**Dependencies:** Story 001 (Layout) — confirmed baseline

---

## Source Hierarchy (read-only)

```text
1. /plans/wordpress-realtor/updated-site-structure.md → site structure, navigation, utility pages
2. /документация/01-дизайн-контекст-и-правила-агента.md → design tokens, typography, colors
3. /документация/06-kadence-general-block-stories.md → Story 005 AC, edge cases
4. /документация/06-kadence-general-block-planning.md → Journey 5, persona context
5. /документация/07-kadence-current-settings.md → already-applied blocks (Layout, Images, Back to Top)
6. Kadence theme code → 404 template rendering logic
7. WordPress core → 404 template hierarchy
```

---

## 404 Page Layout — Field / Parameter / Explanation

### Section A: Kadence Customizer Settings

| Field | Parameter | Explanation |
|---|---|---|
| `kadence_404_title` | **"Страница не найдена"** | Main heading shown on 404 page. Uses design typography: H1 34–36px mobile, 56–60px desktop. Color: `--de-navy` (#10233F). |
| `kadence_404_text` | **"Попали на эту страницу? Значит, пора на бесплатную консультацию — мы подскажем по сайту и по вашему следующему шагу в недвижимости."** | Subtext below heading. Uses body font (Manrope/system-ui), color `--de-muted` (#667085). Tone: calm, helpful, conversion-focused. |
| `kadence_404_button_text` | **"Закажи консультацию"** | Primary CTA button text. Main conversion path on error page. |
| `kadence_404_button_url` | **"/contacts/"** | Links to consultation/contact page. Primary recovery path for lost users. |
| `kadence_404_button_style` | **filled** | Button style: filled navy (#10233F) with white text. Hover: #172D4B. Radius: 12px. Matches primary CTA pattern. |
| `kadence_404_secondary_button_text` | **"Позвони нам"** | Secondary CTA button text. Secondary route into contact flow. |
| `kadence_404_secondary_button_url` | **"/contacts/"** | Same contact destination, alternate label for clarity. |
| `kadence_404_show_search` | **false** | Search form: OFF. Site has no meaningful search index (expert portal, not blog). Search would produce poor results. |
| `kadence_404_layout` | **centered** | Layout: centered content, no sidebar. Aligns with Story 001/002 (single-column, no sidebar). |

### Section B: Navigation Links (Custom Block / Gutenberg)

| Field | Parameter | Explanation |
|---|---|---|
| **Link Group: "Быстрый переход"** | — | Small quick-link group below CTA block. Rest of navigation stays in header. |
| Link 1: **Владельцам** | `/sell/` | Fast path for sellers. |
| Link 2: **Покупателям** | `/buyers/` | Fast path for buyers. |
| Link count | **2** | User-requested minimum set; all else is in header. |
| Link style | **text link** | Compact, low-noise links with arrow/chevron. |
| Link order | **Владельцам → Покупателям** | Matches user request. |
| Mid-copy | **"Или перейди в нужный раздел"** | Bridge line between CTA block and quick links. |

### Section C: Visual Styling (Design Tokens)

| Field | Parameter | Explanation |
|---|---|---|
| Background | `--de-white` (#FFFFFF) or `--de-warm` (#F7F5F2) | Clean, light background. Warm option adds subtle differentiation from regular pages. |
| H1 color | `--de-navy` (#10233F) | Primary heading. Consistent with site headers. |
| Subtext color | `--de-muted` (#667085) | Secondary text. Not black, not too light. Readable. |
| Link color | `--de-green` (#2F7D46) | Navigation links use green for discoverability. |
| Link hover | `--de-green-hover` (#256B3B) | Darker green on hover. |
| CTA button | `--de-navy` bg, `#FFFFFF` text | Primary button style per design tokens. |
| CTA hover | `--de-navy-2` (#172D4B) bg | Hover state per design tokens. |
| CTA radius | 12px | Consistent with all site buttons. |
| Icon style | Optional: house icon or arrow | Simple, recognizable. SVG from Safe SVG library if available. |
| Max-width | 1240px (content area) | Matches Story 001 layout. Centered, no sidebar. |

### Section D: Responsive Behavior

| Field | Parameter | Explanation |
|---|---|---|
| Desktop 1440px | Centered column, max-width 1240px, link cards in row | Standard desktop layout. Links can be horizontal row. |
| Tablet 768px | Centered column, link cards wrap to 2 rows | Responsive wrapping. No horizontal scroll. |
| Mobile 390px | Single column, links stacked vertically | Vertical stack. Each link is full-width tap target (min 44px height). CTA button full-width. |
| Mobile padding | 16–20px horizontal | Edge spacing per mobile layout rules. |

### Section E: SEO / Technical

| Field | Parameter | Explanation |
|---|---|---|
| HTTP status | **404** | WordPress returns 404 status automatically for missing pages. Must NOT be 200. |
| Meta robots | **noindex, nofollow** | Prevents 404 page from being indexed by search engines. Critical for SEO. |
| Title tag | **"404 — Страница не найдена — дом-эксперт.рф"** | SEO title. Includes site name for brand recognition. |
| Canonical | **none** or self-referencing | 404 pages should not have canonical pointing elsewhere. |
| Breadcrumbs | **not displayed** | Per Story 007 AC: "Не отображаются на: главной, 404". No breadcrumb trail on error page. |
| Back to Top button | **visible** | Per Back to Top block: enabled on all viewports. Long 404 pages (if links stack) benefit. |
| Header/Footer | **rendered normally** | 404 page uses standard site header and footer. Remaining nav lives in header. |

### Section F: Implementation Method

| Field | Parameter | Explanation |
|---|---|---|
| Primary method | **Kadence General → 404 Page Layout** | Kadence Customizer section for 404. May provide title/text/button settings directly. |
| Fallback method | **WordPress 404.php template** | If Kadence Customizer doesn't expose 404 content editing, create `404.php` in child theme or use Kadence Header/Footer Builder. |
| Content editing | **Gutenberg editor** | If Kadence exposes 404 as editable page, use Gutenberg blocks: Heading, Paragraph, Buttons, Columns for link cards. |
| Link implementation | **Gutenberg Buttons block or Kadence Info Box** | Buttons block for CTA; Info Box or Column blocks for navigation links. |

---

## Proposal: 404 Page Content Structure

```text
┌─────────────────────────────────────────────────────┐
│  [Header — site header with navigation]              │
├─────────────────────────────────────────────────────┤
│                                                      │
│            404                                       │
│                                                      │
│     Страница не найдена                              │
│                                                      │
│  Страница не найдена.                                │
│  Возможно, ссылка устарела или адрес введён с ошибкой.│
│                                                      │
│      [ Консультация ]  [ Контакты ]                  │
│                                                      │
│  ─────────────────────────────────────               │
│                                                      │
│  Быстрый переход:                                    │
│                                                      │
│  [ Владельцам ]  [ Покупателям ]                    │
│                                                      │
├─────────────────────────────────────────────────────┤
│  [Footer — site footer]                              │
└─────────────────────────────────────────────────────┘
```

---

## Discovery Checklist (read-only)

| # | Check | Status | Notes |
|---|---|---|---|
| 1 | ✅ Site structure identified | updated-site-structure.md U8: 404 at `/404/` | "Возврат на главную" |
| 2 | ✅ Header navigation mapped | 5 top-level items: Владельцам, Покупателям, О компании, Материалы, Контакты | Source of 404 link candidates |
| 3 | ✅ Design tokens documented | 01-дизайн-контекст: navy/green/gold palette, typography, button styles | Applied to 404 styling |
| 4 | ✅ Story 005 AC reviewed | 7 acceptance criteria in 06-stories.md | All must be met |
| 5 | ✅ Edge cases identified | EC-015: max 4–5 links; EC-016: user must approve proposal | Link count limited, approval required |
| 6 | ✅ Already-applied blocks referenced | Layout (001), Images (003), Back to Top (004) | 404 must align with these |
| 7 | ✅ Breadcrumbs exclusion confirmed | Story 007 AC: "Не отображаются на 404" | No breadcrumbs on 404 |
| 8 | ✅ Back to Top on 404 | Back to Top enabled on all viewports | Button visible on 404 page |
| 9 | ⚠️ Kadence 404 Customizer section | Not verified in production (no WP-CLI access) | May or may not exist — check during apply |
| 10 | ⚠️ Current 404 page state | Unknown what WordPress/Kadence shows by default | Discovery during apply phase |
| 11 | ⚠️ 404 template hierarchy | WordPress: 404.php → index.php; Kadence may override | Verify during apply |
| 12 | ⚠️ Production 404 URL | Structure says `/404/` but WordPress 404 is dynamic, not a real page | Clarify: is it a real page or template? |

---

## User-Confirmation Points (before apply)

| # | Confirmation Point | Options | Default Proposal |
|---|---|---|---|
| 1 | **H1 text** | Custom text or default "Страница не найдена" | "Страница не найдена" |
| 2 | **Subtext** | Custom message | "Попали на эту страницу? Значит, пора на бесплатную консультацию — мы подскажем по сайту и по вашему следующему шагу в недвижимости." |
| 3 | **Primary CTA button text** | "Консультация", custom | "Консультация" |
| 4 | **Primary CTA button URL** | Contact page or other | `/contacts/` |
| 5 | **Secondary CTA button text** | "Контакты", custom | "Контакты" |
| 6 | **Secondary CTA button URL** | Contact page or other | `/contacts/` |
| 7 | **Navigation links** | Which sections to show (max 2) | Только: Владельцам, Покупателям |
| 8 | **Link order** | Rearrange or remove links | Владельцам → Покупателям |
| 9 | **Link style** | Text links, buttons | Compact text links with arrows |
| 10 | **Background color** | White (#FFFFFF) or warm (#F7F5F2) | `--de-warm` (#F7F5F2) — subtle differentiation |
| 11 | **Search form** | Include or exclude | OFF (site has no meaningful search) |
| 12 | **Meta robots** | noindex or allow | noindex, nofollow |
| 13 | **Title tag format** | "404 — Страница не найдена — дом-эксперт.рф" or custom | As shown |
| 14 | **404 implementation** | Kadence Customizer 404 section, or custom 404.php template | Try Kadence first, fallback to 404.php |

---

## Runtime Limitations

| # | Limitation | Impact | Mitigation |
|---|---|---|---|
| 1 | **No WP-CLI access to production** | Cannot read current `theme_mods_kadence` for 404 settings | Code-level analysis only; verify during apply |
| 2 | **Kadence 404 Customizer section unknown** | May not exist or may be limited | Fallback: WordPress 404.php template with Gutenberg content |
| 3 | **404 is not a "real" page in WordPress** | WordPress renders 404 dynamically; it's a template, not a page entity | Content must be in template or Kadence settings, not a WordPress page |
| 4 | **Gutenberg content in 404.php** | If using custom template, hardcoding content in PHP is fragile | Use `do_blocks()` or `the_content()` with a dedicated page if Kadence supports it |
| 5 | **Kadence theme version** | Kadence 1.5.1 may have different 404 options than newer versions | Check actual theme code during apply |
| 6 | **No local Kadence theme files** | Kadence not in local-env; only default WP themes available | Cannot inspect Kadence 404 template code directly |
| 7 | **Design tokens may not apply automatically** | Kadence 404 Customizer may not expose color/typography controls | May need minimal CSS with `de-*` classes |

---

## Edge Cases (from stories + new)

| ID | Edge Case | Mitigation |
|---|---|---|
| EC-015 | Too many links on 404 | Max 2 quick links; tested on mobile |
| EC-016 | User didn't approve proposal | Stay in draft; do not apply |
| EC-020 | Kadence 404 section doesn't exist | Fallback to 404.php template |
| EC-021 | 404 page returns 200 status | Verify HTTP header; WordPress should return 404 automatically |
| EC-022 | 404 page indexed by search engines | Set noindex meta; verify with Rank Math |
| EC-023 | 404 page has no header/footer | Ensure 404 template includes `get_header()` and `get_footer()` |
| EC-024 | Mobile links too small to tap | Minimum 44px touch targets; full-width on mobile |
| EC-025 | 404 page looks broken on tablet | Test 768px viewport; links should wrap gracefully |

---

## Acceptance Criteria (from Story 005)

- [ ] 404 страница существует и отображается
- [ ] Анализирует текущую структуру сайта и использует её как основу
- [ ] Proposal derived from current site structure; quick links limited to Владельцам and Покупателям
- [ ] Final text, CTA order, and block order are user-approved before apply
- [ ] All other nav remains in header
- [ ] Стилизована по Концепции A (navy/green/gold)
- [ ] Есть понятное сообщение об ошибке
- [ ] Mobile 390px: корректно отображается
- [ ] Meta robots: noindex для 404

---

## Next Steps

1. Keep monitoring 404 click-throughs.
2. Move to Performance block next.

---

## References

- `/plans/wordpress-realtor/updated-site-structure.md` — site structure, navigation
- `/документация/01-дизайн-контекст-и-правила-агента.md` — design tokens
- `/документация/06-kadence-general-block-stories.md` — Story 005, EC-015, EC-016
- `/документация/06-kadence-general-block-planning.md` — Journey 5
- `/документация/07-kadence-current-settings.md` — block log, confirmed decisions
