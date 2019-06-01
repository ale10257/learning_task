Учебная задача
======
Условие
------
Есть две сущности - Документ и Запись для документа. Таблицы в БД: documents (id, name) и documents_list (id, name, id_document). Связь один к одному для обеих таблиц. Одной записи в documents соответствует одна запись в documents_list, и наоборот.

При заполнении формы с обеими сущностями, мы должны убедиться, что имя Документа уникально, и только после этого открыть поле для заполнения Записи документа.

<h4>Решение основано на базовом шаблоне Yii2</h4>

1. Клонируем репозиторий 

2. Запускаем композер (composer update)

3. Создаем базу данных testDB, прописываем данные для подключения (создать файл db.php в каталоге config по образцу db_example.php)

4. Накатываем миграции

5. Разворачиваем тестовый локальный сайт, например, test.loc

6. Заходим на сайт test.loc, раздел меню Test, пробуем создать/обновить форму

7. Изучаем решение
