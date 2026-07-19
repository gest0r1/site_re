# Phase 1 Plan v2 — Homepage Poster Migration (101–108)

## Цель
Заменить SVG-постеры на WebP-растры на главной дом-эксперт.рф (/).

## Задачи (8 шт, одна страница /)

101 — Hero desktop+mobile  → home-hero-desktop-v2.webp + home-hero-mobile-v2.webp  
102 — Блок владельцев      → home-sellers-poster-v1.webp  
103 — Блок покупателей     → home-buyers-poster-v1.webp  
104 — Процесс              → home-process-poster-v1.webp  
105 — Консультация         → home-consultation-poster-v1.webp  
106 — Материалы владельцам → home-materials-sellers-v1.webp  
107 — Материалы покупателям→ home-materials-buyers-v1.webp  
108 — Материалы о док-тах  → home-materials-documents-v1.webp  

## Исполнение

### Preflight
- [ ] Проверить все 9 WebP файлов локально (существуют, не битые)
- [ ] Проверить поддержку WebP на хостинге
- [ ] Определить post ID главной (`wp option get page_on_front`)
- [ ] Экспортировать текущий `post_content` в файл (бекап)
- [ ] Зафиксировать старые media ID/URL SVG-постеров в homepage
- [ ] Разобрать HTML Gutenberg/Kadence блоков — найти все атрибуты с media (url, id, mediaId, backgroundImg, kadenceBlockCSS)

### Шаг 1. Бекап
- `wp post get <ID> --field=post_content > backup-homepage-pre-phase1.html`
- `wp db export backup-homepage-pre-phase1.sql`

### Шаг 2. Импорт WebP в Media Library
- `wp media import` для 9 WebP файлов
- Зафиксировать новые attachment ID

### Шаг 3. Обновление контента главной
- Для каждого Kadence блока: заменить url + id + mediaId старого SVG на новые WebP
- Для task 101: hero desktop/mobile — через отдельные блоки или `<picture>` + responsive
- Сохранить через `wp post update`

### Шаг 4. Проверка
- Desktop 1440px / Tablet 768px / Mobile 390px
- Нет гор. скролла, CTA читаемы
- Отчёт в каждый task-файл 101–108

### Шаг 5. Кэш
- `wp super-cache flush`
- Очистка кэша браузера через имена файлов (уже новые)

### Шаг 6. Старые SVG
- НЕ удалять сразу
- После полной проверки Phase 1 — решить о clean-up

## Откат
- Восстановить `post_content` из backup-homepage-pre-phase1.html
- `wp db import backup-homepage-pre-phase1.sql`

## Риски (учтены)
1. Kadence может хранить media в JSON-атрибутах блока — ищем `url`, `id`, `mediaId`, `backgroundImg`
2. Неатомарность: импорт может пройти, обновление контента — нет → откат через бекап
3. WebP MIME: проверить через `file --mime-type`
