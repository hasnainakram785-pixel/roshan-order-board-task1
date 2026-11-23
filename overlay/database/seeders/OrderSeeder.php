<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Seed 5 sample loan applications, one for each status,
     * so the colour-coded board has something to show.
     */
    public function run(): void
    {
        $orders = [
            ['customer_name' => 'Ayesha Khan',   'amount' => 50000.00,  'status' => Order::STATUS_PENDING],
            ['customer_name' => 'Bilal Ahmed',   'amount' => 120000.00, 'status' => Order::STATUS_UNDER_REVIEW],
            ['customer_name' => 'Fatima Noor',   'amount' => 75000.50,  'status' => Order::STATUS_APPROVED],
            ['customer_name' => 'Usman Tariq',   'amount' => 200000.00, 'status' => Order::STATUS_DISBURSED],
            ['customer_name' => 'Sana Malik',    'amount' => 30000.00,  'status' => Order::STATUS_REJECTED],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
