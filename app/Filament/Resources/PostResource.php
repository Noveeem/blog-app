<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Infolists\Components\ImageEntry;
use PhpParser\Node\Stmt\Label;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content Management';

    protected static array $statuses = [
        'draft' => 'Draft',
        'unpublished' => 'Unpublished',
        'published' => 'Published',
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Blog')
                            ->description('Fill out the required information')
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->disabled(fn (string $operation): bool => $operation === 'edit')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                                    Forms\Components\TextInput::make('slug')
                                        ->disabled()
                                        ->dehydrated()
                                        ->required()
                                        ->unique(Post::class, 'slug', ignoreRecord: true),
                                    ]),
                                    Forms\Components\RichEditor::make('content')
                                        ->disabled(fn (string $operation): bool => $operation === 'edit')
                                        ->required()
                                        ->columnSpan('full'),
                                    SpatieTagsInput::make('tags')
                                        ->disabled(fn (string $operation): bool => $operation === 'edit'),
                                ]),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\FileUpload::make('thumbnail')
                                    ->disabled(fn (string $operation): bool => $operation === 'edit')
                                    ->image()
                                    ->imageEditor()
                            ]),
                    ])->columnSpan(3),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Publish Date')
                                    ->required()
                                    ->disabled(fn (string $operation): bool => $operation === 'edit')
                                    ->date(),
                                Forms\Components\Select::make('status') 
                                    ->required()
                                    ->options(static::$statuses)
                            ])
                    ])->columns(1)
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('user.name')
                    ->badge()
                    ->label('Author'),
                Tables\Columns\TextColumn::make('published_at')
                    ->date()
                    ->label('Published Date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('user', fn($q) => $q->whereKey(auth()->id()));
            });
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                Group::make()
                                    ->schema([
                                        TextEntry::make('title'),
                                        TextEntry::make('slug'),
                                        TextEntry::make('published_at')
                                            ->badge()
                                            ->date()
                                    ]),
                                Group::make()
                                    ->schema([
                                        TextEntry::make('user.name'),
                                        TextEntry::make('tags.name')
                                            ->badge()
                                            ->color('gray'),
                                        TextEntry::make('status')
                                            ->badge(),
                                    ]),
                                Group::make()
                                    ->schema([
                                        ImageEntry::make('thumbnail')
                                    ])
                                
                            ])
                            ->columns(3)
                    ]),
                Section::make('Content')
                    ->schema([
                        TextEntry::make('content')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->markdown()
                            ->prose()
                    ])
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }    
}
