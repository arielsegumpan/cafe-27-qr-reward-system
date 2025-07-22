<?php

namespace App\Models;

use App\Models\Reward;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Redemption extends Model
{
    protected $fillable = [
        'customer_id',
        'reward_id',
        'staff_id',
    ];

    public function reward() : BelongsTo
    {
        return $this->belongsTo(Reward::class, 'reward_id');
    }

    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function staff() : BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
