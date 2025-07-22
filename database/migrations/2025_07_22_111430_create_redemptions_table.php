<?php

use App\Models\User;
use App\Models\Reward;
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
        Schema::create('redemptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class, 'customer_id')->nullable()->constrained('customers')->cascadeOnDelete();
            $table->foreignIdFor(Reward::class, 'reward_id')->nullable()->index()->constrained('rewards')->onDelete('cascade');
            $table->foreignIdFor(User::class, 'staff_id')->nullable()->index()->nullable()->constrained('users')->nullOnDelete(); // staff who redeemed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redemptions');
    }
};
