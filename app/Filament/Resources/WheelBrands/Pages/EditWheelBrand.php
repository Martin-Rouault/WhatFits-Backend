<?php

namespace App\Filament\Resources\WheelBrands\Pages;

use App\Filament\Resources\WheelBrands\WheelBrandResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWheelBrand extends EditRecord
{
    protected static string $resource = WheelBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
