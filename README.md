# ITI PHP Track

Coursework completed during the **PHP Track** at the **Information Technology Institute (ITI)**. The repository collects daily exercises across PHP fundamentals, Laravel, and a generative AI session.

## Structure

```text
.
├── php/
│   ├── Day1/          # PHP basics, forms, and table rendering
│   ├── Day2/          # Registration, login, and user CRUD
│   ├── Day3/          # PHP task set
│   └── Day4/          # Server-side includes and database connection
├── Laravel/
│   ├── Day1/          # Standalone Laravel application
│   ├── Day2/          # Standalone Laravel application
│   ├── Day3/          # Standalone Laravel application
│   └── Day4/          # Standalone Laravel application
├── Gen AI/
│   ├── Day 1/         # Generative AI session
│   └── Day 2/         # Laravel application from the Gen AI session
├── index.html         # Portfolio page
└── README.md
```

Each Laravel day is a separate application with its own `composer.json`, `artisan`, and `.env.example`.

## Running a Laravel exercise

```bash
cd "Laravel/Day4"
composer install
cp .env.example .env
php artisan key:generate
# Configure the database in .env, then:
php artisan migrate
php artisan serve
```

Open the URL printed by `php artisan serve` (usually `http://127.0.0.1:8000`).

For the Gen AI Laravel app, use the same steps from `Gen AI/Day 2`.

## Running the plain PHP exercises

Serve the relevant day from its directory with PHP's built-in server:

```bash
cd php/Day4
php -S 127.0.0.1:8000
```

Some exercises expect a MySQL database. Check the `connection.php` or configuration file in the relevant day and create the expected schema before running the page.

## Notes

- The exercises are independent; there is no single root application to start.
- Do not commit real database credentials. Use the provided `.env.example` files as templates.
