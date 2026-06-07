<?php

namespace App\Filament\Resources\Wheels\Pages;

use App\Filament\Resources\Wheels\WheelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWheel extends EditRecord
{
    protected static string $resource = WheelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
