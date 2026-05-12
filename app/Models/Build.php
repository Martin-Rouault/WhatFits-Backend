<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Build extends Model
{
    protected $fillable = ['diameter', 'width'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wheel(): BelongsTo
    {
        return $this->belongsTo(Wheel::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(BuildPhoto::class);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
