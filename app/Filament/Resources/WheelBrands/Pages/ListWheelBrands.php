<?php

namespace App\Filament\Resources\WheelBrands\Pages;

use App\Filament\Resources\WheelBrands\WheelBrandResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWheelBrands extends ListRecords
{
    protected static string $resource = WheelBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
