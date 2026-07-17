# Kadence General Block — User Stories & Scenarios

**Статус:** ready-for-review (планирование, изменения не вносятся)
**Обновлено:** 2026-07-11
**Источник:** prod WordPress files / SpaceWeb (уже внесённые настройки)

---

## Source Hierarchy for Discovery

```text
1. Prod WordPress files / SpaceWeb read-only snapshot of already-applied settings
2. theme_mods_kadence (when accessible via read-only inspection)
3. /документация/01-дизайн-контекст-и-правила-агента.md — design tokens
4. /документация/02-инструкция-дизайн-ревью.md — review checklist
5. /plans/wordpress-realtor/updated-site-structure.md — site structure
6. wp-content/themes/kadence/ — Kadence theme files
7. wp-content/plugins/kadence-blocks/ — Kadence blocks
```

---

## Personas

| ID | Роль | Технический уровень | Цели |
|---|---|---|---|
| `real-estate-specialist` | Владелец сайта (Наталия) | low–medium | Видеть результат, подтверждать изменения, проверять на мобильном |
| `site-developer` | WordPress/Kadence разработчик | high | Точная настройка под design tokens, минимум CSS, документирование |
| `ux-reviewer` | Независимый ревьювер | medium–high | Фиксировать отклонения от Концепции A, таблица замечаний |

---

## User Journeys (workflow: subagent → plan → user confirm → apply → test → reviewer → user final check)

### Journey 1: Layout (Макет)

```text
1. Субагент читает theme_mods_kadence (read-only)
2. Анализ: content_width, sidebar_width, container_width
3. Показ плана пользователю: значения + обоснование
4. Пользователь подтверждает / корректирует
5. Применение через WP-CLI / Customizer
6. Тест: desktop 1440px → tablet 768px → mobile 390px
7. Ревьювер проверяет → таблица замечаний
8. Финальная проверка пользователя
9. Результат в память и /документация/
```

### Journey 2: Sidebar

```text
1. Субагент проверяет: есть ли сайдбар на страницах
2. Определяем по дизайну: Konцепция A — чистый макет без сайдбара
3. План: отключение, позиция, ширина
4. Подтверждение → применение → тест → ревью → подтверждение
```

### Journey 3: Images

```text
1. Субагент проверяет: lazy loading, quality, lightbox, форматы
2. План: настройки изображений
3. Подтверждение → применение → тест (загрузка страниц) → ревью → подтверждение
```

### Journey 4: Back to Top (Кнопка «Наверх»)

```text
1. Субагент проверяет: включена ли кнопка, стили, позиция
2. План: включение, цвет (#10233F или #2F7D46), размер, позиция (bottom-right)
3. Подтверждение → применение → тест (скролл → клик → возврат) → ревью → подтверждение
```

### Journey 5: 404 Page Layout

```text
1. Субагент анализирует: текущая 404 + структура сайта (из выполненных блоков)
2. План: кастомная 404 на основе структуры сайта; предлагаются текст, ссылки и порядок блоков
3. Пользователь утверждает proposal
4. Подтверждение → применение → тест (несуществующий URL) → ревью → подтверждение
```

### Journey 6: Comments (Комментарии) — ОТКЛЮЧЕНЫ

```text
1. Субагент проверяет: включены ли комментарии, pingbacks/trackbacks и comment feeds
2. План: отключение всего comment surface (новые и существующие записи, pingbacks/trackbacks, feeds)
3. Подтверждение → применение → тест (проверка страниц записей) → ревью → подтверждение
```

### Journey 7: Breadcrumbs (Хлебные крошки)

```text
1. Субагент проверяет: включены ли breadcrumbs, конфликт с Rank Math
2. План: включение, стиль, separator, home label
3. Подтверждение → применение → тест (внутренние страницы) → ревью → подтверждение
```

### Journey 8: Social Links (Соцсети) — DEFERRED

