##  Getting weather information with Laravel and rest api

## Environment; 
- PHP 7.2
- Laravel 6.0
- Laravel Passport
- Redis
- Queue

#### Usage
Clone the project via git clone or download the zip file.

##### .env
Copy contents of .env.example file to .env file. Create a database and connect your database in .env file.

##### Composer Install
cd into the project directory via terminal and run the following  command to install composer packages. When you "composer install", the "php artisan migrate" and "php artisan db:seed" commands will be activated automatically. You don't need to do anything extra;
###### `composer install`
##### Generate Key
then run the following command to generate fresh key.
###### `php artisan key:generate`
##### Run Migration
then run the following command to create migrations in the databbase.
###### `php artisan migrate`
##### Passport Install
run the following command to install passport
###### `php artisan passport:install`
##### Database Seeding
finally run the following command to seed the database with dummy content.
###### `php artisan db:seed`
 
### API EndPoints
##### User
* User Login POST `http://localhost:8000/api/login`
* User Register POST `http://localhost:8000/api/register`
* User Logout POST `http://localhost:8000/api/logout`
* User Info GET `http://localhost:8000/api/info`
* User Update PUT `http://localhost:8000/api/update`
##### Campaign
* Campaign List GET `http://localhost:8000/api/campaign`
* Campaign Add Campaign POST   `http://localhost:8000/api/add-campaign`

##### Weater
* Weater List GET `http://localhost:8000/api/weater`
* Weater City Weater GET `http://localhost:8000/api/weater/city/{id}`
* Weater User Favorite Weater GET `http://localhost:8000/api/weater/user`
* Weater User Add Favorite Weater POST `http://localhost:8000/api/weater/user`
* Weater User Delete Favorite Weater DELETE `http://localhost:8000/api/weater/user/delete/{id}`
 
