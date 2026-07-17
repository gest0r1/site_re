# Дом Эксперт — SVG-библиотека для Gutenberg

Стиль: **A — Экспертность + доверие**  
SVG-файлов: **139**

## Назначение

Библиотека предназначена для ИИ-агента и разработчика, собирающих нативные Gutenberg templates и patterns. Каждый SVG является отдельным атомарным ресурсом.

## Основные правила для ИИ

1. Сначала определить семантику блока, затем выбрать `asset_id` в `ASSET-CATALOG.md`.
2. Не использовать один большой SVG как шаблон страницы.
3. Для `currentColor=true` задавать цвет через CSS родителя.
4. Для risk-ассетов всегда выводить текстовый статус, объяснение и следующий шаг.
5. `gutenberg/*.svg` использовать только как preview паттерна в редакторе.
6. Векторные постеры не заменяют фотографии реальных объектов.
7. Informative SVG требуют `alt` или текстового эквивалента. Decorative SVG должны оставаться `aria-hidden`.
8. Не применять абсолютное позиционирование для построения всей страницы.

## CSS-токены

```css
--de-color-navy: #10233F;
--de-color-green: #2F8B67;
--de-color-blue: #2E6CCB;
--de-color-gold: #B98B46;
--de-color-warm: #F6F3EE;
--de-color-text: #172033;
--de-color-muted: #667085;
--de-color-line: #D8DEE8;
--de-radius-card: 20px;
--de-radius-control: 12px;
```

## Gutenberg mapping

| Сценарий | Gutenberg |
|---|---|
| Логотип | `core/site-logo` |
| Hero | `core/cover` или `core/media-text` |
| Seller/Buyer | Pattern на `core/group` |
| Property icon | inline SVG в динамическом блоке |
| Risk badge | `custom/risk-badge` |
| Empty state | `core/group` + `core/image` |
| CTA | `core/group` + `core/buttons` |
| Preview | только editor asset |

## Промт для ИИ-интегратора

```text
Ты внедряешь библиотеку Дом Эксперт в WordPress Gutenberg.
Перед созданием блока найди точный asset_id в ASSET-CATALOG.md, соблюдай recommended_block, usage и accessibility. Не заменяй фотографии объектов постерами. Для risk-элементов всегда выводи текстовый уровень, объяснение и следующий шаг. Для mobile используй отдельный mobile poster, когда он есть. Результат должен быть нативным Gutenberg markup/pattern, адаптивным на 390/768/1440 px, без горизонтального скролла и без абсолютной раскладки всей страницы.
```

## Папки
- `brand/` — 3 файлов
- `navigation/` — 8 файлов
- `paths/` — 12 файлов
- `property/` — 21 файлов
- `status/` — 7 файлов
- `risk/` — 24 файлов
- `trust/` — 11 файлов
- `forms/` — 16 файлов
- `states/` — 9 файлов
- `posters/` — 12 файлов
- `decor/` — 8 файлов
- `gutenberg/` — 8 файлов
