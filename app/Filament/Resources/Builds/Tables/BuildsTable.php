<?php

namespace App\Filament\Resources\Builds\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BuildsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('car_year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('diameter')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('width')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('carModel.name')
                    ->searchable(),
                TextColumn::make('wheel.name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
