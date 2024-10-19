<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
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

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable(),
                TextColumn::make('categories.name'),
                TextColumn::make('status')
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'archived' => 'blue',
                        'published' => 'success',
                        'private' => 'danger',
                    }),
                TextColumn::make('created_at')
                    ->sortable(),
            ])
            ->reorderable('order')
            ->defaultSort('created_at')
            ->searchable('name')
            ->persistSearchInSession();
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
