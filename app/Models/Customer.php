<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'phone_number',
        'address',
        'qr_code',
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
