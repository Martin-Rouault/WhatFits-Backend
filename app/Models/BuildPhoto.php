<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuildPhoto extends Model
{
    protected $fillable = ['photo_url', 'display_order'];

    public function build(): BelongsTo
    {
        return $this->belongsTo(Build::class);
    }
}
