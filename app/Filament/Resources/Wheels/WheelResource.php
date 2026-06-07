<?php

namespace App\Filament\Resources\Wheels;

use App\Filament\Resources\Wheels\Pages\CreateWheel;
use App\Filament\Resources\Wheels\Pages\EditWheel;
use App\Filament\Resources\Wheels\Pages\ListWheels;
use App\Filament\Resources\Wheels\Schemas\WheelForm;
use App\Filament\Resources\Wheels\Tables\WheelsTable;
use App\Models\Wheel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WheelResource extends Resource
{
    protected static ?string $model = Wheel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return WheelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WheelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWheels::route('/'),
            'create' => CreateWheel::route('/create'),
            'edit' => EditWheel::route('/{record}/edit'),
        ];
    }
}
