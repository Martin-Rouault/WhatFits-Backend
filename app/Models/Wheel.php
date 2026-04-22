<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wheel extends Model
{
    protected $fillable = ['name'];

    public function wheel_brand(): BelongsTo
    {
        return $this->belongsTo(WheelBrand::class);
    }
}
