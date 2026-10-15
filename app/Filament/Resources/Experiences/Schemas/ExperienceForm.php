<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company')
                    ->required()
                    ->maxLength(255),

                TextInput::make('role')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g., Senior Developer'),

                TextInput::make('location')
                    ->maxLength(255)
                    ->placeholder('e.g., Manila, Philippines (or Remote)'),

                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull()
                    ->placeholder('Responsibilities, achievements, etc.'),

                DatePicker::make('start_date')
                    ->required()
                    ->native(false)
                    ->displayFormat('M Y'),

                DatePicker::make('end_date')
                    ->native(false)
                    ->displayFormat('M Y')
                    ->disabled(fn (callable $get) => $get('is_current'))
                    ->helperText('Iwanan blank kung current pa.'),

                Toggle::make('is_current')
                    ->label('Currently working here')
                    ->live()
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}