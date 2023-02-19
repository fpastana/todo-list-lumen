# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

# About the App

This app creates a todo-list API using RESTful.

## Technology Stack

- [Lumen v8.x](https://lumen.laravel.com): This is a PHP Micro Framework.
- [MYSQL](https://www.mysql.com/): MySQL a Relational Database

# System Requirements

-   PHP v7.3 
-   Composer
-   Any Laravel supported database
-   As the current version is built on Laravel Lumen v8.x, all requirements of this version of Lumen MUST be met [as stated here](https://lumen.laravel.com/docs/8.x#server-requirements).

# Setting up the Dev Environment

-   Inside the application folder, copy the `.env.example` file to `.env`

```
cp .env.example .env
```

-   Open the `.env` file and set your local environment variables such as `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

-   Install the composer packages:

```
# composer install
```

- Run the migration and seed commands

```
# php artisan migrate
``` 

***For tutorials on how to build Open Source Apps, please go to [felipepastana.com](https://felipepastana.com)***


