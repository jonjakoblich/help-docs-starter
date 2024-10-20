<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Published Articles', Article::where('status','published')->count()),
            Stat::make('Draft Articles', Article::where('status','draft')->count()),
        ];
    }
}
