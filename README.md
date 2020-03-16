# Laravel Socialite Passport Provider

## Introduction

Laravel Socialite Passport Provider extends interface [Laravel Socialite](https://github.com/laravel/socialite) to OAuth authentication with [Laravel Passport](https://github.com/laravel/passport).

## Official Documentation

Documentation for Socialite can be found on the [Laravel website](https://laravel.com/docs/socialite).

## Install

#### composer

```bash
composer require laravel/socialite vladmeh/socialite-passport
```

#### config/services.php
```bash
...
'passport' => [
    'api_url' => env('PASSPORT_API_URL'),
    'client_id' => env('PASSPORT_CLIENT_ID'),
    'client_secret' => env('PASSPORT_CLIENT_SECRET'),
    'redirect' => env('PASSPORT_REDIRECT'),
],
```

#### .env

```bash
...
PASSPORT_API_URL=http://url.api.service
PASSPORT_CLIENT_ID=passport_client_id
PASSPORT_CLIENT_SECRET=passport_client_secret
PASSPORT_REDIRECT=http://your-callback-url
```

#### terminal

```bash
php artisan cache:clear
php artisan config:clear
php artisan config:cache
```
