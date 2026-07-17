# WordPress Realtor Site Plan

## Цель
Собрать сайт для риелтора: структура, дизайн, контент, AI-воркфлоу, каталоги недвижимости и модуль подбора.

## Стратегия
- **Git** — только код: тема, child-theme, кастомные плагины, шаблоны, ассеты.
- **MCP / REST / встроенный AI WordPress** — контент, медиа, админские операции.
- **OpenCode** — стартовая структура, шаблоны, первичное наполнение.
- **WordPress AI** — дальнейшие статьи, новости, правки и регулярное наполнение.

## Принципы эксплуатации
- Release flow — глобальный процесс для всех этапов, не отдельная поздняя стадия.
- Перед каждым выкатыванием в прод: backup, restore-check, smoke tests, approval.
- Git не является источником истины для БД, uploads и настроек плагинов.
- AI не получает персональные данные без явного разрешения.

## Глобальный release gate
Каждый этап должен завершаться рабочим инкрементом.
Перед выходом в прод на каждом этапе:
1. backup создан и проверен
2. smoke tests пройдены
3. rollback point зафиксирован
4. назначен approval owner
5. релизные заметки готовы
6. deploy выполнен
7. post-deploy check завершен

## Планируемые этапы
- ✅ **Этап 1**: аудит хостинга
- ✅ **Этап 2**: операционная база
- ✅ **Этап 3**: информационная архитектура и контент-модель (документация)
- 🔄 **Этап 4: Foundation** — тема + CPT/ACF-регистрация + Git-правила + OpenCode-контекст + ядро плагинов
- ⬜ **Этап 5**: дизайн-система и шаблоны
- ⬜ **Этап 6**: плагины и базовая конфигурация (SEO, кеш, аналитика, SMTP, security)
- ⬜ **Этап 7**: первичное наполнение и AI workflow
- ✅ **Этап 8**: закрепление release flow и деплоя
- ⬜ **Этап 9**: фаза роста 1 — риск-калькуляторы
- ⬜ **Этап 10**: фаза роста 2 — каталоги недвижимости
- ⬜ **Этап 11**: фаза роста 3 — модуль подбора недвижимости

### Изменения в структуре этапов (v2)

| Что изменилось | Причина |
|----------------|---------|
| **Этап 4 расширен**: теперь Foundation — тема + CPT/ACF-регистрация + Git + OpenCode-контекст + core-плагины | CPT и ACF-поля нужны **до** шаблонов (Stage 5). Плагины (ACF, CPT UI, Forms) тоже нужны до шаблонов, чтобы шаблоны могли выводить реальные данные. |
| **Этап 6 сужен**: только некритичные для вёрстки плагины (SEO, кеш, аналитика, SMTP, security) | Forms, ACF, CPT UI перенесены в Stage 4, так как блокируют Stage 5 |
| **Этап 8 отмечен как выполненный** | Release flow и GitHub Actions deploy уже реализованы |

## Security / privacy gate
- Публична privacy policy и consent-checkbox для форм.
- CAPTCHA / anti-spam включены.
- Передача лидов и писем протестирована безопасно.
- Роли админов проверены.
- Retention / deletion process описан.
- Персональные данные не уходят в AI без явного разрешения.

## Lead data retention / deletion
- lead data stored in CRM or WordPress only by agreed policy
- recommended default retention period: 24 months
- recommended default deletion SLA: 5 business days
- recommended default backup expiry: 30 days
- final values must be approved before launch
- deletion request owner is admin
- backup retention impact is documented
- AI prompts exclude names, phone numbers, emails unless explicit consent exists

## Роли
- **OpenCode**: структура, шаблоны, стартовый контент, bulk-правки.
- **WordPress AI**: ежедневные статьи, новости, корректировки.
- **Админ сайта**: доп. поля, проверка качества, ручные уточнения.
