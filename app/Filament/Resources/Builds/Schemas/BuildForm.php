<?php

namespace App\Filament\Resources\Builds\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BuildForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('car_year')
                    ->required()
                    ->numeric(),
                TextInput::make('diameter')
                    ->required()
                    ->numeric(),
                TextInput::make('width')
                    ->required()
                    ->numeric(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('car_model_id')
                    ->relationship('carModel', 'name')
                    ->required(),
                Select::make('wheel_id')
                    ->relationship('wheel', 'name')
                    ->required(),
            ]);
    }
}
