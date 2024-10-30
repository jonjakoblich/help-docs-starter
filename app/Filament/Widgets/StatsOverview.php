<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\HelpfulVote;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Published Articles', Article::query()->where('status','published')->count()),
            Stat::make('Draft Articles', Article::query()->where('status','draft')->count()),
            Stat::make('Overall Helpfulness', $this->calculateHelpfulnessScore().'%')
                ->description('found the articles helpful'),
        ];
    }

    private function calculateHelpfulnessScore(): int
    {
        $allVotes = HelpfulVote::all();
        
        $totalVotes = $allVotes->count();
        
        $helpfulVotes = $allVotes->where('vote', true)->count();

        if($totalVotes == 0)
            return 0;

        return $helpfulVotes/$totalVotes*100;
    }
}
