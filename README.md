# PHP MVC framework
Минималистичный PHP MVC фреймворк, созданный по серии уроков [@thecodeholic](https://github.com/thecodeholic) в обзразовательных целях.
В дальнейшем буду вносить свои изменения.

## Фреймворк не предназначен для продакшена. Если Вы применяете его в реальных проектах, то принимаете на себя все риски.
**Ядро фреймворка**: [php-mvc-core](https://github.com/twent/php-mvc-core) (создан на основе репозитория [TheCodeholic/PHP-MVC-Framework](https://github.com/thecodeholic/php-mvc-framework))

----
## Установка

1. Скачайте архив или склонируйте git репозиторий
2. Создайте БД
3. Создайте `.env` файл на основе `.env.example` и укажите данные для подключения к БД
4. Запустите `composer install`
5. Примените миграции командой `php migrations.php` из корневой директории проекта.
6. Перейдите в директорию `public`
7. Запустите PHP сервер с помощью команды `php -S 127.0.0.1:8080`
8. Откройте в браузере http://127.0.0.1:8080


> Этот проект создан на основе серии уроков от [@thecodeholic](https://github.com/thecodeholic) на Youtube "[Build PHP MVC Framework](https://www.youtube.com/playlist?list=PLLQuc_7jk__Uk_QnJMPndbdKECcTEwTA1)".
