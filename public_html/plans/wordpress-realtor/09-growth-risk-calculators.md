# Этап 9 / Фаза роста 1. Риск-калькуляторы

## Зачем
Добавить AI-анализ рисков как отдельный продуктовый модуль.

## Что нужно заранее
- правила оценки
- источники данных
- шкала баллов
- дисклеймеры
- логика объяснений
- формы ввода

## Formula validation
- [ ] each formula has owner and version
- [ ] golden fixtures exist for low / medium / high risk cases
- [ ] expected score range documented per fixture
- [ ] formula changes require product owner approval
- [ ] saved results store formula version
- [ ] old results show "calculated with version X"
- [ ] AI explanation cannot override numeric formula result

## Privacy / safety
- no personal data sent to AI by default
- disclaimer visible near result
- rate limit on calculation requests
- audit trail for formula version

## Owner
- **Owner:** product owner + developer

## Owner
- **Owner:** product owner + developer

## Что должно работать
- ввод параметров объекта
- расчет риска
- комментарии AI
- сохранение результата
- передача лида в CRM/почту

## Тесты этапа
- [ ] valid inputs return stable result
- [ ] boundary values handled
- [ ] empty fields rejected or defaulted clearly
- [ ] explanations are understandable
- [ ] disclaimer visible
- [ ] no PII sent to AI by default
- [ ] golden fixtures return expected outputs

## Release gate
Только после валидации формул, текста и отказоустойчивости.
