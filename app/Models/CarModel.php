<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function make(): BelongsTo
    {
        return $this->belongsTo(Make::class);
    }

    public function builds(): HasMany
    {
        return $this->hasMany(Build::class);
    }
}
