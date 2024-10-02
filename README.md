
### README.md

```markdown
# Laravel Vue Inertia Project

## Overview

This project is a Laravel application using Vue.js and Inertia.js with user authentication.

## Requirements

- PHP >= 8.0
- Composer
- Node.js >= 14
- NPM

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/EngrJEHernandez/laravuestrap-code-test.git
   ```

2. **Navigate to the project directory:**
   ```bash
   cd laravuestrap-code-test
   ```

3. **Create the database:**
   Make sure to create a database named `laravuedb` in your MySQL server:
   ```sql
   CREATE DATABASE laravuedb;
   ```

4. **Install PHP dependencies:**
   ```bash
   composer install
   ```

5. **Set up your environment file:**
   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
   Then, update your `.env` file with your database credentials and any other necessary environment variables. Ensure the `DB_DATABASE` field is set to `laravuedb`.

6. **Generate the application key:**
   ```bash
   php artisan key:generate
   ```

7. **Run the database migrations:**
   ```bash
   php artisan migrate
   ```

8. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```

9. **Compile your assets:**
   ```bash
   npm run dev
   ```

## Running the Application

1. **Start the Laravel development server:**
   ```bash
   php artisan serve
   ```
   By default, this will run your application at `http://localhost:8000`.

2. **Fetch posts from the API:**
   To manually fetch posts from the JSONPlaceholder API and store them in the database, run the following command:
   ```bash
   php artisan fetch:posts
   ```

## Scheduling the Command

To schedule the `fetch:posts` command, you have two options:

1. **Add the following line to your server's crontab:**
   ```bash
   * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
   ```

2. **Alternatively, run the command manually:**
   ```bash
   php artisan schedule:run
   ```

For testing purposes, you can schedule the command in your `AppServiceProvider.php` file:

```php
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Support\Providers\AppServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(Schedule $schedule)
    {
        // Schedule the command to run every hour
        $schedule->command('fetch:posts')->hourly();
        //$schedule->command('fetch:posts')->everyMinute(); // Uncomment for testing
    }
}
```

3. **Check and Fix Code Formatting:**
   To check and fix code formatting issues in your project, use Laravel Pint by running:
   ```bash
   vendor/bin/pint
   ```

## Unit Testing with Pest

Pest is a testing framework for PHP that offers a clean and expressive API. Here’s how to run your tests using Pest:

1. **Running Tests:**
   To run your tests with Pest, execute the following command:
   ```bash
   ./vendor/bin/pest
   ```

2. **Test Results**:
   After running the tests, you should see output similar to this:
   ```
   PASS  Tests\Unit\ExampleTest
   ✓ that true is true

   PASS  Tests\Feature\Auth\AuthenticationTest
   ✓ login screen can be rendered                                                                                                                                          2.56s  
   ✓ users can authenticate using the login screen                                                                                                                         0.43s  
   ✓ users can not authenticate with invalid password                                                                                                                      0.60s  
   ✓ users can logout                                                                                                                                                      0.38s  

   PASS  Tests\Feature\Auth\EmailVerificationTest
   ✓ email verification screen can be rendered                                                                                                                             0.33s  
   ✓ email can be verified                                                                                                                                                 0.48s  
   ✓ email is not verified with invalid hash                                                                                                                               0.43s  

   PASS  Tests\Feature\Auth\PasswordConfirmationTest
   ✓ confirm password screen can be rendered                                                                                                                               0.33s  
   ✓ password can be confirmed                                                                                                                                             0.40s  
   ✓ password is not confirmed with invalid password                                                                                                                       0.58s  

   PASS  Tests\Feature\Auth\PasswordResetTest
   ✓ reset password link screen can be rendered                                                                                                                            0.25s  
   ✓ reset password link can be requested                                                                                                                                  0.61s  
   ✓ reset password screen can be rendered                                                                                                                                 0.61s  
   ✓ password can be reset with valid token                                                                                                                                0.90s  

   PASS  Tests\Feature\Auth\PasswordUpdateTest
   ✓ password can be updated                                                                                                                                               0.48s  
   ✓ correct password must be provided to update password                                                                                                                  0.32s  

   PASS  Tests\Feature\Auth\RegistrationTest
   ✓ registration screen can be rendered                                                                                                                                   0.25s  
   ✓ new users can register                                                                                                                                                0.39s  

   PASS  Tests\Feature\ExampleTest
   ✓ it returns a successful response                                                                                                                                      0.26s  

   PASS  Tests\Feature\ProfileTest
   ✓ profile page is displayed                                                                                                                                             0.33s  
   ✓ profile information can be updated                                                                                                                                    0.54s  
   ✓ email verification status is unchanged when the email address is unchanged                                                                                            0.52s  
   ✓ user can delete their account                                                                                                                                         0.45s  
   ✓ correct password must be provided to delete account                                                                                                                   0.40s  

   Tests:    25 passed (61 assertions)
   Duration: 12.93s
   ```

## Accessing the Application

- Visit `http://localhost:8000` in your browser to access the application.
- Use the following routes:
  - **Welcome Page:** `/`
  - **Login:** `/login`
  - **Register:** `/register`
  - **Dashboard:** `/dashboard`

## Thank You
data