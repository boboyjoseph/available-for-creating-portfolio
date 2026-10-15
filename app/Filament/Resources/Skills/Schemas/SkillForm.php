<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g., Laravel, React, Photoshop'),

                Select::make('category')
                    ->options([
                        'backend' => 'Backend',
                        'frontend' => 'Frontend',
                        'mobile' => 'Mobile',
                        'database' => 'Database',
                        'devops' => 'DevOps',
                        'design' => 'Design',
                        'tools' => 'Tools',
                        'other' => 'Other',
                    ])
                    ->default('other')
                    ->required(),

                TextInput::make('proficiency')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(100)
                    ->default(50)
                    ->suffix('%')
                    ->required(),

                TextInput::make('icon')
                    ->maxLength(255)
                    ->placeholder('e.g., 🚀 or heroicon-o-code-bracket')
                    ->helperText('Emoji or icon class'),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Mas mababa = mas nauuna'),
            ]);
    }
}