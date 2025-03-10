Задача:
Сгенерировать турнирную таблицу, где команды разделены на 2 дивизиона A и B.
В каждом дивизионе команды играют каждая с каждой и, в конечном результате, 4 лучшие команды из каждого дивизиона выходят в плей-офф.
График игр плей-оффа проходят по принципу "ёлочки": лучшая команда играет против слабейшей, где победитель проходит дальше, а проигравший выпадает из дальнейшего участия.
В результате победит та команда, которая выиграет во всех играх плей-оффа.

Дополнительные условия к задаче:
    - реализовать на PHP7+
    - в реализации показать свои лучшие знания по ООП
    - важны архитектура приложения и тесты
    - чтобы не пришлось вводить все результаты вручную, реализовать генератор данных, например по нажатию на кнопки заполнить результаты для дивизиона A, B, и затем для таблицы плей-офф
    - UI на своё усмотрение (пример в приложении), много времени затрачивать не нужно, можно использовать фреймворки
    - результаты должны сохраниться в базу данных (mysql/postgresql)
    - можно использовать фреймворк на своё усмотрение symfony


Примечания к решению:
Реализовано формирование таблицы результатов регулярного чемпионата.

Для запуска приложения потребуется docker и docker-compose. Контейнеры собираются минут пять.

После сборки контейнеров потребуется запустить миграцию.

Таблица реализована на localhost/standings/

# Docker Setup for Symfony 6.3.* Web Apps

Docker containers for traditional Symfony 6.3.* web apps, i.e., apps that you would usually create using the `--webapp` Symfony CLI option or the `composer require webapp` command.

## What is inside

- **Nginx** webserver
- **PHP 8.2** (with `composer`)
- **MySQL 8.0**
- **phpMyAdmin**

## Local dev guide (Linux)

1. Clone the repo:
    ```.sh
    git clone https://github.com/TOA-Anakin/symfony-webapp-docker-dev.git
    ```
2. Rename the cloned repo as desired: 
    ```.sh
    mv symfony-webapp-docker-dev your_project_name
    ```
3. Find your user ID using the `id -u` command and update the `.docker/.env` file accordingly.
4. `cd` into the `.docker` directory and build the Docker containers:
    ```.sh
    cd your_project_name/.docker
    docker compose up -d --build
    ```
    Before the end of the process you should see a list of newly created (now running) containers:
    ```.sh
    [+] Running 6/6
    ✔ Network symfony_webapp_docker_symfony_app
    Created                                         0.1s 
    ✔ Volume "symfony_webapp_docker_db_app"
    Created                                         0.0s 
    ✔ Container symfony_webapp_docker-phpmyadmin-1
    Started                                         0.2s 
    ✔ Container symfony_webapp_docker-php-1
    Started                                         0.2s 
    ✔ Container symfony_webapp_docker-db-1
    Started                                         0.2s 
    ✔ Container symfony_webapp_docker-nginx-1
    Started                                         0.2s 
    ```
5. Open the terminal of the PHP container (mine is named `symfony_webapp_docker-php-1`) and create a Symfony skeleton project using `composer`:
    ```.sh
    docker exec -it symfony_webapp_docker-php-1 bash
    composer create-project symfony/skeleton:"6.3.*" tmp_dir
    ```
    Move the contents of `temp_dir` into the project root:
    ```.sh
    mv tmp_dir/* . && mv tmp_dir/.[!.]* . && rmdir tmp_dir
    ```
    Install Symfony web app packages:
    ```.sh
    composer require webapp
    ```
    ***Note:*** If you are prompted with a question `Do you want to include Docker configuration from recipes?`, answer `n [No]`.
6. Access your Symfony web app at http://localhost, phpMyAdmin is accessible at http://localhost:8081
