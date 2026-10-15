<?php

namespace App\Filament\Widgets;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortfolioStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Projects', Project::count())
                ->description('Total projects')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('primary'),

            Stat::make('Skills', Skill::count())
                ->description('Skills listed')
                ->descriptionIcon('heroicon-m-bolt')
                ->color('success'),

            Stat::make('Experiences', Experience::count())
                ->description('Work history')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('warning'),

            Stat::make('Users', User::count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}