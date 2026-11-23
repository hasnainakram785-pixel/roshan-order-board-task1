<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * One row = one loan application ("order") shown on the live status board.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();                                        // id (BIGINT UNSIGNED, auto-increment, PK)
            $table->string('customer_name');                     // applicant name
            $table->decimal('amount', 12, 2);                    // loan amount, exact decimal (never float for money)
            $table->string('status', 30)->default('pending')->index(); // pending | under_review | approved | disbursed | rejected
            $table->timestamps();                                // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
