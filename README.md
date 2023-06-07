##Система управления студентами, классами и лекциями через Api на основе Laravel и MySQL.

Построена на нескольких связанных таблицах через OneToMany и ManyToMany.  
Все методы работы с моделями вынесены в сервисы.  
Все запросы GET обрабатываются без входящих данных.  
Запросы POST, PUT, DELETE поддерживают входные данные в JSON и x-www-form-urlencoded.  
Запросы POST поддерживают входные данные в form-data.  
Все входные данные детально валидируются реквестами.  

###Установка:
- `php composer.phar update`
- Поменяйте настройки вашей базы данных в файле .env
- Запустите в рабочем каталоге `php artisan migrate:fresh --seed` для заполнения базы данных тестовой информацией.
- Запустите `php artisan serve`

###Все пути API и формат входных данных:

`/api/students` - метод GET - получить список и id всех студентов

`/api/students/{id}` - метод GET - получить детальную информацию о студенте по id (класс и лекции)

`/api/students/create` - метод POST - создать студента  
Входные данные: `{ "name":"имя", "email":"email (уникальный)", "class_id":"прикрепить к классу с id (опционально)"}`

`/api/students/update` - метод PUT - обновить студента  
Входные данные: `{ "id":"id студента", "name":"имя", "class_id":"прикрепить к классу с id"}`

`/api/students/delete` - метод DELETE - удалить студента  
Входные данные: `{ "id":"id студента" }`



`/api/classes` - метод GET - получить список и id всех классов

`/api/classes/{id}` - метод GET - получить детальную информацию о классе по id (+ всех студентов класса)

`/api/classes/{id}/getplan` - метод GET - получить детальную информацию об учебном плане по id класса

`/api/classes/setplan` - метод POST - перезаписать учебный план  
Входные данные: `{ "id":"id класса", lectures: [ 3, 4, 5, 6, 7, ... - массив id лекций]} `  
Массив lectures должен содержать ряд уникальных целых чисел, соотносящихся с id лекций. Каждое число валидируется и проверяется в реквестах.

`/api/classes/create` - метод POST - создать класс  
Входные данные: `{ "name":"наименование (уникальное)" }`

`/api/classes/update` - метод PUT - обновить класс  
Входные данные: `{ "id":"id класса", "name":"наименование (уникальное)" }`

`/api/classes/delete` - метод DELETE - удалить класс  
Входные данные: `{ "id":"id класса" }`  
При удалении класса удаляется вся его учебная программа и открепляются все студенты (их можно переназначить через /api/students/update)



`/api/lectures` - метод GET - получить список и id всех лекций

`/api/lectures/{id}` - метод GET - получить детальную информацию о лекции по id (все изучающие классы + все изучающие студенты)

`/api/lectures/create` - метод POST - создать лекцию  
Входные данные: `{ "subject":"наименование (уникальное)" , "description":"описание" }`

`/api/lectures/update` - метод PUT - обновить лекцию  
Входные данные: `{ "id":"id лекции", "subject":"наименование (уникальное)", "description":"описание"}`

`/api/lectures/delete` - метод DELETE - удалить лекцию  
Входные данные: `{ "id":"id лекции" }`  
При удалении лекции она удаляется из всех учебных программ.  