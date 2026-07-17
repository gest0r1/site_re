# Этап 2. Операционная база

## Зачем
До первого выхода в прод нужна безопасная эксплуатация, причём разработка и проверка должны идти локально, а на хостинге остаётся только production-версия.

## Принципы
- **Local-only development** — вся разработка и полная функциональная проверка выполняются локально.
- **Prod-only hosting** — на хостинге нет рабочей среды для разработки; там только production, transit-буфер для деплоя и post-deploy checks.
- **Review before deploy** — каждый релиз/изменение проходит ревью до переноса в прод.

## Что сделать
- подготовить локальную копию (clone/mirror) боевого сайта: файлы + snapshot БД
- развернуть под локальную копию инфраструктуру (локальный web/PHP/MySQL стек или Docker/wp-env/OpenServer)
- проверить локальный домен/hosts, HTTP 200 и доступ в wp-admin
- настроить backup/restore процесс: backup с prod перед обновлением, local restore при поломке разработки
- описать rollback
- подготовить host-side transit directory (`~/deploy/site_re/`) как безопасный буфер деплоя, не как среду разработки
- проверить SMTP / отправку писем
- определить cache policy
- зафиксировать роли доступа
- включить базовый logging
- описать update policy for themes/plugins/core: сначала local, потом prod
- подготовить admin security baseline / 2FA

## Local-only development policy
- рабочие изменения делаются только локально
- Git хранит код, шаблоны, ассеты и документацию; БД и uploads не являются source of truth
- хостинг не используется как dev sandbox
- перенос в прод допускается только после review gate

## Prod-only hosting policy
- на хостинге остаётся только production-версия
- допускаются только deploy transit, backup artifacts и обязательные smoke/post-deploy checks
- прямой `rsync --delete` в `public_html` запрещён
- в wp-admin на хостинге допускаются только контентные правки и эксплуатационные действия, не разработка кода

## Single local copy rule
- локальная копия делается один раз из prod и становится рабочей базой разработки
- повторный clone с prod допускается только если локальный стенд неустранимо сломан
- в обычном цикле разработка не начинается заново с новой prod-копии
- при локальной поломке используется restore из последнего prod backup

## Git file policy (include-only)
- в Git попадают только файлы, нужные для переноса и деплоя: тема, кастомные плагины, mu-plugins, root-assets, deploy-скрипты, тесты, документация
- всё, что не нужно для переноса, исключается: БД, uploads, wp-core, секреты, prod backup-артефакты
- `.gitignore` должен работать по модели deny-by-default с allowlist через `!`

## Local testing scripts
- `tests/smoke.sh` — локальный smoke test (главная, wp-admin, базовые формы/роуты)
- `tests/restore.sh` — восстановление локального стенда из prod backup
- `tests/check-config.sh` — проверка wp-config, констант и запрещённых настроек prod

## Update rule: local first
1. изменение темы/плагина/конфига делается локально
2. прогоняется `tests/smoke.sh`
3. изменения коммитятся в Git
4. затем выполняется deploy на prod из Git
5. на prod выполняется post-deploy smoke test

## Backup & retention policy
- backup делается с prod перед каждым обновлением
- backup хранится вне `public_html`, например в `~/backups/site_re/`
- хранится только 2 последних backup; старые удаляются автоматически
- backup предназначен для local restore, если локальная разработка что-то сломала
- локальный backup стенда опционален и не влияет на prod-retention

## Restore flow
- сценарий локальной поломки: взять свежий prod backup, восстановить локально, проверить smoke, затем продолжить разработку
- сценарий поломки prod после deploy: восстановить prod из последнего backup, затем проверить smoke
- restore всегда завершается smoke test
- если последний backup не подходит, используется предыдущий; оба не подходят — incident

## Review gate
- локальная копия собрана и запускается
- backup/restore проверен на локальной копии
- политики local-only / prod-only / update / access зафиксированы
- локальные тестовые скрипты есть и проходят
- Git содержит только разрешённые файлы для переноса
- retention policy для backup действует (2 последних)
- назначен reviewer и получено подтверждение на перенос в prod

## Результат
- есть локальная копия сайта и рабочая инфраструктура под неё
- есть проверенная точка отката и восстановление
- есть безопасная схема обновлений
- есть локальная среда проверки
- на хостинге остаётся только production + transit-буфер деплоя

## Owner
- **Owner:** developer + reviewer + admin

## Тесты этапа
- [ ] local clone runs on its own infrastructure
- [ ] local GET / returns HTTP 200
- [ ] local wp-admin access works
- [ ] backup restores on local test copy
- [ ] local SMTP/mail test delivers a message
- [ ] role permissions are correct
- [ ] admin smoke test passes locally
- [ ] host-side transit directory reachable for deploy flow
- [ ] plugin/theme/core update policy documented

## Release gate
Без успешного local backup + restore + local smoke test + review gate + соблюдения общего release gate (`00-release-principles.md` / `08-release-flow-and-deploy.md`) в прод не идём; внешние blockers Stage 1, особенно валидный HTTPS на хостинге, тоже должны быть закрыты.
