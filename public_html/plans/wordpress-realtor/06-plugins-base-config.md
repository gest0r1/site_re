# Этап 6. Плагины и базовая конфигурация

## Зачем
Сделать сайт управляемым, безопасным и готовым к росту.

## Что подключить
- SEO
- формы
- безопасность
- кеш
- backup
- аналитика
- SMTP
- редакторские удобства

## Security / privacy gate
- privacy policy published
- consent checkbox on forms
- CAPTCHA / anti-spam enabled
- lead transfer tested securely
- admin roles reviewed
- no personal data sent to AI by default

## Owner
- **Owner:** developer + admin

## Что важно
- не ставить лишнее
- проверять конфликты
- фиксировать, что настраивается кодом, а что админом

## Тесты этапа
- [ ] form submits successfully
- [ ] form response is received within 2 minutes
- [ ] SEO metadata available
- [ ] cache does not break templates
- [ ] backup runs successfully
- [ ] admin workflow has no errors
- [ ] anti-spam blocks junk submissions
- [ ] privacy/consent shown on forms

## Release gate
Прод только после smoke test плагинов и проверки конфликтов.
