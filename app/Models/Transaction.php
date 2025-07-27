<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'customer_id',
        'cashier_id',
        'total_amount',
        'points_earned',
    ];

    protected $casts = [
        'total_amount' => 'decimal:8,2',
        'points_earned' => 'integer',
    ];

    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function cashier() : BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    
}
