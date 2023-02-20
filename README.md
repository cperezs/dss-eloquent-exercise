# [DSS] Eloquent exercise

## Project initialization

After downloading the project execute
```shell
composer install
cp .env.example .env
```

Configure the .env file setting the proper values for database, user and password. Then execute these commands
```shell
php artisan key:generate
php artisan migrate:install
php artisan migrate
```

## Troubleshooting

If your DSS database already had some tables from a previous project, you can delete them using Adminer and execute the migrations again. Alternatively, you can execute this command
```shell
php artisan migrate:fresh
```

If you have dependency errors when initializing the project, execute this command
```shell
composer update
```

## Writing your code

Your models must be in the `App\Models` namespace. The feature tests in this project will try to load them in the following way:
```php
use App\Models\Player;
use App\Models\Team;
use App\Models\Sponsor;
```

You must also create the migrations in folder `database/migrations`, and the seeders in folder `database/seeds` for initializing the database. You can execute them together with:
```shell
php artisan migrate --seed
```

## Running the tests

The folder `tests/Feature` contains several tests for the exercise. Once you have written your code, and executed the migrations and seeders, run PHPUnit with:
```shell
vendor/bin/phpunit
```