```text
1. Субагент проверяет: есть ли social links
2. План: не активировать в текущем цикле
3. Статус: deferred / out of scope for now
```

### Journey 9: Performance (Эффективность)

```text
1. Субагент проверяет: текущие Kadence performance toggles и совместимость с cache
2. План: только Kadence-specific performance settings; cache/plugin tuning — только если требуется совместимость
3. Подтверждение → применение → тест (PageSpeed / INP) → ревью → подтверждение
4. Выполняется последним (после всех блоков)
```

## Global Acceptance Criteria

- Discovery read-only first from prod WordPress / SpaceWeb sources.
- Before every block, user sees plan and confirms it.
- No block is applied without user approval.
- Every applied block is tested on desktop / tablet / mobile.
- Reviewer checks every tested block before user final check.
- Final block result is appended to `/документация/07-kadence-current-settings.md`.
- If discovery source is unavailable, stop and record limitation.
- `Parallel-capable` is technical only; this run executes sequentially.

## Rollback / Discovery Scenarios

### Rollback

If a block breaks layout, mobile, breadcrumbs, or performance:
1. Roll back only last applied block.
2. Re-test on desktop / tablet / mobile.
3. Re-run reviewer.
4. Append rollback note to `/документация/07-kadence-current-settings.md`.

### Discovery Failure

If prod / SpaceWeb is reachable but `theme_mods_kadence` is missing or incomplete:
1. Record limitation.
2. Inspect available read-only prod WordPress files and theme files.
3. Do not guess values.
4. Mark block as pending discovery.

---

## User Stories 001–009

### Story 001: Layout (Макет)

**Story:** As a site developer, I want to configure Kadence layout settings so that the site matches Концепция A design tokens.

**Acceptance Criteria:**
- [ ] Content width настроен: max-width 1240px
- [ ] Sidebar width: не применяется (макет без сайдбара)
- [ ] Container fullwidth для header/footer
- [ ] Desktop 1440px: контент центрирован, отступы корректны
- [ ] Tablet 768px: адаптивный макет
- [ ] Mobile 390px: одна колонка, нет горизонтального скролла
- [ ] Нет custom CSS для базового макета, кроме утверждённых edge-case исключений

**Dependencies:** Нет (первый блок)
**Parallel-capable:** Нет
**Effort:** 1 день
**Bounded Context:** kadence-theme

---

### Story 002: Sidebar

**Story:** As a site developer, I want to disable sidebar so that the site uses a clean single-column layout per Концепция A.

**Acceptance Criteria:**
- [ ] Sidebar отключён для всех типов записей и страниц
- [ ] На страницах с контентом нет боковой колонки
- [ ] Desktop: main content occupies primary column within max-width 1240px, without sidebar
- [ ] Mobile: без сайдбара

**Dependencies:** Story 001
**Parallel-capable:** Нет
**Effort:** 0.5 дня
**Bounded Context:** kadence-theme

---

### Story 003: Images

**Story:** As a site developer, I want to configure image settings so that images load efficiently across all viewports.

**Acceptance Criteria:**
- [ ] Lazy loading включён для non-critical images
- [ ] Lightbox: выключен
- [ ] SVG отображаются корректно (Safe SVG remains active from baseline; verify only, do not change in this block)
- [ ] Hero/poster assets render crisp on 1440 / 768 / 390
- [ ] Нет broken images

**Dependencies:** Нет
**Parallel-capable:** Да
**Effort:** 0.5 дня
**Bounded Context:** kadence-theme + safe-svg

---

### Story 004: Back to Top

**Story:** As a site developer, I want to enable "Back to Top" button so that users can quickly return to the top of long pages.

**Acceptance Criteria:**
- [ ] Кнопка включена
- [ ] Позиция: bottom-right
- [ ] Цвет фона: #10233F
- [ ] Цвет иконки: #FFFFFF
- [ ] Hover: #C8A468
- [ ] Размер: 40–48px
- [ ] Radius: 12px
- [ ] Появляется после ~300px прокрутки
- [ ] Mobile: не перекрывает контент

