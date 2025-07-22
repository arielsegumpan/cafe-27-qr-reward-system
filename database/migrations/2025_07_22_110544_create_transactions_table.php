<?php

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class, 'customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'cashier_id')->nullable()->constrained('users')->nullOnDelete(); // cashier
            $table->decimal('total_amount', 8, 2);
            $table->integer('points_earned');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
