# GameSwap Marketplace

GameSwap is a PHP and MySQL course project that demonstrates an MVC application with product management, a session-based shopping cart, and database-backed checkout.

## Requirements

- PHP 7.4 or later (PHP 8.x recommended) with PDO MySQL enabled
- MySQL or MariaDB
- Apache (XAMPP is recommended on Windows)

## Quick setup with XAMPP

1. Copy the `GameSwap` folder into `C:\\xampp\\htdocs\\`.
2. Start Apache and MySQL in the XAMPP Control Panel.
3. Open phpMyAdmin at `http://localhost/phpmyadmin`.
4. Import `database/gameswap.sql`.
5. If your MySQL username or password is different, edit `app/config/settings.php`.
6. Open `http://localhost/GameSwap/public/`.

## Main routes

- Store: `index.php`
- Cart: `index.php?route=cart`
- Checkout: `index.php?route=checkout`
- Product administration: `index.php?route=admin`

## MVC structure

- `app/models`: database access and business data
- `app/views`: HTML templates
- `app/controllers`: request handling and workflow logic
- `public`: front controller and public assets
- `database`: database creation and sample data
- `docs`: project documentation
- `tests`: lightweight automated checks

## Running tests

From the project root, run:

```bash
php tests/run_tests.php
```

The tests validate cart calculations and quantity handling without changing the database.


## Final submission fixes

- Replaced constructor property promotion in all six affected classes with explicitly declared private properties and ordinary constructor parameters.
- Corrected the database configuration include to settings.php.
- Replaced the PHP 8.1-only never return type and PHP 8-only catch syntax for PHP 7.4 compatibility.
- Gave each checkout stock-update placeholder a distinct name for native PDO prepared statements.
