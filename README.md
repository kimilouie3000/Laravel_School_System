# Laravel School System

A Laravel 11 school portal based on the supplied Lab guide. It includes student records, courses, course enrollment, learning activities, and student submissions. The interface is responsive and uses a clean navy-and-blue design.

## Requirements
- PHP 8.2 or newer with common Laravel extensions enabled
- Composer
- MySQL / MariaDB (XAMPP is fine)
- VS Code (recommended)

## Simple setup on Windows / XAMPP
1. Extract this ZIP to `C:\xampp\htdocs\Laravel_School_System`.
2. Start **MySQL** in the XAMPP Control Panel. Apache is not required when using `php artisan serve`.
3. Open the project folder in VS Code. Choose **Terminal → New Terminal**.
4. Confirm the terminal is in the project folder, then run `composer install`. This downloads the Laravel dependencies into `vendor`. If Composer reports that it cannot resolve `repo.packagist.org`, fix the internet/DNS connection and retry; do not run Artisan commands until `vendor/autoload.php` exists.
5. Create a database in phpMyAdmin: open `http://localhost/phpmyadmin`, choose **New**, enter `school_system`, then click **Create**. Leave the database empty.
6. Copy the environment file in PowerShell:
   ```powershell
   Copy-Item .env.example .env
   ```
   If `.env` already exists, keep it and edit it instead of overwriting it.
7. Open `.env` and confirm these values match your local MySQL setup:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=school_system
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   If you set a MySQL root password, enter it after `DB_PASSWORD=`.
8. Generate the app key:
   ```powershell
   php artisan key:generate
   ```
9. Create the tables:
   ```powershell
   php artisan migrate
   ```
10. Optional: add example courses, one example student, enrollment records, and an example activity:
    ```powershell
    php artisan db:seed
    ```
11. Start Laravel:
    ```powershell
    php artisan serve
    ```
12. Open `http://127.0.0.1:8000` in your browser.

## Features
- Student: register, list, view, edit, delete, and enroll/unenroll in courses.
- Course: create, list, view, edit, and delete courses.
- Activities: create and list course activities, view instructions, and record submissions from enrolled students.
- Validation for required fields, unique student numbers/emails/course codes, valid relationships, and duplicate enrollment/submission prevention.
- Database foreign keys with cascading cleanup for related records.

## Common fixes
- **`vendor/autoload.php` missing:** run `composer install` successfully first.
- **Composer `curl error 6` / cannot resolve host:** check your internet connection and DNS. Try `nslookup repo.packagist.org`; retry Composer only after the host resolves.
- **Database connection refused:** make sure MySQL is running in XAMPP and `.env` has the correct host/port/user/password.
- **Unknown database `school_system`:** create the database in phpMyAdmin before running migrations.
- **Migration tables already exist from an old version:** only if this is a fresh practice database with no data you need, run `php artisan migrate:fresh --seed` to drop and rebuild tables. This deletes all existing database data.

## Main project structure
- `app/Models`: Student, Course, Activity, Submission and their relationships.
- `app/Http/Controllers`: validation and application logic.
- `database/migrations`: schema for students, courses, enrollments, activities, and submissions.
- `database/seeders/DatabaseSeeder.php`: optional sample data.
- `resources/views`: Blade pages and shared responsive layout.
- `routes/web.php`: browser routes.
