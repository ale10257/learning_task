Учебные задачи
======
Условие для первой задачи
------
Есть две сущности - Документ и Запись для документа. Таблицы в БД: documents (id, name) и documents_list (id, name, id_document). Связь один к одному для обеих таблиц. Одной записи в documents соответствует одна запись в documents_list, и наоборот.

При заполнении формы с обеими сущностями, мы должны убедиться, что имя Документа уникально, и только после этого открыть поле для заполнения Записи документа.

<h4>Решение основано на базовом шаблоне Yii2</h4>

1. Клонируем репозиторий 

2. Запускаем композер (composer update)

3. Создаем базу данных testDB, прописываем данные для подключения (создать файл db.php в каталоге config по образцу db_example.php)

4. Накатываем миграции

5. Разворачиваем тестовый локальный сайт, например, test.loc

6. Заходим на сайт test.loc, раздел меню Test, пробуем создать/обновить форму. Поле для записи documents_list открывается при наступлениии события onBlur.

7. Изучаем решение

Условие для второй задачи
------

Необходимо создать рассылку, которая содержит список статей с лидами. Т.е. пользователь заходит на страницу создания рассылок, вводит название рассылки, по поиску через ajax подтягивает статью, её лид и заголовок. Лид статьи для рассылки можно редактировать, заголовок нельзя (поле только для чтения).

Если формализовать решение данной задачи, то она сводится к работе с табличнымм вводом (tabular form)
https://yiiframework.com.ua/ru/doc/guide/2/input-tabular-input/

Для изучения решения делаем такие же шаги, как в первой задаче + создаем тестовые статьи запуском команды `./yii faker-article`, раздел меню Mail list