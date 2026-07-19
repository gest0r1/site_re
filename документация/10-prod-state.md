# Prod State Reference — дом-эксперт.рф

**Версия:** 1.0
**Дата:** 17 июля 2026
**Назначение:** единый источник фактов о production-окружении

---

## 1. Базовое

| Параметр | Значение |
|----------|----------|
| Домен | дом-эксперт.рф (xn----gtbetilkjgn9i.xn--p1ai) |
| Хостинг | SpaceWeb, тариф Start |
| SSH-сервер | vh326.sweb.ru |
| WP-версия | 7.0 |
| PHP | 8.3 (web), 5.2 (CLI default — всегда использовать `php8.3`) |
| Тема | **Kadence 1.5.1** (FSE, активна) |
| MySQL | 5.7.27 (port 3308) |

## 2. Активные плагины

| Плагин | Назначение |
|--------|------------|
| Kadence Blocks | Gutenberg-блоки под дизайн |
| Rank Math SEO | SEO, sitemap, breadcrumbs JSON-LD |
| Fluent Forms | Формы лид-сбора |
| WP Super Cache | Кеширование |
| iThemes Security | Безопасность |
| WP Mail SMTP | SMTP-отправка писем |
| UpdraftPlus | Бэкапы |
| Safe SVG | Разрешённые SVG в медиатеку |
| Vibe AI | AI-плагин WordPress |
| MCP Adapter | MCP-интеграция |
| Duplicate Post | Удобство редактора |
| site-re-core | Собственный плагин: CPT + таксономии |
| Akismet | Антиспам |
| site-re-mu (mu-plugin) | 404 page override, breadcrumbs output |

## 3. Deploy-схема

```
Git push → GitHub Actions → rsync (--delete) → ~/deploy/site_re/ (staging)
                                                   ↓ cp (выборочно, без --delete)
                                            ~/public_html/ (боевой)
```

- Репозиторий: `gest0r1/site_re` (приватный)
- В staging полная синхронизация
- В public_html только нужные файлы (без `--delete`)
- Прямой rsync в public_html **запрещён**

## 4. Дизайн-система (Концепция A — Экспертность + доверие)

### Design tokens

```css
--de-navy:       #10233F;
--de-navy-2:     #172D4B;
--de-green:      #2F7D46;
--de-green-hover:#256B3B;
--de-gold:       #C8A468;
--de-warm:       #F7F5F2;
--de-warm-2:     #F3F0EA;
--de-white:      #FFFFFF;
--de-line:       #D8DEE8;
--de-text:       #172033;
--de-muted:      #667085;
--de-muted-light:#98A2B3;
```

### Kadence настроен (07-kadence-current-settings.md)

| Блок | Статус |
|------|--------|
| Layout | ✅ content max 1240px, boxed, narrow posts |
| Sidebar | ✅ disabled |
| Images | ✅ radius 0, lightbox off |
| Back to Top | ✅ navy/gold, outline, 12px radius |
| 404 | ✅ mu-plugin: консультация + ссылки |
| Comments | ✅ отключены |
| Breadcrumbs | ✅ Rank Math, separator `/` |
| Social Links | ✅ phone + email в footer |
| Performance | ✅ fonts local, microdata off, sitemap off |

## 5. Структура сайта

Source of truth: `plans/wordpress-realtor/gate2-v2.md` + `updated-site-structure.md`

### Header (5 разделов)
1. Владельцам → `/sell/`
2. Покупателям → `/buyers/`
3. О компании → `/about/`
4. Материалы → `/blog/`
5. Контакты → `/contacts/`

### Footer
- Отзывы | Материалы | Контакты | О компании
- Legal: privacy, cookie, terms

## 6. Этапы проекта

| Этап | Статус |
|------|--------|
| Stage 1 — аудит хостинга | ✅ done |
| Stage 2 — опербаза | ✅ done |
| Stage 3 — IA / content model | ✅ done (archive) |
| Stage 4 — Foundation | 🔄 partial: CPT+theme scaffold готовы, ACF не стоит, Git rules/opencode context нет |
| Stage 5 — дизайн-система | ✅ done (Kadence настроен, docs в /документация) |
| Stage 6 — плагины конфиг | ⚠️ partial: установлены, конфиг не формализован |
| Stage 7 — контент + AI | ❌ не начат (черновики в /pages/ есть) |
| Stage 8 — release flow | ✅ done (GitHub Actions) |
| Stage 9 — риск-калькуляторы | ⬜ future |
| Stage 10 — каталоги | ⬜ future |
| Stage 11 — подбор | ⬜ future |

## 7. Блокеры

- **SSL/HTTPS** ❌ — самоподписанный истёк, нужен Let's Encrypt
- **MySQL CLI-доступ** ❌ — только через PHP-FPM
- **Backup/restore** ❌ — не проверен
- **ACF Pro** ❌ — не установлен (site-re-core пытается грузить class-acf-fields.php)

## 8. Контент (черновики)

Markdown-черновики всех страниц в `/pages/`:
- Главная, Владельцам (8 подстраниц), Покупателям (9+2 каталог), О компании, Отзывы, Контакты, legal страницы
- Статус: Gate 3 — тексты утверждены, в WordPress не залиты
- Формы: Fluent Forms готов, Telegram relay настроен
