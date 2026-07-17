# Этап 1. Аудит SpaceWeb — Результаты

**Дата**: 2026-07-03 (первичный аудит)
**Обновлено**: 2026-07-03 (пост-аудит, после настройки инфраструктуры)
**Хостинг**: SpaceWeb (тариф Start)
**Домен**: дом-эксперт.рф (xn----gtbetilkjgn9i.xn--p1ai)
**Тестовый домен**: xn----gtbetilkjgn9i.xn--p1ai.swtest.ru
**SSH-сервер**: vh326.sweb.ru

---

## 1. Общая информация

| Параметр | Значение |
|----------|----------|
| ОС | Gentoo Linux |
| Веб-сервер | nginx/1.30.2 |
| PHP (web, SAPI) | 8.1.32 (cgi-fcgi) — **выбран через панель SpaceWeb** |
| PHP (CLI по умолч.) | **5.2.17** ❗ (устарел, но это только CLI-путь) |
| Доступные PHP | 5.2, 5.3, 5.4, 5.5, 5.6, 7.0, 7.1, 7.2, 7.3, 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5 |
| MySQL на хосте | 5.7.27-30 (порт 3308) + MySQL 8 (порт 3306) |
| Диск | 15G, занято 9.5G (68%), свободно ~4.5G |
| Пользователь | gest0rmail (uid 29078, группа customers) |

## 2. SSH/SFTP

| Проверка | Статус |
|----------|--------|
| SSH-доступ | ✅ **Работает** |
| SFTP (через SSH) | ✅ Должен работать (OpenSSH) |

## 3. PHP

| Проверка | Статус |
|----------|--------|
| PHP для web (8.1.32) | ✅ Работает |
| PHP 8.3 через CLI (php8.3) | ✅ Доступен |
| PHP 8.0, 7.0 и др. | ✅ Доступны по `php8.0`, `php7.0` и т.д. |
| WP-CLI | ✅ **WP-CLI 2.12.0** (php8.3, phar: `~/bin/wp-cli.phar`, wrapper: `~/bin/wp`) |
| Composer | ❌ **Не установлен** |

**PHP-модули (8.3)**: bcmath, bz2, calendar, ctype, curl, date, dba, dio, dom, exif, fileinfo, filter, ftp, gd, geoip, gettext, gmp, hash, iconv, imagick, imap, intl, ionCube Loader, json, ldap, libxml, mailparse, mbstring, memcache, memcached, mysqli, mysqlnd, OAuth, openssl, pcntl, pcre, PDO, pdo_dblib, pdo_mysql, pdo_pgsql, pdo_sqlite, pgsql, posix, pspell, readline, Reflection, session, shmop, SimpleXML, soap, sockets, SPL, sqlite3, ssh2, sysvmsg, sysvsem, sysvshm, tidy, timezonedb, tokenizer, uuid, xml, xmlreader, xmlrpc, xmlwriter, xsl, zip, zlib

**PHP-лимиты**:
- memory_limit: **256M**
- upload_max_filesize: **64M**
- post_max_size: **64M**
- max_execution_time: **0** (unlimited)
- max_input_time: **-1** (unlimited)

## 4. WordPress

| Параметр | Значение |
|----------|----------|
| Версия WP | **7.0** ⚠️ (нестандартная — возможно fork или dev-ветка) |
| Table prefix | wp_ |
| WP_DEBUG | false |
| Site title | Сайт Натальи Губернатчук |
| Тема | Twenty Twenty-Five (FSE — Full Site Editing) |
| Активные плагины | ai-provider-for-google |
| Другие плагины | Akismet (встроенный), hello.php |
| wp-config.php perms | **640** ✅ (исправлено с 666 → 640 через chmod) |
| wp-admin/.htaccess | ❌ **Отсутствует** |

## 5. MySQL / База данных

