<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'cust_num',
        'full_name',
        'phone_number',
        'address',
        'qr_code',
        'points_balance',
    ];


    protected $casts = [
        'qr_code' => 'array',
        'points_balance' => 'integer',
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class, 'customer_id');
    }
}
