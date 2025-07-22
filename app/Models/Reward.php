<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reward extends Model
{
    protected $fillable = [
        'reward_name',
        'reward_desc',
        'reward_points_required',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'reward_points_required' => 'integer'
    ];


    public function redemptions() : HasMany
    {
        return $this->hasMany(Redemption::class);
    }
}
