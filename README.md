# Movie Screening API

This is a Laravel-based API for managing movie screenings. It provides functionality for managing movies, screenings, and related data. The API is RESTful and supports the creation, updating, and deletion of movies and screenings.

## Requirements

- PHP 8.x or higher
- Composer

## Getting Started

Follow the steps below to get a local copy up and running.

### 1. Clone the Repository

Clone the repository to your local machine using Git:

```bash
git clone git@github.com:AttilaSzendi/sugar.git
cd sugar
```

### 2. Install composer packages
```bash
composer install
```
### 3. Set Up Environment Variables
```bash
cp .env.example .env
```
### 4. Configure the Database
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 5. Generate the Application Key
```bash
php artisan key:generate
```
### 6. Install and set up sail
```bash
php artisan sail:install
./vendor/bin/sail up
```

### 7. Run migrations and seed the database
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```
### 8. Documentation
```bash
http://127.0.0.1/docs
```
### 9. Run tests
```bash
./vendor/bin/sail artisan test
```
