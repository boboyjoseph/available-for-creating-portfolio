<?php

namespace App\Filament\Resources\Skills\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SkillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('icon')
                    ->label('')
                    ->size('lg'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'backend' => 'success',
                        'frontend' => 'info',
                        'mobile' => 'warning',
                        'database' => 'danger',
                        'devops' => 'gray',
                        'design' => 'purple',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('proficiency')
                    ->suffix('%')
                    ->numeric()
                    ->sortable()
                    ->color(fn ($state) => $state >= 80 ? 'success' : ($state >= 50 ? 'warning' : 'danger')),

                TextColumn::make('created_at')
                    ->dateTime('M d, Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}