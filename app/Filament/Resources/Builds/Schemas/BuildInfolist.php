<?php

namespace App\Filament\Resources\Builds\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BuildInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('car_year')
                    ->numeric(),
                TextEntry::make('diameter')
                    ->numeric(),
                TextEntry::make('width')
                    ->numeric(),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('carModel.name')
                    ->label('Car model'),
                TextEntry::make('wheel.name')
                    ->label('Wheel'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
