<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Simple Bank

## Description

A simple bank repository

Note: Every multiple of ID 5 makes the transaction fail

### Includes

-   User (see migrations & seeders)
-   Manual hit api (see manual folder)
-   Authentication (pass: password)
-   -   aliefsatu@gmail.com
-   -   aliefdua@gmail.com
-   History GUI ('/dashboard')
-   Deposit GUI ('/deposit')
-   Withdraw GUI ('/withdraw')

### Instalation

-   `npm install`
-   `composer install`
-   Setup your `.env`, kindly duplicate your `.env.example` file and rename the duplicated file to `.env`
-   Setup Database
-   `php artisan key:generate`
-   `php artisan migrate`
-   `php artisan db:seed`
-   To run application `php artisan serve`
