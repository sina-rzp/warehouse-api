# Mini Warehouse

This mini warehouse is built using Laravel 5.3.




## Install

1) Run in your terminal:

``` bash
$ git clone https://github.com/sina-rzp/brosa-warehouse.git brosa-warehouse
```

2) Set your database information in your .env file (use the .env.example as an example);

3) Run in your brosa-warehouse folder:
``` bash
$ composer install
$ php artisan key:generate
$ php artisan migrate
```

## Usage 

1. Register a new user at http://localhost/brosa-warehouse/public/admin/register


2. Your admin panel will be available at http://localhost/brosa-warehouse/public/admin
a) Click on 'Orders' to create and edit orders
b) Click on 'Items' to create and edit items
b) Click on 'Products' to create and edit products


3. Send JSON data to http://localhost/brosa-warehouse/public/api/call with the format same as test_date.json



