<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Generation extends Model
{
    protected $fillable = ['name', 'year_start', 'year_end'];

    public function car_model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function builds(): HasMany
    {
        return $this->hasMany(Build::class);
    }
}