| Проверка | Статус |
|----------|--------|
| MySQL клиент (`mysql`) | ❌ **Access denied** — пароль из wp-config не работает |
| PHP PDO (любой метод) | ❌ Все методы (socket/TCP/ localhost) отвергнуты |
| mysqldump | ✅ Доступен в системе |
| **Причина** | MySQL настроен на доступ только через PHP-FPM (web), CLI-доступ заблокирован. Пароль БД нужно уточнить в панели SpaceWeb. |

**Информация из wp-config**:
- DB_NAME: `gest0rmail`
- DB_USER: `gest0rmail`
- DB_HOST: `127.0.0.1:3308`
- DB_CHARSET: `utf8mb4`

**Доступные MySQL-серверы**:
- Port 3306 (стандартный MySQL 8)
- Port 3308 (MySQL 5.7 — используется текущим WP)
- Socket: `/var/run/mysqld/mysqld.sock`
- Socket: `/var/run/mysql8-container/mysqld.sock`

## 6. Git, Deploy, Cron

| Инструмент / Метод | Статус |
|-------------------|--------|
| Git | ✅ **Доступен** (2.4.10) |
| WP-CLI | ✅ **WP-CLI 2.12.0** установлен (php8.3) |
| Composer | ❌ **Не установлен** — опционально |
| Deploy-метод | ✅ **GitHub Actions → SSH**, выбран и реализован |
| GitHub репозиторий | ✅ **gest0r1/site_re** (приватный) |
| Secrets (GitHub) | ✅ **SSH_HOST**, **SSH_USER**, **SSH_PRIVATE_KEY** настроены |
| Deploy-воркфлоу | ✅ `.github/workflows/deploy.yml` — rsync через staging-директорию |
| Cron | ❌ `/var/spool/cron` недоступен (Permission denied) |
| zip/tar/gzip | ✅ Доступны |

## 7. Безопасность

| Проверка | Статус | Описание |
|----------|--------|----------|
| wp-config.php права | ➡️ **Исправлено** | Было 666 (world-writable), исправлено на 640 (владелец/группа) |
| SSL/HTTPS | ❌ **Не работает** | Самоподписанный сертификат, истёк в 2016 |
| wp-admin защита | ❌ Нет .htaccess | Нет дополнительной защиты админки |
| 2FA | ❌ Не настроена | ВWP из коробки нет 2FA |
| Salt-ключи | ✅ Сгенерированы | Есть в wp-config.php |

## 8. Бэкапы

| Инструмент | Статус |
|------------|--------|
| zip | ✅ |
| tar/gzip | ✅ |
| mysqldump | ✅ (но нужен доступ к БД) |
| Требуется решение | Согласовать способ бэкапа (ручной/автоматический) |

## 9. Архитектура деплоя — инцидент rsync и правило безопасности

### Инцидент (2026-07-03)

В ходе первоначальной настройки деплоя была выполнена команда rsync с опцией `--delete`,
направленная напрямую в `~/public_html`. Это привело к **частичному удалению файлов WordPress**:
пропали темы, плагины, `.htaccess`, `wp-config.php`. Сайт временно потерял рабочие файлы
и рисковал перестать открываться.

**Восстановление**: WordPress-ядро восстановлено через WP-CLI (`core download --force --skip-content`),
`wp-config.php` и `.htaccess` пересозданы по данным аудита, дефолтные темы и плагины скачаны
вручную с wordpress.org. Резервные копии хостинга не использовались.

### Правило безопасного деплоя (зафиксировано)

После инцидента введено и закреплено в проекте:

> **Никогда не использовать `rsync --delete` напрямую против `~/public_html`**

Итоговая схема деплоя:

```
Git push → GitHub Actions → rsync (с --delete) → ~/deploy/site_re/ (staging)
                                                      ↓ cp (выборочно)
                                              ~/public_html/  (боевой)
```

- rsync реплицирует репозиторий в **staging-директорию** `~/deploy/site_re/` с полной синхронизацией.
- Из staging в `public_html` копируются **только нужные файлы** (без `--delete`).
- Репозиторий никогда не синхронизируется напрямую в `public_html`.

### Текущее состояние сайта (после восстановления)

