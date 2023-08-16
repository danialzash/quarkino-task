
<p align="center"><a href="https://quarkino.com/en" target="_blank"><img src="public/quarkino_logo.jpeg" width="170" alt="Quarkino Logo"></a></p>
<h1 style="text-align: center;">Quarkino Backend Challenge</h1>


<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://redis.com"><img src="https://img.shields.io/badge/redis-v7.0.12-%23D82C20.svg?logo=redis&logoColor=white" alt="Redis Version"></a>
<a href="https://mysql.com"><img src="https://img.shields.io/badge/mysql-v8.0-%2300758f.svg?logo=Mysql&logoColor=white" alt="Mysql Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Task Description

Develop a backend web application (API structure only) to simulate a shopping process.

- [Getting Started](#getting-started)
- [Inventory Management](#inventory-management)
- [Purchase Request](#purchase-request)
- [Payment Process](#payment-process)
- [Users](#users)
- [Error Handling and Testing](#error-handling)
- [Evaluation Criteria](#evaluation-criteria)
- [Submission](#submission)
- [Connect with Me](#connect-with-me-at)

Click in upper links to see how to implement each part or read installation guid.

## Getting Started

To quickly set up and run this task, I've utilized "laravel sail" for seamless execution. Follow these steps after cloning or unzipping the project:

1. Ensure Composer is installed on your system.

2. Launch the Laravel Sail containers and network by running the following command:

```shell
sail up -d 
```

### Warmin Up the Project

If you wish to start the project without manually setting up, use the following "quarkino" artisan command:
```shell
sail shell
php artisan quarkino
```
Alternatively, you can manually apply migrations and seed the database:

```
sail shell
php artisan migrate
php artisan db:seed
```
Upon executing the "quarkino" command, a user named quarkino with the password also set as quarkino will be generated.

Now you're all set to explore and interact with the project. Enjoy your experience with Laravel Sail!

## Inventory Management

The product are pre-defined in ProductSeeder class and when you run the seeder 100 different products are generated. Each of them has a random value between 0 and 100 which act as an initial inventory count.
## Purchase Request

Each user can request different products with one request. The uri is localhost/api/order/create and user cookie should be set from users table. Every user has a `remember_token` which should be place in request cookie with access_token name: for example:`access_token=BT9ZuSWWaJ`
In the request body you should place an array of product with order number. The API documentation will be added. If the order items are smaller than the current number of available product you will get error.

## Payment Process

After buying some product, the request should be sent. order_id and user cookie just like before. Check API document for more information.

## Users

Users are predefined and are created with auto seeder and UserFactory in database/factory directory.
With `php artisan quarkino` ten users with quarkino user added to users table by default. If you didn't run that you can handle it manually:

```bash
php artisan db:seed
```

These commands create 10 users randomly with different names also there is a user with name `quarkino` with pass `interview` you can use this user for checking other options in this project.

## Error handling

There are some validation exception like not enough products or user validation which return 422 and 401 response. Also there are order and payment request to make sure the user input is valid. 

## Evaluation Criteria

To run tests of this project use. You can check these tests in `tests/Feature` directory
```
php artisan test
```

Each test is responsible for testing a different part of a project.

| className           | description                                                     |
|---------------------|-----------------------------------------------------------------|
| UserTest            | for testing user creation and auth function                     |
| PaymentTest         | for testing payment process for users                           |
| ProductTest         | testing creation of different products                          |
| NumberOfProductTest | to check if the validation for number of products works correct |
| ExtraTest           | another test class for other options                            |

## Submission

This project should be done until `2023-8-15`

## Connect with me at

[![LinkedIn](https://img.shields.io/badge/danialjan-LinkedIn-%230e577f.svg?logo=linkedin&logoColor=)](https://linkedin.com/in/danialjan)
[![Gmail](https://img.shields.io/badge/danialzash-Gmail-%23EA4335.svg?logo=gmail&logoColor=white)](https://linkedin.com/in/danialjan)
[![Github](https://img.shields.io/badge/danialzash-Github-%23111111.svg?logo=Github)](https://instagram.com/danialzash)

<h3 style="color:lightgreen; font-family: 'monospace'"><a href="https://dzash.com" target="_blank"><img src="public/zash_logo.png" width="50" alt="Quarkino Logo"></a> dzash.com</h3>
