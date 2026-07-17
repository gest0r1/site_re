# Kadence Theme — General Block: Planning Document

## Статус

**new** — подготовка к настройке, изменения не вносятся

## Контекст

Сайт: дом-эксперт.рф (xn----gtbetilkjgn9i.xn--p1ai)
Тема: Kadence 1.5.1
WordPress: 7.0, PHP 8.3
Дизайн-концепция: A — Экспертность + доверие

Блок настроек темы Kadence: **Общие (General)**
Подпункты по очереди:

1. Макет (Layout)
2. Сайдбар (Sidebar)
3. Images
4. Кнопка «Наверх» (Back to Top)
5. 404 Page Layout
6. Комментарии (Comments)
7. Хлебные крошки (Breadcrumbs)
8. Ссылки на соцсети (Social Links)
9. Эффективность (Performance)

## Итеративный процесс

Каждый подпункт проходит цикл:

```text
1. Субагент собирает текущие настройки через WP-CLI (read-only)
2. opencode показывает план настроек пользователю
3. Пользователь подтверждает / корректирует
4. opencode вносит изменения
5. opencode тестирует (desktop/tablet/mobile)
6. Ревьювер проверяет соответствие дизайну
7. Пользователь финально проверяет
8. Результат фиксируется в память и документацию
```

---

## Personas / Роли

### Persona 1: Специалист по недвижимости (Владелец сайта)

| Поле | Значение |
|---|---|
| ID | `real-estate-specialist` |
| Имя | Наталия Александровна Губерначук |
| Роль | Эксперт по недвижимости, владелец бренда Дом-Эксперт |
| Цели | Выглядеть экспертно и доверительно; сайт должен привлекать владельцев и покупателей; конвертировать посетителей в заявки |
| Боли | Непрофессиональный вид сайта; отсутствие.control над настройками; сложность WordPress |
| Технический уровень | low–medium |
| Primary use cases | Просмотр результата настроек; подтверждение изменений; проверка на мобильном |

### Persona 2: Разработчик / настройщик сайта

| Поле | Значение |
|---|---|
| ID | `site-developer` |
| Роль | WordPress/Kadence разработчик (opencode + пользователь) |
| Цели | Точная настройка темы под дизайн-концепцию; соответствие design tokens; минимум CSS |
| Боли | Несоответствие настроек макету; необходимость ручного CSS; ограничения Kadence |
| Технический уровень | high |
| Primary use cases | Настройка через Kadence Customizer / WP-CLI; тестирование; документирование |

### Persona 3: UX/UI Ревьювер

| Поле | Значение |
|---|---|
| ID | `ux-reviewer` |
| Роль | Независимый проверяющий соответствие дизайну |
| Цели | Найти отклонения от Концепции A; зафиксировать проблемы |
| Боли | Визуальные отклонения, которые сложно поймать кодом |
| Технический уровень | medium–high |
| Primary use cases | Проверка desktop/tablet/mobile; составление таблицы замечаний |

---

## User Journeys

### Journey 1: Настройка макета (Layout)

```text
Шаг 1: Субагент запрашивает текущие настройки theme_mods_kadence (WP-CLI read-only)
Шаг 2: opencode анализирует: content width, sidebar width, container width
Шаг 3: opencode показывает план: какие значения менять, почему
Шаг 4: Пользователь подтверждает
Шаг 5: opencode применяет настройки через WP-CLI / Customizer
Шаг 6: Тест: desktop 1440px → content area, sidebar, spacing
Шаг 7: Тест: tablet 768px → адаптивность
Шаг 8: Тест: mobile 390px → одна колонка, нет горизонтального скролла
Шаг 9: Ревьювер проверяет → таблица замечаний
Шаг 10: Пользователь финально подтверждает
Шаг 11: Результат в память и /документация/
```

### Journey 2: Настройка сайдбара

```text
Шаг 1: Субагент проверяет: есть ли сайдбар на каких-либо страницах
Шаг 2: Определяем: нужен ли сайдбар по дизайну (Концепция A — чистый макет)
Шаг 3: Показываем план: сайдбар включён/выключен, позиция, ширина
Шаг 4: Пользователь подтверждает
Шаг 5: Применяем настройки
Шаг 6: Тест: проверяем страницы с сайдбаром и без
Шаг 7: Ревьювер проверяет
Шаг 8: Финальное подтверждение
```

### Journey 3: Настройка изображений (Images)

