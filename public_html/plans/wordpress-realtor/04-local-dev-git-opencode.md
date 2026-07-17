# Этап 4: Foundation — тема, данные, Git, OpenCode

## Зачем
Создать работающий фундамент для вёрстки (Stage 5): тема, которая может выводить реальные данные из CPT/ACF, зафиксированные Git-правила, и готовый OpenCode-контекст для генерации.

## Принцип
CPT, ACF-поля и плагины (ACF, CPT UI, Forms) нужны **до** шаблонов — иначе шаблоны нечего будет выводить. Поэтому они включены в этот этап, а не отложены до Stage 6.

## Что сделать

### 4.1 Тема (scaffolding)
- `style.css` — заголовок темы (Name, URI, Description, Version, Text Domain)
- `functions.php` — регистрация:
  - поддержки: title-tag, post-thumbnails, menus, html5, custom-logo
  - меню: header, footer
  - сайдбаров (если нужны)
  - констант темы
- `index.php` — fallback-шаблон (WP Loop + get_template_part)
- `404.php`
- `search.php`
- `page.php` — базовый шаблон страницы

### 4.2 Регистрация CPT (в site-re-core плагине или functions.php)
- `property` — объект недвижимости (публичный, архив)
- `developer` — застройщик (публичный, архив)
- `review` — отзыв/кейс (публичный, архив)
- `faq` — вопрос-ответ (публичный, архив)
- `glossary` — термин (публичный, архив)
- Таксономии: `district` (hierarchical), `property_tag` (non-hierarchical)

### 4.3 ACF-поля (регистрация кодом через functions.php или плагин)
- Группа "property": type, status, price, rooms, area_*, floor, building_type, etc.
- Группа "developer": full_name, inn, ogrn, rating, projects_*, escrow_only, etc.
- Группа "review": segment, deal_type, client_name, quote, rating, consent_given
- Группа "faq": question, answer, segment
- Группа "glossary": term, definition, segment, related_posts, related_glossary

### 4.4 Core-плагины
- ACF Pro — установлен и активирован (или подключена free-версия из репозитория)
- CPT UI — установлен (опционально, CPT можно регистрировать кодом)
- Fluent Forms / CF7 — установлен для форм (задел под Stage 5)

### 4.5 Git-правила
- Ветки: `main` (стабильная), `develop` (рабочая)
- Ветки задач: `feature/*`, `fix/*` от `develop`
- `CONTRIBUTING.md` — правила коммитов, веток, PR
- `.gitignore` — проверен (уже есть)

### 4.6 OpenCode-контекст
- `.opencode/context/project/summary.md` — описание проекта, стека, структуры
- `.opencode/context/project/plans-index.md` — ссылки на планы этапов
- `.opencode/context/project/content-model.md` — ключевые CPT и ACF-поля для генерации

### 4.7 Синхронизация с локальным стендом
- `deploy/sync-to-local.sh` должен копировать тему, плагины, mu-plugins, root-assets в `local-env/wordpress/`

## Owner
- **Owner:** developer (OpenCode)

## Что хранить в Git
- тема (`wp-content/themes/site-re-theme/`)
- кастомный плагин (`wp-content/plugins/site-re-core/`)
- mu-plugins (`wp-content/mu-plugins/`)
- root-assets (`.htaccess`, `robots.txt`)
- скрипты, тесты, документация
- контекст OpenCode (`.opencode/context/`)

## Что не хранить
- БД (dump-файлы)
- uploads
- wp-core
- секреты (`.env*`)
- плагины из репозитория (кроме кастомных)

## Тесты этапа
- [ ] `tests/smoke.sh` — HTTP 200 на главной и wp-admin
- [ ] `tests/check-config.sh` — CORRECT wp-config настройки
- [ ] Тема активна в wp-admin, отображается без ошибок
- [ ] CPT property создан, single-property.php рендерится (404 → 200 после создания)
- [ ] ACF-поля property отображаются в админке
- [ ] Git checkout feature → merge → delete работает по CONTRIBUTING.md
- [ ] `deploy/sync-to-local.sh` копирует тему и плагины в локальный стенд

## Release gate
После прохождения тестов и smoke — можно переходить к Stage 5 (дизайн-система и шаблоны). Прод-деплой этого этапа не обязателен (фундамент остаётся локальным до Stage 5).
