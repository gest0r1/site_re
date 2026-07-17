# Этап 11 / Фаза роста 3. Модуль подбора недвижимости

## Цель
Сделать модуль выбора объекта по баллам, комментариям и фильтрам.

## Функции
- scoring по застройщикам и объектам
- комментарии и пояснения к баллам
- фильтры подбора
- сравнение вариантов
- вывод рекомендованного списка

## Требования
- score rules должны быть объяснимы
- фильтры должны работать быстро
- админ должен редактировать веса
- результаты должны быть понятны клиенту

## Data model
- property
- developer
- score rule
- weight set
- result
- override
- version history
- score explanation

## Edge cases
- no matches
- equal scores
- missing field values
- outdated score version
- manual admin override

## Privacy / safety
- no personal data by default
- scores and explanations stored with version
- disclaimer on recommendation results

## Owner
- **Owner:** product owner + developer + analyst

## Тесты этапа
- [ ] scoring returns expected ranking
- [ ] comments shown with scores
- [ ] filters narrow results correctly
- [ ] admin can adjust weights
- [ ] disclaimer visible
- [ ] no-match state shows helpful message
- [ ] equal-score tie breaks deterministically
- [ ] outdated score versions are labeled

## Release gate
В прод только после проверки логики рейтинга, фильтров и UX.
