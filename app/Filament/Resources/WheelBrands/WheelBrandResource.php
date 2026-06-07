<?php

namespace App\Filament\Resources\WheelBrands;

use App\Filament\Resources\WheelBrands\Pages\CreateWheelBrand;
use App\Filament\Resources\WheelBrands\Pages\EditWheelBrand;
use App\Filament\Resources\WheelBrands\Pages\ListWheelBrands;
use App\Filament\Resources\WheelBrands\Schemas\WheelBrandForm;
use App\Filament\Resources\WheelBrands\Tables\WheelBrandsTable;
use App\Models\WheelBrand;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WheelBrandResource extends Resource
{
    protected static ?string $model = WheelBrand::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return WheelBrandForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WheelBrandsTable::configure($table);
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
            'index' => ListWheelBrands::route('/'),
            'create' => CreateWheelBrand::route('/create'),
            'edit' => EditWheelBrand::route('/{record}/edit'),
        ];
    }
}