**Dependencies:** Story 001
**Parallel-capable:** Да
**Effort:** 0.5 дня
**Bounded Context:** kadence-theme

---

### Story 005: 404 Page

**Story:** As a site developer, I want to configure custom 404 page so that lost users are guided back to main sections.

**Acceptance Criteria:**
- [ ] 404 страница существует и отображается
- [ ] Анализирует текущую структуру сайта и использует её как основу
- [ ] Proposal derived from current site structure; expected candidates include Главная, Владельцам, Покупателям, Материалы, Контакты
- [ ] Final text, links, and block order are user-approved before apply
- [ ] Стилизована по Концепции A (navy/green/gold)
- [ ] Есть понятное сообщение об ошибке
- [ ] Mobile 390px: корректно отображается
- [ ] Meta robots: noindex для 404

**Dependencies:** Story 001
**Parallel-capable:** Да
**Effort:** 1 день
**Bounded Context:** kadence-theme + wordpress-templates

---

### Story 006: Comments (ОТКЛЮЧЕНЫ)

**Story:** As a site developer, I want to disable comments so that the site maintains expert, non-blog appearance.

**Acceptance Criteria:**
- [ ] Комментарии отключены по умолчанию для новых записей
- [ ] На существующих записях: комментарии скрыты/отключены
- [ ] Pingbacks/trackbacks отключены
- [ ] Форма комментариев не отображается
- [ ] RSS/Atom comment feeds disabled or not exposed

**Dependencies:** Нет
**Parallel-capable:** Да
**Effort:** 0.5 дня
**Bounded Context:** kadence-theme + wordpress-core

---

### Story 007: Breadcrumbs

**Story:** As a site developer, I want to enable breadcrumbs so that users have clear navigation and SEO benefits.

**Acceptance Criteria:**
- [ ] Breadcrumbs включены
- [ ] Separator: «/»
- [ ] Home label: «Главная»
- [ ] Позиция: перед заголовком страницы
- [ ] Отображаются на: внутренних страницах, записях, категориях
- [ ] Не отображаются на: главной, 404
- [ ] Mobile: breadcrumbs не ломают макет
- [ ] Kadence is primary breadcrumbs source; if Rank Math duplicates output, Rank Math breadcrumbs are disabled

**Dependencies:** Story 001
**Parallel-capable:** Да
**Effort:** 0.5 дня
**Bounded Context:** kadence-theme + rank-math-seo

---

### Story 008: Social Links

**Decision:** Social links are active for approved contact methods only.

**Acceptance Criteria:**
- [x] Включены только телефон и почта
- [x] Нет других соцсетей/каналов
- [x] Контакты выводятся стандартным Kadence social module

**Dependencies:** Нет
**Parallel-capable:** Да
**Effort:** 0.5 дня
**Bounded Context:** kadence-theme

---

### Story 009: Performance

**Story:** As a site developer, I want to configure Kadence performance settings so that the site loads fast and passes Core Web Vitals.

**Acceptance Criteria:**
- [ ] Baseline metrics recorded for /, /sell/, /buyers/, /contacts/ with warmed cache and desktop/mobile emulation
- [ ] No new Kadence performance toggle increases render-blocking output
- [ ] If Google Fonts are used, only approved loading strategy remains
- [ ] No unnecessary preload/preconnect added by Kadence
- [ ] WP Super Cache compatibility verified, but plugin tuning stays separate unless required
- [ ] Before/after metrics written to `/документация/07-kadence-current-settings.md`

**Dependencies:** Все предыдущие блоки
**Parallel-capable:** Нет (последний)
**Effort:** 1 день
**Bounded Context:** kadence-theme + wp-super-cache

---

## Edge Cases

