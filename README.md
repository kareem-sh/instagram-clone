# Instagram Clone

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This project is an Instagram clone built using Laravel 11. It replicates key features of Instagram such as user authentication, photo uploads, commenting, and following functionality. Additionally, the application supports multi-language features, including Arabic (RTL) and English (LTR) layouts.

### Features

- User registration and authentication
- Photo uploads with captions
- User profiles with followers/following counts
- Comment and like system for posts
- Follows/Unfollows between users
- RTL/LTR language support (Arabic and English)
- Locale switching middleware based on user preferences stored in the database

## Installation

### Prerequisites

Ensure you have the following installed:
- PHP >= 8.1
- Composer
- MySQL
- Node.js & npm

### Steps

1. **Clone the repository**:

   ```bash
   git clone https://github.com/kareem-sh/instagram-clone.git
   cd instagram-clone

2.Install dependencies:

composer install
npm install
npm run build

3.Set up the following in your .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

4.Run migrations:
php artisan migrate

5.Start the development server:

php artisan serve

Learning Laravel
Laravel has extensive documentation and video tutorials that make it easy to get started. Additionally, the Laravel Bootcamp guides you through building a modern Laravel application from scratch.


Contributing
Thank you for considering contributing to this Instagram clone! Contributions are welcome through pull requests or by raising issues on GitHub.