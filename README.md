
## About Project

This project is the backend project

## Running Project
These are the commands you should execute one by one to run the project:
- git init
- git clone https://github.com/alishaheen1988/restaurant-backend.git
- cd .\restaurant-backend\
- composer install
- create an empty database on MySQL
- copy the .env.example to .env file and set the database connection settings
- php artisan migrate
- php artisan key:generate
- php artisan db:seed
- php artisan serve  

then you will be able to login using one of these users:
- email: admin1@test.com     password: 123456
- email: admin2@test.com     password: 123456
- email: admin3@test.com     password: 123456