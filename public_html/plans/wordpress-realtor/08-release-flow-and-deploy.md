# Release flow и deploy

## Зачем
Сделать повторяемый цикл для всех этапов: stage → test → backup → prod.

## Правило
Каждый этап живёт по одному циклу:
1. подготовка
2. локальная проверка
3. backup
4. smoke tests
5. approval
6. deploy
7. post-deploy check

## Owner
- **Owner:** developer + approver

## Release gate checklist
- [ ] backup created and restore-tested
- [ ] deployment method confirmed
- [ ] smoke tests from `00-release-principles.md` passed
- [ ] forms deliver to expected destination
- [ ] logs checked after deploy
- [ ] rollback path verified
- [ ] responsible approver named
- [ ] release notes written
- [ ] no critical plugin/theme update pending

## Smoke test minimum
- main page returns HTTP 200
- menu links resolve without 404
- lead form submits test payload
- media renders on article and page
- admin login succeeds

## Что проверять после деплоя
- главная
- меню
- формы
- медиа
- мобильная версия
- админка

## Тесты этапа
- быстрый smoke test после выката
- сверка ключевых страниц
- проверка ошибок в логах

## Failure policy
Если smoke test или backup-check провален — релиз откатывается.
