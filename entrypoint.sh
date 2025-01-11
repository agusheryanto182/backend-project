#!/bin/sh

php artisan migrate
php artisan db:seed --class=DivisionSeeder
php artisan db:seed --class=UserSeeder

php artisan serve --host=0.0.0.0 --port=3000
