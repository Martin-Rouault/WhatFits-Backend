<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BuildFilter
{
    public function __construct(protected Request $request) {}

    public function apply(Builder $query): Builder
    {
        return $query
            ->when(
                $this->request->filled('make_id'),
                fn($q) =>
                $q->whereHas('carModel', fn($q) => $q->where('make_id', $this->request->make_id))
            )
            ->when(
                $this->request->filled('car_model_id'),
                fn($q) =>
                $q->where('car_model_id', $this->request->car_model_id)
            )
            ->when(
                $this->request->filled('car_year'),
                fn($q) =>
                $q->where('car_year', $this->request->car_year)
            )
            ->when(
                $this->request->filled('wheel_id'),
                fn($q) =>
                $q->where('wheel_id', $this->request->wheel_id)
            )
            ->when(
                $this->request->filled('wheel_brand_id'),
                fn($q) =>
                $q->whereHas('wheel', fn($q) => $q->where('wheel_brand_id', $this->request->wheel_brand_id))
            )
            ->when(
                $this->request->filled('diameter'),
                fn($q) =>
                $q->where('diameter', $this->request->diameter)
            ); 
    }
}
