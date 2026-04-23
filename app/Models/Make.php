<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Make extends Model
{
    protected $fillable = ['name'];

    public function car_model(): HasMany
    {
        return $this->hasMany(CarModel::class);
    }
}
