<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Forms\Components\{Select, TextInput};
use Filament\Forms\{Form, Get, Set};
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->columnSpanFull()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->live(onBlur: true),
                TextInput::make('slug')
                    ->columnSpanFull()
                    ->extraInputAttributes([
                        'tabindex' => -1
                    ]),
                Select::make('parent')
                    ->relationship(titleAttribute: 'name')
                    ->columnSpanFull(),
            ]);
    }
}