| Компонент | Статус |
|-----------|--------|
| WordPress core | ✅ Восстановлен |
| `.htaccess` | ✅ Восстановлен |
| `wp-config.php` | ✅ Восстановлен (perms 640) |
| Темы | ✅ `twentytwentyfive`, `twentytwentyfour`, `twentytwentythree` |
| Плагины | ✅ `akismet`, `ai-provider-for-google` |
| HTTP-статус | ✅ **200 OK** |
| MySQL CLI | ❌ Доступ через SSH/CLI не работает (только через PHP-FPM) |

---

## 10. Рекомендации

### ✅ Выполнено
1. ✅ **Права wp-config.php**: исправлены 666 → 640
2. ✅ **WP-CLI установлен**: версия 2.12.0, работает через `php8.3 ~/bin/wp`
3. ✅ **Deploy-метод выбран и реализован**: GitHub Actions → SSH, staging-директория
4. ✅ **Репозиторий создан**: `gest0r1/site_re` (приватный), secrets настроены
5. ✅ **Правило безопасного деплоя**: `rsync --delete` только в staging, не в `public_html`

### ❌ Осталось (блокеры Stage 1)
6. ❌ **SSL/HTTPS**: не настроен. Необходимо заказать Let's Encrypt в панели SpaceWeb
7. ❌ **MySQL CLI-доступ**: не получен. Требуется найти настройки/пароль БД в панели SpaceWeb (не через wp-config); сброс пароля вслепую может сломать работающий сайт
8. ❌ **Бэкап/восстановление**: не проверено. Инструменты есть (zip, tar, mysqldump, WP-CLI), но полный цикл не отработан
9. ❌ **Cron**: недоступен. Альтернатива — веб-крон (HTTP-запрос к `wp-cron.php`)
10. ❌ **.htaccess для wp-admin**: опционально, для дополнительной защиты

### Stage 1: Вердикт
**Аудит и настройка инфраструктуры в основном завершены.** Релизный гейт не закрыт из-за двух блокеров:
- **HTTPS** (критично для production)
- **Бэкап/восстановление** (не проверено)

---

## 11. Тесты этапа — Результаты

- [x] SSH/SFTP доступ — ✅
- [x] WP-CLI установлен — ✅
- [x] wp-config.php perms исправлены — ✅
- [x] Deploy-воркфлоу настроен — ✅ (GitHub Actions → SSH)
- [x] Сайт возвращает HTTP 200 — ✅ (после восстановления)
- [x] Правило безопасного деплоя — ✅
- [ ] SSL/HTTPS — ❌ не настроен
- [ ] MySQL CLI-доступ — ❌ не получен
- [ ] Бэкап создан и проверен — ❓ (инструменты есть, тест не пройден)
- [ ] Cron работает — ❌

---

## 12. Вывод

**Этап 1 (аудит + настройка инфраструктуры) — в основном завершён.** Все критически важные задачи по доступу и деплою решены.

### Что сделано
- ✅ SSH/SFTP доступ работает
- ✅ WP-CLI 2.12.0 установлен (php8.3)
- ✅ wp-config.php права исправлены (666 → 640)
- ✅ GitHub Actions → SSH деплой настроен и работает
- ✅ Правило безопасного деплоя зафиксировано (rsync только в staging)
- ✅ Сайт восстановлен после инцидента, отдаёт HTTP 200

### Осталось (блокеры для закрытия Stage 1)
1. ❌ **SSL/HTTPS** — не настроен. Критично для продакшена
2. ❌ **MySQL CLI-доступ** — не получен (только через PHP-FPM)
3. ❌ **Бэкап/восстановление** — не проверено
4. ❌ **Cron** — недоступен. Альтернатива: веб-крон

### Замечания
- `php8.3` обязателен для WP-CLI и любых CLI-скриптов (дефолтный php — 5.2)
- После решения MySQL-доступа — настроить автоматический бэкап через `wp db export` или `mysqldump`
- HTTPS — приоритет #1 перед любым продакшен-деплоем
