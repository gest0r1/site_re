# Prod media map

Этот файл фиксирует фактическое наличие проектных ассетов в production Media Library WordPress.

## Основание текущей версии

Текущая версия заполнена по двум страницам медиабиблиотеки WordPress, предоставленным пользователем.

## Ключевое правило сопоставления

Сопоставлять ассеты **только по имени файла**.

```text
WordPress Media Library хранит файлы плоско, без папок.
Папки из исходного asset pack в медиабиблиотеке не учитываются.
Источник истины — flat filename вида NN-category-name.ext.
```

Пример:

```text
uploads/2026/07/01-brand-logo-horizontal-light.svg
→ 01-brand-logo-horizontal-light.svg
```

Старые пути вида `brand/logo-horizontal-light.svg` для сопоставления в WordPress не использовать.

## Подтвержденное состояние

По двум страницам Media Library подтверждено наличие полного flat asset pack по именам файлов.

На скриншотах видны filename/title/date/author/attached state, но не видны attachment ID и полный production URL. Эти поля должен дозаполнить opencode через WP-CLI.

## Таблица production-ассетов

| Asset filename | Expected use | Media Library status by filename | Attachment ID | Production URL | Mime type | Attached / used state from screenshot | Notes |
|---|---|---|---:|---|---|---|---|
| `01-brand-logo-horizontal-dark.svg` | Логотип на светлом фоне | yes | 148 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/01-brand-logo-horizontal-dark.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены через WP-CLI |
| `01-brand-logo-horizontal-light.svg` | Логотип на navy header/footer | yes | 149 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/01-brand-logo-horizontal-light.svg | image/svg+xml | Прикреплено к `Логотип` | WP-CLI: custom_logo + site_logo option. Used on: all pages (Kadence header) |
| `01-brand-logo-mark.svg` | Mobile/fallback logo mark / иконка сайта | yes | 150 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/01-brand-logo-mark.svg | image/svg+xml | Не прикреплено | WP-CLI: mobile_logo + site_icon. Used on: all pages (mobile header, browser tab) |
| `02-navigation-menu.svg` | Burger/menu icon | yes | 151 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/02-navigation-menu.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `02-navigation-search.svg` | Search icon | yes | 118 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/02-navigation-search.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `03-path-seller-home.svg` | Seller scenario icon | yes | 123 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/03-path-seller-home.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `03-path-buyer-key.svg` | Buyer scenario icon | yes | 119 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/03-path-buyer-key.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `03-path-estimate.svg` | Estimate tool icon | yes | 121 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/03-path-estimate.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `03-path-risk-check.svg` | Risk-check icon | yes | 122 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/03-path-risk-check.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `03-path-compare.svg` | Compare icon | yes | 120 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/03-path-compare.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `04-property-area.svg` | Property card area icon | yes | 124 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/04-property-area.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `04-property-rooms.svg` | Property card rooms icon | yes | 128 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/04-property-rooms.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `04-property-floor.svg` | Property card floor icon | yes | 126 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/04-property-floor.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `04-property-location.svg` | Property card location icon | yes | 127 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/04-property-location.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `04-property-favorite.svg` | Property favorite icon | yes | 125 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/04-property-favorite.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `05-status-available.svg` | Available status | yes | 129 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/05-status-available.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `05-status-sold.svg` | Sold status | yes | 130 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/05-status-sold.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `06-trust-expert.svg` | Trust/expert CTA | yes | 131 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/06-trust-expert.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `07-form-phone.svg` | Phone/form icon | yes | 132 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/07-form-phone.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `08-risk-high.svg` | High risk icon | yes | 133 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/08-risk-high.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `08-risk-medium.svg` | Medium risk icon | yes | 135 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/08-risk-medium.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `08-risk-low.svg` | Low risk icon | yes | 134 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/08-risk-low.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `08-risk-verified.svg` | Verified risk/status icon | yes | 136 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/08-risk-verified.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `09-poster-hero-main-desktop.svg` | Home hero desktop | yes | 139 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/09-poster-hero-main-desktop.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `09-poster-hero-main-mobile.svg` | Home hero mobile | yes | 140 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/09-poster-hero-main-mobile.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `09-poster-seller-hero.svg` | Seller page hero | yes | 141 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/09-poster-seller-hero.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `09-poster-buyer-hero.svg` | Buyer page hero | yes | 137 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/09-poster-buyer-hero.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `09-poster-consultation.svg` | Consultation CTA poster | yes | 138 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/09-poster-consultation.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `10-favicon-favicon.svg` | Favicon SVG source | yes | 145 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/10-favicon-favicon.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `10-favicon-site-icon-512.svg` | Site icon SVG source | yes | 147 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/10-favicon-site-icon-512.svg | image/svg+xml | Не прикреплено | ID/URL/MIME подтверждены |
| `10-favicon-16.png` | Favicon 16 | yes | 142 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/10-favicon-16.png | image/png | Не прикреплено | ID/URL/MIME подтверждены |
| `10-favicon-32.png` | Favicon 32 | yes | 143 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/10-favicon-32.png | image/png | Не прикреплено | ID/URL/MIME подтверждены |
| `10-favicon-apple-touch-icon.png` | Apple touch icon | yes | 144 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/10-favicon-apple-touch-icon.png | image/png | Не прикреплено | ID/URL/MIME подтверждены |
| `10-favicon-site-icon-512.png` | WordPress site icon PNG | yes | 146 | http://xn----gtbetilkjgn9i.xn--p1ai/wp-content/uploads/2026/07/10-favicon-site-icon-512.png | image/png | Не прикреплено | ID/URL/MIME подтверждены |

## Служебные/дополнительные элементы

Также в Media Library видны:

```text
favicon.svg
cropped-10-favicon-favicon.jpg
```

`cropped-10-favicon-favicon.jpg` — автосгенерированная WordPress cropped-версия, не часть flat asset pack.

## Результат инвентаризации (задача 002)

Hero-постеры `09-poster-hero-main-desktop.svg` и `09-poster-hero-main-mobile.svg` очищены от CTA. Кнопки для Hero реализуются отдельно в HTML/Kadence-верстке.

Таблица выше заполнена через WP-CLI (SSH, production). Все 34 flat asset-файла сопоставлены по basename:

- Attachment ID подтверждён через `wp_posts.ID`
- Production URL (guid) записан из `wp_posts.guid`
- MIME type подтверждён через `wp_posts.post_mime_type`
- `_wp_attached_file` везде указывает на `2026/07/` — flat layout без папок
- Used on URLs: 2 ассета используются в настройках Kadence/WordPress (ID 149 как site logo, ID 150 как mobile logo + site icon). Остальные ассеты загружены, но не прикреплены к контенту/настройкам.

Импорт ассетов не требуется: полный flat asset pack присутствует в Media Library.
