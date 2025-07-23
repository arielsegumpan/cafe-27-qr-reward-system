<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Split;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as InfoSec;
use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Filament\Resources\ProductCategoryResource\RelationManagers;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    TextInput::make('category_name')
                    ->label('Category')
                    ->required()
                    ->maxLength(255)
                    ->unique(ProductCategory::class, 'category_name', ignoreRecord: true)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('category_slug', Str::slug($state))),
 
                    TextInput::make('category_slug')
                    ->label('Slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->maxLength(255)
                    ->unique(ProductCategory::class, 'category_slug', ignoreRecord: true)
                    ->columnSpanFull(),

                    RichEditor::make('category_desc')
                    ->label('Description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                ])
                ->columnSpan([
                    'md' => 1,
                    'lg' => 2
                ]),

                Section::make()
                ->schema([
                    FileUpload::make('category_image')
                    ->label('Image')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->maxSize(2048)
                    ->uploadingMessage('Uploading image...')
                    ->columnSpanFull(),
                ])
                ->columnSpan([
                    'md' => 1,
                    'lg' => 1
                ])


            ])
            ->columns([
                'sm' => 1,
                'md' => 2,
                'lg' => 3,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('category_image')
                ->label('Image')
                ->square()
                ->placeholder('No Image'),

                TextColumn::make('category_name')
                ->sortable()
                ->searchable()
                ->label('Category')
                ->formatStateUsing(fn ($state) => Str::title($state))
                ->weight(FontWeight::Bold),

                TextColumn::make('category_slug')
                ->sortable()
                ->label('Slug'),

                TextColumn::make('category_desc')
                ->sortable()
                ->searchable()
                ->label('Description')
                ->wrap()
                ->limit(50)
                ->toggleable(isToggledHiddenByDefault: true),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('Actions')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('New Category')),
            ])
            ->emptyStateIcon('heroicon-o-tag')
            ->emptyStateHeading('No Categories are created')
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Split::make([
                    Group::make([
                        InfoSec::make([
                            TextEntry::make('category_name')
                                ->placeholder('No Category')
                                ->label('Category')
                                ->size(TextEntry\TextEntrySize::Large)
                                ->weight(FontWeight::Bold)
                                ->icon('heroicon-o-tag')
                                ->color('warning'),

                            TextEntry::make('category_slug')
                                ->placeholder('No Slug')
                                ->label('Slug')
                                ->badge()
                                ->color('warning'),
                        ])
                        ->columns([
                            'sm' => 1,
                            'md' => 2,
                            'lg' => 2
                        ]),

                        InfoSec::make([
                            TextEntry::make('category_desc')
                                ->placeholder('No Description')
                                ->label('Description')
                                ->prose()
                                ->html(),
                        ]),
                    ]),
                    Group::make([

                        InfoSec::make([

                            TextEntry::make('created_at')
                                ->date('M j, Y - g:i A')
                                ->icon('heroicon-o-calendar-days'),
                            TextEntry::make('updated_at')
                                ->date('M j, Y - g:i A')
                                ->icon('heroicon-o-calendar-days'),
                        ]),

                        InfoSec::make([
                            ImageEntry::make('category_image')
                            ->label('')
                            ->placeholder('No Image')
                            ->columnSpanFull()
                        ])
                    ])->grow(false),
                ])->from('md')
                ->columnSpanFull()

            ]);
    }
}
