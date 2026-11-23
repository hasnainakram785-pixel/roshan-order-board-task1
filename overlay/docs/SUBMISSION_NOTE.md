# Task 1 - Submission note

**What I did**
- Created a new Laravel project and configured it for MySQL.
- Wrote a migration that creates the `orders` table with `id`, `customer_name`, `amount`, `status`, `created_at`, `updated_at`.
- Added an `Order` model and an `OrderSeeder` that inserts 5 sample loan applications (one per status), called from `DatabaseSeeder`.
- Ran `php artisan migrate --seed` and checked the table and rows in phpMyAdmin.
- Documented setup and verification steps in the README.

**Why**
- `amount` is `DECIMAL(12,2)`, not float, because money must not suffer rounding errors.
- `status` is a short indexed string with a default of `pending`: the board will filter and colour by status, and a string is easier to extend later than a MySQL ENUM. The allowed values live in `Order::STATUSES` so the API can validate against them in Task 2.
- One sample order per status means the colour-coded board in Task 3 can be tested immediately.
