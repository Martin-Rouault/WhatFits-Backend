<?php

namespace App\Filament\Resources\WheelBrands\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WheelBrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