```text
Шаг 1: Субагент проверяет: качество изображений, lazy loading, форматы
Шаг 2: Анализ: какие изображения используются, нужна ли оптимизация
Шаг 3: План: quality settings, lazy load, lightbox behavior
Шаг 4: Подтверждение
Шаг 5: Применение
Шаг 6: Тест: загрузка страниц с изображениями
Шаг 7: Ревьювер
Шаг 8: Подтверждение
```

### Journey 4: Настройка кнопки «Наверх»

```text
Шаг 1: Субагент проверяет: включена ли кнопка, стили, позиция
Шаг 2: План: включение, цвет (navy/gold), размер, позиция (bottom-right)
Шаг 3: Подтверждение
Шаг 4: Применение
Шаг 5: Тест: скролл вниз → появление кнопки → клик → возврат наверх
Шаг 6: Тест: mobile — кнопка не перекрывает контент
Шаг 7: Ревьювер
Шаг 8: Подтверждение
```

### Journey 5: Настройка 404 Page Layout

```text
Шаг 1: Субагент проверяет: текущая 404 страница, шаблон
Шаг 2: План: кастомная 404 с ссылками на основные разделы
Шаг 3: Подтверждение
Шаг 4: Применение
Шаг 5: Тест: переход на несуществующий URL → проверка 404
Шаг 6: Ревьювер
Шаг 7: Подтверждение
```

### Journey 6: Настройка комментариев

```text
Шаг 1: Субагент проверяет: включены ли комментарии, типы записей
Шаг 2: План: отключение комментариев (не эксперный портал с статьями?)
Шаг 3: Подтверждение
Шаг 4: Применение
Шаг 5: Тест: проверка страниц записей/статей
Шаг 6: Ревьювер
Шаг 7: Подтверждение
```

### Journey 7: Настройка хлебных крошек

```text
Шаг 1: Субагент проверяет: включены ли breadcrumbs, стиль
Шаг 2: План: включение breadcrumbs для SEO и навигации
Шаг 3: Подтверждение
Шаг 4: Применение
Шаг 5: Тест: проверка на внутренних страницах
Шаг 6: Ревьювер
Шаг 7: Подтверждение
```

### Journey 8: Настройка ссылок на соцсети

```text
Шаг 1: Субагент проверяет: есть ли social links в настройках
Шаг 2: План: какие соцсети добавить (если есть), формат
Шаг 3: Подтверждение
Шаг 4: Применение
Шаг 5: Тест: отображение иконок соцсетей
Шаг 6: Ревьювер
Шаг 7: Подтверждение
```

### Journey 9: Настройка эффективности (Performance)

```text
Шаг 1: Субагент проверяет: текущие настройки производительности
Шаг 2: План: отключение ненужных функций, оптимизация
Шаг 3: Подтверждение
Шаг 4: Применение
Шаг 5: Тест: скорость загрузки, отсутствие ошибок
Шаг 6: Ревьювер
Шаг 7: Подтверждение
```

---

## User Stories

### Epic: Kadence General Block Configuration

#### Story 001: Макет (Layout)

**Story:** As a site developer, I want to configure the Kadence layout settings (content width, sidebar width, container) so that the site matches the Концепция A design tokens.

**Acceptance Criteria:**
- [ ] Content width настроен под design tokens (max-width ~1180–1240px)
- [ ] Sidebar width не применяется (макет без сайдбара по дизайну)
- [ ] Container fullwidth для header/footer
- [ ] Desktop 1440px: контент центрирован, отступы корректны
- [ ] Tablet 768px: адаптивный макет
- [ ] Mobile 390px: одна колонка, нет горизонтального скролла
- [ ] Нет custom CSS для базового макета (решается настройками Kadence)

**Dependencies:** Нет (первый блок)
**Parallel:** Нет (выполняется первым)
**Effort:** 1 день
**Technical notes:** Проверить `theme_mods_kadence` → `container_width`, `content_width`. Если Kadence не покрывает — минимальный CSS с классом `de-*`.

---

#### Story 002: Сайдбар (Sidebar)

**Story:** As a site developer, I want to configure sidebar settings so that the site uses a clean single-column layout per Концепция A.

**Acceptance Criteria:**
- [ ] Sidebar отключён для всех типов записей и страниц
- [ ] На страницах с контентом нет боковой колонки
- [ ] Если sidebar был включён — он корректно скрыт
- [ ] Desktop: контент на всю ширину
- [ ] Mobile: без сайдбара

**Dependencies:** Story 001 (макет)
**Parallel:** Нет
**Effort:** 0.5 дня
**Technical notes:** Kadence → General → Sidebar → Position: No Sidebar. Проверить `theme_mods_kadence` → `sidebar_layout`.

