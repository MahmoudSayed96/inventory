# Inventory

Watch demo **[Inventory](https://inventory-v.herokuapp.com/)**.

Inventory is a SPA application for manage point of sale (POS)
using Vue and PHP laravel framework (RESTful API)
and using JWT for authentications.

## setup
For setup inventory application on local server. For that, follow the below steps:

### Install composer dependencies
```
cd inventory
composer install
```
### Database Migrations
After installing composer dependencies, add your database credentials in `.env` file and then run migrations.
```
php artisan migrate
```
Now it's time to generate some dummy data. It will generate dummy data using faker. So, run `db:seed` to generate some dummy data.
```
php artisan db:seed
```
Now, in the terminal run `artisan serve` command. It will run the application at `http://127.0.0.1:8000` URL, and that URL path used in the Vue source code
change end point in `resources/js/AppEnv.js`.
```
php artisan serve
```
```php
const env = {
    'APP_URL' : 'https://127.0.0.1:8000/',
};
```