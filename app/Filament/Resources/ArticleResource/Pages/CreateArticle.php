<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->live(onBlur: true)
                            ->required(),
                        RichEditor::make('content')
                        ->required(),
                        TextInput::make('slug')
                            ->extraInputAttributes([
                                'tabindex' => -1
                            ])
                            ->required(),
                    ])
                    ->columnSpan(3),

                Section::make('Publishing')
                    ->description('Settings for publishing this post.')
                    ->schema([
                        Select::make('status')
                            ->options(Article::getStatesFor('status')
                                    ->flatMap(fn(string $state) => 
                                    [Str::lower(class_basename($state)) => Str::ucfirst(class_basename($state))])
                            )
                            ->default(Str::lower(class_basename(Article::getDefaultStateFor('status')))),
                        Select::make('author_id')
                            ->relationship(name: 'author', titleAttribute: 'name')
                            ->default(Auth::user()->id),
                        CheckboxList::make('categories')
                            ->options(Category::all())
                            ->searchable()
                            ->bulkToggleable()
                            ->relationship(titleAttribute: 'name'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(4);
    }
}
