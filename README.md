# 
 
 Первый запуск приложения:
1) переименовать файл .env.dist в .env
1) docker-compose -f "docker-compose.yml" up -d --build
2) docker-compose exec app composer install
3) docker-compose exec app php vendor/bin/doctrine orm:schema-tool:create