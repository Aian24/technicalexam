# Jr. Web Dev CRM Exam

A simple Client Management module built with Laravel 10 and PHP 8, submitted as part of the Junior Web Developer technical exam.

---

## Requirements

- PHP 8.1+
- Composer
- MySQL (or any DB supported by Laravel)
- Laravel 10

---

## Setup

1. **Clone the repo**
   ```bash
   git clone https://github.com/Aian24/technicalexam.git
   cd technicalexam
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Copy and configure .env**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Then open `.env` and set your database credentials:
   ```
   DB_DATABASE=crm_exam
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Run migrations**
   ```bash
   php artisan migrate
   ```

5. **Start the server**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

---

## Project Structure

```
app/
  Http/Controllers/
    ClientController.php      # handles all client CRUD + storeClientDetails
    DashboardController.php   # Part 1 Q2
  Models/
    Client.php
  Repositories/
    ClientRepository.php      # all DB operations go through here

routes/
  web.php                     # all routes including auth-protected ones

resources/views/
  layouts/app.blade.php
  clients/
    index.blade.php           # list + filter
    create.blade.php          # add form
    edit.blade.php            # edit form

answers/
  part1_answers.php           # written answers for Part 1

database/migrations/
  2024_01_01_000001_create_clients_table.php
```

---

## Part 1 Answers

### Q1 — Eloquent Query
```php
$users = User::where('status', 'active')
             ->orderBy('created_at', 'desc')
             ->get();
```

### Q2 — Dashboard Route
```php
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
```
Used `auth` middleware — it's Laravel's built-in guard that blocks unauthenticated users and redirects them to the login page.

### Q3 — storeClientDetails
Located in `ClientController@storeClientDetails`. It validates name, email, and status, then delegates saving to `ClientRepository::create()`, and returns:
```json
{
    "status": "success",
    "client": { "id": 1, "name": "...", "email": "...", "status": "active" }
}
```

---

## Part 2 — Client Module Features

- List all clients with filter by status (All / Active / Inactive)
- Add new client with validation
- Edit existing client (email uniqueness ignores self)
- Delete client with confirmation prompt
- Flash messages for success and error feedback
- Bootstrap 5 UI

---

## Bonus Features

- Status filter (Active / Inactive / All) via query string
- Bootstrap 5 for the UI
- Duplicate email validation with a clear error message on the form
- `storeClientDetails()` returns a proper JSON response (usable via Postman too)

---

## Assumptions

- Auth scaffolding (login/register) is assumed to be set up via `laravel/breeze` or equivalent — the routes just use `middleware('auth')`, so any standard auth setup works.
- No seeder was added since the exam doesn't require test data. You can add clients manually through the UI.
- Option B (Blade views) was chosen for Part 2.

---

## Notes

- The `answers/part1_answers.php` file contains documented code snippets for Part 1.
- The repository pattern is kept simple on purpose — one class, one responsibility.
