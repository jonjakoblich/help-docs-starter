<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\{Form, Set};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->live(onBlur: true)
                            ->required(),
                        Forms\Components\RichEditor::make('content')
                        ->required(),
                        Forms\Components\TextInput::make('slug')
                            ->extraInputAttributes([
                                'tabindex' => -1
                            ])
                            ->required(),
                    ])
                    ->columnSpan(3),

                Forms\Components\Section::make('Publishing')
                    ->description('Settings for publishing this post.')
                    ->schema([
                        Forms\Components\Toggle::make('featured'),
                        Forms\Components\Select::make('status')
                            ->options(Article::getStatesFor('status')
                                    ->flatMap(fn(string $state) => 
                                    [Str::lower(class_basename($state)) => Str::ucfirst(class_basename($state))])
                            )
                            ->default(Str::lower(class_basename(Article::getDefaultStateFor('status')))),
                        Forms\Components\Select::make('author_id')
                            ->relationship(name: 'author', titleAttribute: 'name')
                            ->default(Auth::user()->id),
                        Forms\Components\CheckboxList::make('categories')
                            ->options(Category::all())
                            ->searchable()
                            ->bulkToggleable()
                            ->relationship(titleAttribute: 'name'),
                    ])
                    ->columnSpan(1),
                ])
                ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('categories.name'),
                Tables\Columns\ToggleColumn::make('featured'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'archived' => 'blue',
                        'published' => 'success',
                        'private' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state) => Str::upper($state)),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->reorderable('order')
            ->defaultSort('name')
            ->persistSearchInSession()
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
