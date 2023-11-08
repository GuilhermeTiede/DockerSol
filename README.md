# DockerSol
It´s a full finance system for a small company, it´s made with Laravel and Docker.

Execute the docker-compose file with the command:

``` docker-compose build && docker-compose up -d ```

Then, execute the migrations with the command:

``` docker-compose exec app php artisan migrate ```

Configure your routes and passwords in the .env file, and 
in the docker-compose.yml file, change the ports if you want.

