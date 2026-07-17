# Этап 1. Аудит SpaceWeb

## Зачем
Понять, как именно деплоить и обслуживать сайт на тарифе Start.

## Что проверить по документации хостинга
- SSH
- SFTP
- Git deploy / pull from repo
- WP-CLI
- cron
- лимиты upload / memory / max execution time
- backup/restore
- mail / SMTP
- права на файлы и папки
- PHP / WordPress / MySQL versions
- SSL / HTTPS
- DNS / domain hookup
- admin hardening and 2FA availability

## Результат
- выбран способ деплоя
- понятны ограничения тарифа
- известен способ бэкапа и отката

## Owner
- **Owner:** developer + hosting admin

## Тесты этапа
- [ ] panel access ok
- [ ] test file/folder creation works
- [ ] SSH command execution works if enabled
- [ ] backup can be created
- [ ] backup can be restored on test copy
- [ ] HTTPS active and valid
- [ ] domain resolves correctly

## Release gate
Этап закрывается только после подтверждения, что выбранный способ деплоя и отката реально работает.

## Прод
Если аудит успешен, можно переходить к этапу 2 и готовить первую прод-итерацию.
