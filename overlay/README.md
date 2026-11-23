# Live Order Status Board - Roshan Microfinance

A real-time board for Roshan Microfinance staff to monitor loan application status.
Built with **Laravel** (backend), **MySQL**, and a lightweight front-end, deployed on free hosting.

> **Current stage: Task 1 - Database schema, migrations and seeders.**
> Task 2 (REST API) and Task 3 (live board front-end + deploy) build on this.

## Project plan

| # | Task                                   | Days |
|---|----------------------------------------|------|
| 1 | Create Database Schema and Migrations  | 2    |
| 2 | Implement REST API for Orders          | 2    |
| 3 | Build Live Board Front-end and Deploy  | 2    |

## `orders` table

| Column          | Type                        | Notes                                                        |
|-----------------|-----------------------------|--------------------------------------------------------------|
| `id`            | BIGINT UNSIGNED, PK, auto   | Order / application id                                       |
| `customer_name` | VARCHAR(255)                | Applicant name                                               |
| `amount`        | DECIMAL(12,2)               | Loan amount (decimal, not float, so money stays exact)       |
| `status`        | VARCHAR(30), indexed        | `pending`, `under_review`, `approved`, `disbursed`, `rejected` (default `pending`) |
| `created_at`    | TIMESTAMP, nullable         | Set by Laravel                                               |
| `updated_at`    | TIMESTAMP, nullable         | Set by Laravel                                               |

Files of interest:

- `database/migrations/2026_11_21_000000_create_orders_table.php` - creates the table
- `database/seeders/OrderSeeder.php` - inserts 5 sample orders (one per status)
- `database/seeders/DatabaseSeeder.php` - calls `OrderSeeder`
- `app/Models/Order.php` - Eloquent model with status constants

## Requirements

- PHP 8.2+ and Composer
- MySQL 8 (or MariaDB 10.4+), e.g. via XAMPP / Laragon
- phpMyAdmin or any MySQL client (to verify)
- Git

## Run it locally

```bash
# 1. Clone and install
git clone <your-repo-url> roshan-order-board
cd roshan-order-board
composer install

# 2. Environment
cp .env.example .env
php artisan key:generate
```

Open `.env` and point it at MySQL (see `.env.mysql.example`):

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=roshan_orders
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# 3. Create the (empty) database
mysql -u root -e "CREATE DATABASE roshan_orders CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
#    ...or create `roshan_orders` in phpMyAdmin.

# 4. Create the table and insert the sample data
php artisan migrate --seed
```

To rebuild from scratch at any time: `php artisan migrate:fresh --seed`

## Verify

In phpMyAdmin open `roshan_orders` > `orders`, or run:

```sql
DESCRIBE orders;
SELECT id, customer_name, amount, status FROM orders;
```

You should see the six columns above and 5 rows, one per status.
Or from Laravel: `php artisan tinker` then `App\Models\Order::count();` (returns `5`).

## Sample data

| customer_name | amount     | status       |
|---------------|-----------:|--------------|
| Ayesha Khan   |  50,000.00 | pending      |
| Bilal Ahmed   | 120,000.00 | under_review |
| Fatima Noor   |  75,000.50 | approved     |
| Usman Tariq   | 200,000.00 | disbursed    |
| Sana Malik    |  30,000.00 | rejected     |

## Next

- Task 2: REST endpoints to list, retrieve and update orders
- Task 3: polling live board front-end, deployment scripts and deploy README
