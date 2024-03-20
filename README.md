# Настройка
- Запускаем контейнер
```
sudo chmod -R 777 img/ && docker compose up --build
```
- Заходим внутрь контейнера (узнать id: ```docker ps -a```)
```
docker exec -it ид_контейнера /bin/bash
```
Запускаем обновление composer
```
composer install
```