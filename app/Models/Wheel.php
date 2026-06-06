<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wheel extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function wheel_brand(): BelongsTo
    {
        return $this->belongsTo(WheelBrand::class);
    }

    public function builds(): HasMany
    {
        return $this->hasMany(Build::class);
    }
}