---

#### Story 003: Images

**Story:** As a site developer, I want to configure image settings so that images load efficiently and display correctly across all viewports.

**Acceptance Criteria:**
- [ ] Lazy loading включён (native browser lazy loading)
- [ ] Image quality настроено (Kadence default ~82% или выше)
- [ ] Lightbox: выключен (не нужен для экспертного портала)
- [ ] Responsive images: включены
- [ ] SVG отображаются корректно (Safe SVG активен)
- [ ] Герои-постеры (09-poster-*) отображаются без размытия
- [ ] Нет broken image на страницах

**Dependencies:** Нет (независимый блок)
**Parallel:** Да (можно параллельно с 004–009)
**Effort:** 0.5 дня
**Technical notes:** Проверить `theme_mods_kadence` → `image_settings`. Safe SVG плагин уже активен.

---

#### Story 004: Кнопка «Наверх» (Back to Top)

**Story:** As a site developer, I want to enable and style the "Back to Top" button so that users can quickly return to the top of long pages.

**Acceptance Criteria:**
- [ ] Кнопка включена
- [ ] Позиция: bottom-right
- [ ] Цвет фона: #10233F (navy) или #2F7D46 (green)
- [ ] Цвет иконки: #FFFFFF
- [ ] Hover: #C8A468 (gold) или темнее
- [ ] Размер: компактный (40–48px)
- [ ] Radius: 12px (consistent с design tokens)
- [ ] Появляется после прокрутки ~300px
- [ ] Mobile: не перекрывает контент/CTA
- [ ] Не дублирует sticky header functionality

**Dependencies:** Story 001 (макет)
**Parallel:** Да
**Effort:** 0.5 дня
**Technical notes:** Kadence → General → Back to Top. Проверить `theme_mods_kadence` → `back_to_top_*`.

---

#### Story 005: 404 Page Layout

**Story:** As a site developer, I want to configure a custom 404 page so that lost users are guided back to main site sections.

**Acceptance Criteria:**
- [ ] 404 страница существует и отображается
- [ ] Содержит ссылки на основные разделы: Владельцам, Покупателям, Каталог, Контакты
- [ ] Стилизована по Концепции A (navy/green/gold токены)
- [ ] Есть понятное сообщение об ошибке
- [ ] Нет broken layout
- [ ] Mobile 390px: корректно отображается
- [ ] Meta robots: noindex для 404

**Dependencies:** Story 001 (макет)
**Parallel:** Да
**Effort:** 1 день
**Technical notes:** Kadence → General → 404 Page. Может потребоваться создание шаблона 404.php или настройка через Customizer.

---

#### Story 006: Комментарии (Comments)

**Story:** As a site developer, I want to configure comment settings so that the site maintains an expert, non-blog appearance.

**Acceptance Criteria:**
- [ ] Комментарии отключены по умолчанию для новых записей
- [ ] На существующих записях: комментарии скрыты или отключены
- [ ] Форма комментариев не отображается на страницах
- [ ] RSS/Atom комментариев не отображается
- [ ] Если статьи требуют комментариев — настроены отдельно

**Dependencies:** Нет (независимый блок)
**Parallel:** Да
**Effort:** 0.5 дня
**Technical notes:** Kadence → General → Comments → Disable. WP-CLI: `wp option update default_comment_status closed`. Проверить `thread_comments` и `comment_registration`.

---

#### Story 007: Хлебные крошки (Breadcrumbs)

**Story:** As a site developer, I want to enable breadcrumbs so that users have clear navigation hierarchy and SEO benefits.

**Acceptance Criteria:**
- [ ] Breadcrumbs включены
- [ ] Стиль: простой, читаемый (не навигационные крошки с иконками)
- [ ] Separator: «/» или «>»
- [ ] Home label: «Главная»
- [ ] Позиция: перед заголовком страницы
- [ ] Отображаются на: внутренних страницах, записях, категориях
- [ ] Не отображаются на: главной, 404
- [ ] Mobile: breadcrumbs не ломают макет
- [ ] SEO: structured data (JSON-LD) для breadcrumbs

**Dependencies:** Story 001 (макет)
**Parallel:** Да
**Effort:** 0.5 дня
**Technical notes:** Kadence → General → Breadcrumbs → Enable. Проверить `theme_mods_kadence` → `breadcrumbs_*`. Rank Math SEO уже активен — может генерировать JSON-LD.

---

#### Story 008: Ссылки на соцсети (Social Links)

