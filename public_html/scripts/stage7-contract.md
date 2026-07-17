# Stage 7 Contract

## Purpose
Personal realtor site for **Губернатчук Наталья Александровна**.

Agency **INCOM-Недвижимость** is support base only.

## Approved sources
- INCOM office page: address, office trust content, team, reviews.
- INCOM reviews page: public review source.
- INCOM awards/history pages: trust facts only if sourced.
- Yandex Maps: secondary public review source.

## Pages

### Top level
- `/` — home
- `/sell/` — owners hub
- `/buyers/` — buyers hub
- `/about/` — about specialist
- `/blog/` — materials hub
- `/reviews/` — reviews
- `/contacts/` — contacts

### Owners tree
- `/sell/estimate/`
- `/sell/diagnostic/`
- `/sell/prepare/`
- `/sell/documents/`
- `/sell/showings/`
- `/sell/negotiation/`
- `/sell/taxes/`
- `/sell/alternative/`

### Buyers tree
- `/buyers/catalog/`
- `/buyers/catalog/new-buildings/`
- `/buyers/catalog/resale/`
- `/buyers/mortgage/`
- `/buyers/selection/`
- `/buyers/check/`
- `/buyers/support/`
- `/buyers/negotiation/`
- `/buyers/new-vs-resale/`
- `/buyers/check-developer/`
- `/buyers/checklist/`

### Materials tree
- `/blog/sellers/`
- `/blog/buyers/`
- `/blog/mortgage/`
- `/blog/documents/`

## Menus

### Header
- Владельцам
  - Оценка
  - Диагностика
  - Подготовка
  - Документы
  - Показы
  - Переговоры
  - Налоги
  - Альтернативная сделка
- Покупателям
  - Каталог
  - Новостройки
  - Вторичка
  - Ипотека
  - Подбор
  - Проверка
  - Сопровождение
  - Переговоры
  - Новостройка vs вторичка
  - Проверка застройщика
  - Чек-лист
- О компании
- Материалы
  - Для владельцев
  - Для покупателей
  - Ипотека
  - Документы
- Контакты

### Footer
- Отзывы
- Материалы
- Контакты

### Legal links
- Политика конфиденциальности
- Cookie Policy
- Пользовательское соглашение

Legal links remain hardcoded in theme footer and are not managed by Stage 7 seed.

## Content rules
- No FAQ as separate section.
- Reviews only from approved public sources or with consent.
- No guarantees, no №1, no elite/premium/luxury/VIP.
- No unsupported numeric claims.
- Use INCOM only as support base for trust content.

## Runtime modes
- `STAGE7_STATUS=draft|publish`
- `STAGE7_DRY_RUN=1`
- `STAGE7_FORCE=1`
