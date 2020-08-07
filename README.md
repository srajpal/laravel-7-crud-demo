<h1 align="center">Laravel 7.x Demo Project</h1>
<h3>Created by: Sunny Rajpal</h3>

## About Project

This project utilizes Laravel (https://www.laravel.com) to build and run demo CRUD application with secure login.<br><br>
The project allows you to create/show/update/delete companies. It also allows you to create/show/update/delete the employees in a company. 
The company is owned by the logged in user and the employees belong to the company they are created in. If a User is deleted all its Companies and relevant Employees will be deleted.


- Uses [Routing](https://laravel.com/docs/7.x/routing) to direct traffic to appropriate pages.
- Uses [Middleware](https://laravel.com/docs/7.x/middleware) to secure access to routes.
- Uses [Authentication](https://laravel.com/docs/7.x/authentication) to securely login as a registered user.
- Uses [CSRF](https://laravel.com/docs/7.x/csrf) Protection for forms.
- Uses [Controllers](https://laravel.com/docs/7.x/controllers) to handle behavior and logic.
- Uses [Blade](https://laravel.com/docs/7.x/blade) templates for its [Views](https://laravel.com/docs/7.x/views).
- Uses [Sessions](https://laravel.com/docs/7.x/session) to pass/persist data between views.
- Uses [Validation](https://laravel.com/docs/7.x/validation) via [Requests](https://laravel.com/docs/7.x/requests) to check form input.
- Uses [File Storage](https://laravel.com/docs/7.x/filesystem) for uploaded images.
- Uses [Eloquent ORM](https://laravel.com/docs/7.x/eloquent) to create [Relationships](https://laravel.com/docs/7.x/eloquent-relationships) between User, Company and Employee.
- Uses [Accessors & Mutators](https://laravel.com/docs/7.x/eloquent-mutators) to preprocess data before displaying or saving.
- Uses [Migrations](https://laravel.com/docs/7.x/migrations) to create database tables.
- Uses [Seeding](https://laravel.com/docs/7.x/seeding) to create default data in tables.
- Uses [Bootstrap](https://getbootstrap.com/) for the UI via [Frontend Scaffolding](https://laravel.com/docs/7.x/frontend).
- Uses [Policy](https://laravel.com/docs/7.x/authorization#creating-policies) to authorize user actions.
- Uses [Mailables](https://laravel.com/docs/7.x/mail) with [Queues](https://laravel.com/docs/7.x/queues) to send out email notifications on new company creation.

## Requirements

- Laravel 7.x
- PHP 7.2+
- MariaDB 10+

## View Demo

http://projects.srajpal.com/laravel-7-crud-demo/

email: admin@admin.com<br>
password: password<br>
email: admin2@admin.com<br>
password: password<br>

## Other Features

- Uses [DataTables](https://www.datatables.net/) to show/paginate data.
- Uses [Lightbox](https://www.lokeshdhakar.com/projects/lightbox2/) to show full size images.
- Implements [Localization](https://laravel.com/docs/7.x/localization) on the welcome page.
- Implements [CSRF](https://laravel.com/docs/7.x/csrf#csrf-introduction) for Form submission and AJAX calls
- Delete logo image from disk when Company deleted
- Uses [mailgun](https://mailgun.com/) to send out email notifications to site owner.
 
## Install instructions

- [Install Laravel](https://laravel.com/docs/7.x/installation)
- Clone project
- The project includes an .env.example file to help in setup
- [set up a database to store data](https://laravel.com/docs/7.x/database)
- run "composer install"
- run "npm install && npm run dev"
- run "php artisan migrate"
- run "php artisan db:seed"
- run "php artisan storage:link"
- run "php artisan serve"

The project creates two default users with the following credentials:<br>

email: admin@admin.com<br>
password: password<br>
email: admin2@admin.com<br>
password: password<br>

### Notes

How to set up [lightbox](https://www.lokeshdhakar.com/projects/lightbox2/) in Laravel.<br>

- Install via npm: "npm install lightbox2 --save"
- Add "require('lightbox2');" to /resources/js/bootstrap.js
- Add "@import '~lightbox2/dist/css/lightbox.min.css';" to /resources/sass/app.scss
- run "npm run dev"

How to set up [mailgun](https://www.mailgun.com/)

- signup for a free account at [https://www.mailgun.com/](https://www.mailgun.com/)
- verify your account
- copy your sandbox domain from mailgun and update the MAILGUN_DOMAIN variable in the .env file
- copy your private api key from mailgun and update the MAILGUN_SECRET variable in the .env file
- update the MAIL_SITE_OWNER_TO variable in the .env file to your own email address

### Acknowledgements

- Idea for the project came from [laraveldaily.com](https://laraveldaily.com/test-junior-laravel-developer-sample-project/)
- Special thanks to Edwin Diaz and his excellent [Laravel course on Udemy.com](https://www.udemy.com/course/php-with-laravel-for-beginners-become-a-master-in-laravel/)