**Story:** As a site developer, I want to configure social media links so that visitors can connect with the specialist on relevant platforms.

**Acceptance Criteria:**
- [ ] Включены только телефон и почта
- [ ] Иконки/лейблы отображаются в footer
- [ ] Phone target: `tel:+79122251788`
- [ ] Email target: `mailto:natalia@xn----gtbetilkjgn9i.xn--p1ai`
- [ ] Mobile: иконки доступны и кликабельны
- [ ] Нет других соцсетей/каналов
- [ ] Нет broken links

**Dependencies:** Story 001 (макет)
**Parallel:** Да
**Effort:** 0.5 дня
**Technical notes:** Kadence → Social Links. Проверить `theme_mods_kadence` → `phone_link`, `email_link`, `footer_social_items`.

---

#### Story 009: Эффективность (Performance)

**Story:** As a site developer, I want to configure Kadence performance settings so that the site loads fast and passes Core Web Vitals.

**Acceptance Criteria:**
- [ ] Отключены ненужные Google Fonts (если используются системные)
- [ ] CSS optimization: включена минификация (через WP Super Cache)
- [ ] JS optimization: отложенная загрузка некритичных скриптов
- [ ] Preconnect: настроен для внешних ресурсов
- [ ] Кеширование: WP Super Cache активен и настроен
- [ ] Largest Contentful Paint (LCP) < 2.5s
- [ ] Cumulative Layout Shift (CLS) < 0.1
- [ ] First Input Delay (FID) < 100ms
- [ ] Нет render-blocking resources
- [ ] gzip/brotli сжатие включено

**Dependencies:** Все предыдущие блоки (чтобы не ломать изменения)
**Parallel:** Нет (выполняется последним)
**Effort:** 1 день
**Technical notes:** Kadence → General → Performance. Проверить `theme_mods_kadence` → `performance_*`. WP Super Cache уже активен. Google PageSpeed Insights для тестирования.

---

## Edge Cases

### Общие edge cases

| ID | Edge Case | Описание | Решение |
|---|---|---|---|
| EC-001 | Kadence не покрывает настройку | Некоторые параметры недоступны в Customizer | Минимальный CSS с классами `de-*` (по правилу из 01-дизайн-контекст) |
| EC-002 | Конфликт с плагинами | Rank Math, WP Super Cache могут конфликтовать с настройками Kadence | Проверять после каждого изменения; отключать конфликтующие опции по одной |
| EC-003 | SVG не отображается | Safe SVG может блокировать некоторые SVG | Проверять Media Library; использовать fallback PNG |
| EC-004 | Mobile layout ломается | Изменения desktop могут сломать mobile | Всегда тестировать на 390px после каждого изменения |
| EC-005 | Sticky header конфликт | Настройки макета могут повлиять на sticky behavior | Проверять sticky после изменений layout |
| EC-006 | 404 страница не кастомная | Kadence может не поддерживать кастомную 404 через Customizer | Создать шаблон 404.php или использовать Kadence Header/Footer builder |
| EC-007 | Breadcrumbs дублируют Rank Math | Оба плагина могут генерировать breadcrumbs | Отключить breadcrumbs в одном из плагинов |
| EC-008 | Соцсети не существуют | У пользователя нет аккаунтов в некоторых соцсетях | Не показывать иконки отсутствующих соцсетей |
| EC-009 | Performance regression | После настроек сайт замедляется | Тестировать PageSpeed до/после; откатывать проблемные изменения |
| EC-010 | Кэш не сбрасывается | После изменений старый кэш отдаёт старые настройки | Сбрасывать кэш WP Super Cache после каждого изменения |

### Специфичные edge cases по блокам

| ID | Блок | Edge Case | Решение |
|---|---|---|---|
| EC-011 | Layout | Container width > viewport | Максимальный width 1240px, min-width не задан |
| EC-012 | Sidebar | Страница с шорткодом сайдбара | Убедиться что шорткоды не добавляют сайдбар |
| EC-013 | Images | SVG с анимацией | Safe SVG может блокировать; проверять |
| EC-014 | Back to Top | Конфликт с anchor-ссылками | Кнопка не перехватывает якорные ссылки |
| EC-015 | 404 | Слишком много ссылок на 404 | Максимум 4–5 ключевых разделов |
| EC-016 | Comments | AJAX комментарии | Полностью отключить, не скрывать CSS |
| EC-017 | Breadcrumbs | Глубокая вложенность | Максимум 3–4 уровня; обрезать длинные пути |
| EC-018 | Social | Неверный URL соцсети | Валидация URL перед сохранением |
| EC-019 | Performance | Google Fonts замедляют | Отключить если используем system fonts |

