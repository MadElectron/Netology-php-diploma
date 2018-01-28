# Netology-php-diploma

Дипломный проект по программе **"PHP/SQL: back-end разработка и базы данных"** [университета интернет-профессий "Нетология"](https://netology.ru) по теме **"Типовой сервис вопросов и ответов (FAQ)".**

## Установка

1. [Установить git](https://git-scm.com/book/ru/v1/%D0%92%D0%B2%D0%B5%D0%B4%D0%B5%D0%BD%D0%B8%D0%B5-%D0%A3%D1%81%D1%82%D0%B0%D0%BD%D0%BE%D0%B2%D0%BA%D0%B0-Git) в нужную директорию, затем клонировать репозиторий:

```
git clone https://github.com/MadElectron/Netology-php-diploma.git
```
Все необходимые пакеты уже находятся в репозитории.

2. Отредактировать файл конфигурации ```.env```, установив необходимые значения полей ```DB_```.
3. Произвести миграцию базы данных:
```
php artisan migrate
```
4. Заполнить БД  тестовыми данными
```
php artisan db::seed
```

## Панель администрирования

Вход в панель администрирования осуществляется по прямой ссылке **/home**.
При заполнении тестовыми данными в БД создан пользователь с правами администратора:
* Имя: **admin**
* E-mail: **admin@admin.com**
* Пароль: **admin**




