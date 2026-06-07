<?php

namespace App\Filament\Resources\Wheels\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WheelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('wheel_brand_id')
                    ->relationship('wheel_brand', 'name')
                    ->required(),
            ]);
    }
}
