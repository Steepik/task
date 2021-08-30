# Парсер для rss ленты

### Сделайте миграцию БД
> php artisan migrate

### Запуск вручную через консоль
> php artisan parser:run --url=http://static.feed.rbc.ru/rbc/logical/footer/news.rss

### Запуск через cron
в cron добавьте задачу вида:
> \* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

### Админка по ссылке
> http://yourdomain.com/records