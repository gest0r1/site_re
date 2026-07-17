# Этап 10 / Фаза роста 2. Каталоги недвижимости

## Зачем
Сделать ядро для новостроек, вторички и сравнения вариантов.

## Что входит
- каталог новостроек
- каталог вторички
- карточки объектов
- фильтры
- сравнение
- подбор по баллам
- комментарии по застройщикам

## Owner
- **Owner:** product owner + developer + content editor

## Новостройки
- максимальная автоматизация выгрузки объектов
- потом ручное заполнение доп. полей админом

## Performance / data quality
- list page target: 2s or faster on 500 test objects
- duplicate objects are merged or flagged
- missing fields are shown gracefully

## Вторичка
- более ручной контур
- акцент на фильтры и качество карточки

## Тесты этапа
- [ ] import objects works
- [ ] deduplication works
- [ ] filters work
- [ ] sorting works
- [ ] property card renders correctly
- [ ] list page loads under 2s with 500 test objects
- [ ] admin can enrich fields after import

## Release gate
В прод только после проверки импорта, фильтров и скорости.
