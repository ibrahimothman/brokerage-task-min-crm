

## Some instructions to use the repo

* Update laravel/installer to the latest version 4.1.0
* Run composer install
* Run npm install && npm run dev
* Setup the .env and add your own database settings
* Run php artisan migrate --seed to seed some statuses [call, visit, follow up]

## what do i use in this project

* Laravel 8
* Vue.js

## How can you use it

* First you have to register. The registered user will be the admin by default
* Admin can show / create employees
* Admin can give a random password to the employee
* Admin can show / create customer
* Admin can assign a customer to an employee by clicking on the `change` button corresponding to each customer
* Admin can show / update customer's status once the customer is assigned to an employee.
* Employee can show his own customers
* Employee can create customer which by default be assigned to him
* Employee can update the customer's status
* Employee can not show the employees page

