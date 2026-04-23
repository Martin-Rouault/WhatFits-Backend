<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WheelBrand extends Model
{
    protected $fillable = ['name'];

    public function wheels(): HasMany
    {
        return $this->hasMany(Wheel::class);
    }
}
