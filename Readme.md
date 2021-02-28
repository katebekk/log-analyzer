Для запуска программы необходимо склонировать проект и запустить dockerfile находящийся внутри папки с проектом.
Для запуска dockerfile необходимо запустить docker, а далее выполнить следующие шаги для запуска программы: 
1. Открыть консоль внутри папки с проектом и поочередно ввести следующие ккоманды
    - docker build -t php_docker . 
    - docker run --name php -d php_docker (создает контэйнер с именем php)
    - docker exec -it php /bin/bash (запускает консоль)
2. docker-compose :
    - docker-compose up --build
    - docker-compose run --rm php
    - docker-compose exec php bash



3. cat access.log | php analyze.php -u 99.9 -t 45



