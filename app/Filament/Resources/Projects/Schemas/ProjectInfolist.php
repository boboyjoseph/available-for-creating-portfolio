<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Project details')
                    ->tabs([
                        Tab::make('📌 Overview')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                ImageEntry::make('thumbnail')
                                    ->hiddenLabel()
                                    ->height(300),

                                TextEntry::make('title')
                                    ->size('2xl')
                                    ->weight('bold'),

                                TextEntry::make('description')
                                    ->prose()
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('⚙️ Tech Stack')
                            ->icon('heroicon-o-code-bracket')
                            ->schema([
                                TextEntry::make('tech_stack')
                                    ->hiddenLabel()
                                    ->badge()
                                    ->separator(',')
                                    ->size('lg')
                                    ->color('primary'),
                            ]),

                        Tab::make('🔗 Links')
                            ->icon('heroicon-o-link')
                            ->schema([
                                TextEntry::make('live_url')
                                    ->url(fn ($state) => $state, true)
                                    ->icon('heroicon-o-arrow-top-right-on-square'),

                                TextEntry::make('repo_url')
                                    ->url(fn ($state) => $state, true)
                                    ->icon('heroicon-o-code-bracket-square'),
                            ]),

                        Tab::make('📊 Meta')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                IconEntry::make('is_featured')->boolean(),
                                TextEntry::make('sort_order')->badge(),
                                TextEntry::make('created_at')->since(),
                            ]),
                    ])
                    ->persistTabInQueryString(),
            ]);
    }
}