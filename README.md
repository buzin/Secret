# Secret Service

Сервис предназначен для безопасного обмена текстовыми данными. Например это могут быть доступы к сайтам и прочее.

## Сценарий использования

- Пользователь А размещает секретный контент. Защищает его паролем.
- При сохранении контента пользователю А показывается ссылка вида http://somesite.com/fgh8b5 
- В сервисе сохраняется зашифрованный контент.
- Контент становится доступным по короткой ссылке.
- Пользователь А передает пользователю Б ссылку на контент на сервисе. 
- Пользователь А передает пользователю Б пароль к контенту способом отличным от передачи ссылки.
- Пользователь Б заходит по ссылке. Вводит пароль от контента. Получает контент. Пользователь может удалить контент.

## HTTP REST API
- Получить секретный контент. Пароль передается в заголовке авторизации curl -i -X GET -H "Accept:application/json" -H "Authorization: Basic XXXXXXXXXXXXXX==" "https://somesite.com/api/v1/secret/fgh8b5"
- Удалить секретный контент. Пароль передается в заголовке авторизации curl -i -X DELETE -H "Accept:application/json" -H "Authorization: Basic XXXXXXXXXXXXXX==" "https://somesite.com/api/v1/secret/fgh8b5"

## Directory structure

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
```
