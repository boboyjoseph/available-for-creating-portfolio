<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) =>
                        $set('slug', Str::slug($state ?? ''))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Auto-generated from title. Pwede mong i-edit.'),

                Textarea::make('description')
                    ->rows(5)
                    ->columnSpanFull(),

                FileUpload::make('thumbnail')
                    ->image()
                    ->directory('project-thumbnails')
                    ->imageEditor()
                    ->maxSize(2048),

                TagsInput::make('tech_stack')
                    ->placeholder('Add tech (e.g., Laravel, Vue, Tailwind)')
                    ->columnSpanFull(),

                TextInput::make('live_url')
                    ->label('Live URL')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://example.com'),

                TextInput::make('repo_url')
                    ->label('Repository URL')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://github.com/user/repo'),

                Toggle::make('is_featured')
                    ->label('Featured project')
                    ->helperText('Lalabas ito sa taas ng portfolio.'),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Mas mababa = mas nauuna.'),
            ]);
    }
}