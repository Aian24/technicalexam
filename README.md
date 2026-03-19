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

## Part 2 — Advanced Client Management

- **Modernized UI**: Built with a custom, premium aesthetic using Bootstrap 5 + custom glassmorphism.
- **Single Page Experience**: Using Modals for Create and Edit workflows for a smoother feel.
- **State-of-the-Art Notifications**: Integrated SweetAlert2 for toasts and delete confirmations.
- **Advanced Filtering**: Live status filtering and Search integration (bonus points).
- **Responsive Table**: Table scales for mobile and desktop views.

---

## Bonus Features (+10 Points)

1. **Integrated Search**: Filter clients by Name or Email directly.
2. **Status Filtering**: Easily switch between Active, Inactive, and All clients.
3. **Advanced UI**: Used modern typography (Outfit), icons (FontAwesome), and premium styling.
4. **SweetAlert2 Hooks**: Replaced standard browser alerts with professional, user-friendly modals.
5. **Duplicate Email Handling**: Robust validation with user-friendly error display (integrated with SweetAlert2).
6. **Dashboard Stats**: Real-time stats on the Dashboard page.


---

## Assumptions

- Auth scaffolding (login/register) is assumed to be set up via `laravel/breeze` or equivalent — the routes just use `middleware('auth')`, so any standard auth setup works.
- No seeder was added since the exam doesn't require test data. You can add clients manually through the UI.
- Option B (Blade views) was chosen for Part 2.

---

## Notes

- The `answers/part1_answers.php` file contains documented code snippets for Part 1.
- The repository pattern is kept simple on purpose — one class, one responsibility.
