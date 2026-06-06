<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuildPhoto extends Model
{
    use HasFactory;
    protected $fillable = ['photo_url', 'display_order'];

    public function build(): BelongsTo
    {
        return $this->belongsTo(Build::class);
    }
}