| ID | Block | Edge Case | Решение |
|---|---|---|---|
| EC-001 | Layout | Kadence не покрывает настройку | Минимальный CSS с классами `de-*` |
| EC-002 | Layout | Sticky header конфликт | Проверять sticky после изменений |
| EC-003 | Sidebar | Шорткод добавляет сайдбар | Убедиться что шорткоды не ломают |
| EC-004 | Images | Safe SVG блокирует SVG | Проверять Media Library, fallback PNG |
| EC-005 | Back to Top | Конфликт с anchor-ссылками | Кнопка не перехватывает якоря |
| EC-006 | 404 | Слишком много ссылок | Максимум 4–5 ключевых разделов |
| EC-007 | Comments | AJAX комментарии | Полностью отключить, не скрывать CSS |
| EC-008 | Breadcrumbs | Дублирование с Rank Math | Отключить breadcrumbs в одном из плагинов |
| EC-009 | Breadcrumbs | Глубокая вложенность | Максимум 3–4 уровня |
| EC-010 | Performance | Google Fonts замедляют | Отключить если системные шрифты |
| EC-011 | Performance | Кэш не сбрасывается | Сбрасывать WP Super Cache после изменений |
| EC-012 | Mobile | Layout ломается на 390px | Всегда тестировать после каждого изменения |
| EC-013 | Discovery | WP-CLI / SpaceWeb недоступны | Фиксировать limitation, не угадывать значения |
| EC-014 | Rollback | Настройка ломает layout/mobile | Откатить только последний блок, затем повторный review |
| EC-015 | Breadcrumbs | Rank Math выводит breadcrumbs параллельно | Оставить один источник, отключить duplicate output |
| EC-016 | 404 | Пользователь не утвердил proposal | Не применять 404, остаться на draft |

---

## Bounded Context Mapping

| Story | Bounded Context | Dependencies |
|---|---|---|
| 001 Layout | kadence-theme | — |
| 002 Sidebar | kadence-theme | 001 |
| 003 Images | kadence-theme + safe-svg | — |
| 004 Back to Top | kadence-theme | 001 |
| 005 404 | kadence-theme + wordpress-templates | 001 |
| 006 Comments | kadence-theme + wordpress-core | — |
| 007 Breadcrumbs | kadence-theme + rank-math-seo | 001 |
| 008 Social Links | kadence-theme | — |
| 009 Performance | kadence-theme + wp-super-cache | All |

---

## Deferred / Out of Scope

- Social Links — не активируем в текущем цикле.

## Fixed Decisions

- Breadcrumbs separator: `/`
- Back to Top color: `#10233F`
- 404 draft starts from current site structure and must be approved before apply

---

## Execution Plan

```text
Phase 1: Discovery (read-only)
  Субагент → WP-CLI → theme_mods_kadence → /документация/07-kadence-current-settings.md

Phase 2: Sequential Configuration (workflow: plan → confirm → apply → test → reviewer → user check)
  Block 1: Layout (001)       → plan → confirm → apply → test → review → user
  Block 2: Sidebar (002)      → plan → confirm → apply → test → review → user
  Block 3: Images (003)       → plan → confirm → apply → test → review → user
  Block 4: Back to Top (004)  → plan → confirm → apply → test → review → user
  Block 5: 404 (005)          → plan → confirm → apply → test → review → user
  Block 6: Comments (006)     → plan → confirm → apply → test → review → user
  Block 7: Breadcrumbs (007)  → plan → confirm → apply → test → review → user
  Block 8: Social Links (008) → SKIP (deferred)
  Block 9: Performance (009)  → plan → confirm → apply → test → review → user

Phase 3: Final Review
  Полное ревью → PageSpeed → финальное подтверждение → обновление памяти
```

---

## Documentation Rule

Документация ведётся по блокам, но складывается в один общий файл настроек:
- Общий лог текущих и завершённых настроек: `/документация/07-kadence-current-settings.md`
- Этот файл (`06-kadence-general-block-stories.md`) хранит stories и review context
- Замечания: `/беклог-промтов/`
