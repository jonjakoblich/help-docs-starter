<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable(),
                TextColumn::make('articles_count')
                    ->counts('articles')
                    ->label('Articles'),
                TextColumn::make('parent.name'),
            ])
            ->searchable('name')
            ->persistSearchInSession();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
