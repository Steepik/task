# Парсер для rss ленты

## Требования
* php >=7.4
* MariaDb 10+ или Mysql 5.8+

## Установка
1. перейдите в папку куда вы хотите установить проект (папка должна быть пуста)
2. git clone https://github.com/Steepik/task.git .
3. composer update
4. Переименовать файл env.example в .env и указать в нем доступы к БД (найдите DB_DATABASE=test и т.п)
5. php artisan key:generate
6. php artisan migrate

### Запуск вручную через консоль
> php artisan parser:run --url=http://static.feed.rbc.ru/rbc/logical/footer/news.rss

### Запуск через cron
в cron добавьте задачу вида:
> \* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

### Админка по ссылке
> http://yourdomain.com/records