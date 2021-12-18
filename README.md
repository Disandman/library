# 
 
 Первый запуск приложения:
1) переименовать файл .env.dist в .env
2) docker-compose -f "docker-compose.yml" up -d --build
3) docker-compose exec app composer install
4) docker-compose exec app php vendor/bin/doctrine orm:schema-tool:create
5) открыть localhost:8005 и нажать кнопку инициализировать.