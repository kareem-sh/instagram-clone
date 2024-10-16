Instagram Clone
This is an Instagram-like web application built using Laravel 11. The application allows users to create accounts, follow/unfollow users, upload photos, and interact through likes and comments. It also supports multi-language features, allowing users to switch between Arabic (RTL) and English (LTR) layouts.

Features
User Authentication (Sign Up, Log In, Password Reset)
User Profiles with Followers and Following counts
Photo Uploads with captions
Likes and Comments on posts
Follow/Unfollow functionality
Localization with language support (Arabic and English)
Dynamic theme switching based on locale (RTL for Arabic, LTR for English)
Technologies Used
Backend: Laravel 11 (PHP Framework)
Frontend: Blade templates, Tailwind CSS, Alpine.js
Database: MySQL (or any other relational database)
Storage: Laravel's default file storage for photo uploads
Localization: Laravel localization with middleware to handle locale switching
Authentication: Laravel Breeze/Jetstream (or customized authentication flow)
Installation
Prerequisites
Make sure you have the following installed on your machine:

PHP >= 8.1
Composer
Node.js & NPM
MySQL or other database (configured in .env)
Steps
Clone the repository:

bash
Copy code
git clone https://github.com/kareem-sh/instagram-clone.git
cd instagram-clone
Install dependencies:

bash
Copy code
composer install
npm install
npm run build
Environment configuration:

Copy the .env.example to .env and update your database credentials:

bash
Copy code
cp .env.example .env
Update the following in .env:

makefile
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
Generate an application key:

bash
Copy code
php artisan key:generate
Run migrations:

Run the database migrations to create the necessary tables:

bash
Copy code
php artisan migrate
Seed the database (optional):

You can add fake data by seeding the database for testing purposes:

bash
Copy code
php artisan db:seed
Run the application:

bash
Copy code
php artisan serve
The application will be available at http://localhost:8000.

Usage
Sign Up/Login: Create a new account or log in with existing credentials.
Upload Photos: Upload a new photo, which will appear in your profile feed.
Follow/Unfollow: Navigate to other user profiles and follow/unfollow them.
Comments and Likes: Interact with posts by leaving comments or liking photos.
Switch Language: Toggle between Arabic and English by changing the language setting in your profile.
Localization
The application supports Arabic (RTL) and English (LTR). The language can be changed dynamically based on the user's preference stored in the database.

Arabic: If the user's language is set to Arabic, the layout will switch to RTL.
English: The default fallback language is English, with LTR layout.
Middleware handles the locale switching, and it's stored in the session or user preferences.

Customization
Changing the default language
The default language can be configured in the .env file:

env
Copy code
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
You can also change the fallback language for untranslated strings by setting APP_FALLBACK_LOCALE.

Add a new language
To add a new language, create a language folder inside resources/lang/ (e.g., fr for French). Then, add translation files like auth.php, pagination.php, etc., within that folder.

Contributing
Contributions are welcome! Feel free to open a pull request or submit issues if you find any bugs or have feature suggestions.

License
This project is open-source and available under the MIT license.