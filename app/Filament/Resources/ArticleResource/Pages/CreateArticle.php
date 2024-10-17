<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
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
                        TextInput::make('name'),
                        RichEditor::make('content'),
                        TextInput::make('slug'),
                    ])
                    ->columnSpan(3),

                Section::make('Publishing')
                    ->description('Settings for publishing this post.')
                    ->schema([
                        Select::make('status')
                            ->options(Article::getStatesFor('status')
                                    ->flatMap(fn(string $state) => 
                                    [Str::lower(class_basename($state)) => class_basename($state)])
                            )
                            ->default(Str::lower(class_basename(Article::getDefaultStateFor('status')))),
                        CheckboxList::make('categories')
                            ->options(Category::all())
                            ->searchable()
                            ->bulkToggleable()
                            ->relationship(titleAttribute: 'name'),
                    ])
                    ->columnSpan(1),
/*                     Section::make('Author')
                        ->schema([
                            Select::make('author')
                                ->options(User::select('id','name')->get()->flatMap(fn($user) => [$user->id => $user->name]))
                        ])
                        ->default(Auth::user()->id)
                        ->columnSpan(1) */

            ])
            ->columns(4);
    }
}
