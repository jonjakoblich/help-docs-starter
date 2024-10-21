<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'published' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'published')),
            'draft' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'draft')),
            'private' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'private')),
        ];
    }
}