---

## Open Questions

### Для пользователя

| ID | Вопрос | Контекст | Приоритет |
|---|---|---|---|
| OQ-001 | Какие соцсети использовать? | WhatsApp, Telegram, ВКонтакте, Instagram, YouTube? | high |
| OQ-002 | Нужны ли комментарии на статьях? | Если статьи в /blog/ — могут ли пользователи оставлять комментарии? | medium |
| OQ-003 | Кастомная 404 страница — какой текст? | «Страница не найдена» + ссылки на разделы? Или другой текст? | medium |
| OQ-004 | Breadcrumbs: какой separator? | «/» или «>» или «→»? | low |
| OQ-005 | Back to Top: какой цвет? | Navy (#10233F) или Green (#2F7D46)? | low |
| OQ-006 | Нужна ли страница «О компании» в breadcrumbs? | Сейчас структура: Главная > Раздел > Страница | low |

### Технические

| ID | Вопрос | Контекст | Приоритет |
|---|---|---|---|
| OQ-007 | Какой формат данных в theme_mods_kadence? | Нужно проверить через WP-CLI перед настройкой | high |
| OQ-008 | Есть ли доступ к Kadence Customizer через WP-CLI? | Или только через GUI? | high |
| OQ-009 | Как Rank Math влияет на breadcrumbs? | Отключить Rank Math breadcrumbs или Kadence? | medium |
| OQ-010 | WP Super Cache: нужно ли сбрасывать кэш после каждого изменения? | Или достаточно в конце? | medium |

---

## Bounded Context Mapping

### Kadence Theme Context

| Story | Bounded Context | Dependencies |
|---|---|---|
| Story 001: Layout | kadence-theme | — |
| Story 002: Sidebar | kadence-theme | Story 001 |
| Story 003: Images | kadence-theme + safe-svg | — |
| Story 004: Back to Top | kadence-theme | Story 001 |
| Story 005: 404 Page | kadence-theme + wordpress-templates | Story 001 |
| Story 006: Comments | kadence-theme + wordpress-core | — |
| Story 007: Breadcrumbs | kadence-theme + rank-math-seo | Story 001 |
| Story 008: Social Links | kadence-theme | Story 001 |
| Story 009: Performance | kadence-theme + wp-super-cache | All previous |

### Cross-Context Dependencies

```text
kadence-theme ←→ wordpress-core (comments, templates)
kadence-theme ←→ rank-math-seo (breadcrumbs, structured data)
kadence-theme ←→ wp-super-cache (performance)
kadence-theme ←→ safe-svg (image handling)
```

---

## Execution Plan

### Phase 1: Discovery (read-only)

```text
1. Субагент запрашивает текущие theme_mods через WP-CLI
2. Субагент проверяет текущие настройки breadcrumbs, comments, social
3. Данные сохраняются в /документация/07-kadence-current-settings.md
4. Результат добавляется в память проекта
```

### Phase 2: Sequential Configuration

```text`
Блок 1: Layout (Story 001) → подтверждение → тест → ревью
Блок 2: Sidebar (Story 002) → подтверждение → тест → ревью
Блок 3: Images (Story 003) → подтверждение → тест → ревью
Блок 4: Back to Top (Story 004) → подтверждение → тест → ревью
Блок 5: 404 Page (Story 005) → подтверждение → тест → ревью
Блок 6: Comments (Story 006) → подтверждение → тест → ревью
Блок 7: Breadcrumbs (Story 007) → подтверждение → тест → ревью
Блок 8: Social Links (Story 008) → подтверждение → тест → ревью
Блок 9: Performance (Story 009) → подтверждение → тест → ревью
```

### Phase 3: Final Review

```text
1. Полное ревью всех блоков вместе
2. Тест на desktop/tablet/mobile
3. PageSpeed Insights
4. Финальное подтверждение пользователя
5. Обновление памяти проекта
```

---

## Reviewer Checklist (для каждого блока)

| Проверка | Viewport | Ожидание |
|---|---|---|
| Нет горизонтального скролла | 390px | ✅ |
| Цвета соответствуют design tokens | 1440px | ✅ |
| Шрифты читаемы | все | ✅ |
| Interactive elements кликабельны | все | ✅ |
| Mobile layout корректен | 390px | ✅ |
| Tablet layout корректен | 768px | ✅ |
| Нет наложений элементов | все | ✅ |
| Страница загружается < 3s | все | ✅ |
