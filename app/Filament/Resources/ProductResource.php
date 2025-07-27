<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Split;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as InfoSec;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?String $navigationLabel = 'Product Items';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                ->schema([
                    TextInput::make('prod_name')
                        ->label('Name')
                        ->required()
                        ->maxLength(255)
                        ->unique(Product::class, 'prod_name', ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('prod_slug', Str::slug($state)))
                        ->autocapitalize('words'),

                    TextInput::make('prod_slug')
                        ->label('Slug')
                        ->disabled()
                        ->dehydrated()
                        ->required()
                        ->maxLength(255)
                        ->unique(Product::class, 'prod_slug', ignoreRecord: true),

                    ToggleButtons::make('is_active')
                        ->boolean()
                        ->inline()
                        ->label('Is product active?')
                        ->default(true)
                        ->dehydrated(),

                    RichEditor::make('prod__desc')
                    ->label('Description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                ])
                ->columnSpan([
                    'sm' => 1,
                    'md' => 3,
                    'lg' => 3
                ]),

                Section::make()
                ->schema([
                    Select::make('product_category_id')
                        ->label('Category')
                        ->relationship(name: 'product_category', titleAttribute: 'category_name')
                        ->required()
                        ->native()
                        ->searchable()
                        ->preload()
                        ->optionsLimit(6),

                    TextInput::make('prod_price')
                        ->label('Price')
                        ->required()
                        ->numeric()
                        ->minValue(0.00)
                        ->dehydrated()
                        ->default(0.00),

                    TextInput::make('prod_qty')
                        ->label('Quantity')
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->dehydrated()
                        ->default(1),

                    FileUpload::make('prod_image')
                    ->label('Upload Image')
                    ->image()
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->maxSize(2048)
                    ->columnSpanFull(),
                ])
                ->columnSpan([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2
                ])

            ])
            ->columns([
                'sm' => 1,
                'md' => 5,
                'lg' => 5
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('prod_image')
                ->square()
                ->placeholder('No Image')
                ->label('Image'),

                TextColumn::make('prod_name')
                ->sortable()
                ->searchable()
                ->label('Name')
                ->weight(FontWeight::Bold),

                TextColumn::make('prod_slug')
                ->sortable()
                ->label('Slug')
                ->badge()
                ->color('primary'),

                TextColumn::make('product_category.category_name')
                ->sortable()
                ->searchable()
                ->label('Category')
                ->icon('heroicon-o-tag'),

                TextColumn::make('prod_price')
                ->sortable()
                ->searchable()
                ->label('Price')
                ->money('Php ', locale: 'en')
                ->badge()
                ->color('success'),

                TextColumn::make('prod_quantity')
                ->label('Quantity'),

                ToggleColumn::make('is_active')
                ->sortable()
                ->searchable()
                ->label('Is Active?'),

                TextColumn::make('prod__desc')
                ->sortable()
                ->searchable()
                ->label('Description')
                ->html()
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
                ->label(__('New Product')),
            ])
            ->emptyStateIcon('heroicon-o-building-storefront')
            ->emptyStateHeading('No Products are created')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }



     public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Split::make([
                    Group::make([
                        InfoSec::make([
                            TextEntry::make('prod_name')
                                ->placeholder('No product name')
                                ->label('Product')
                                ->size(TextEntry\TextEntrySize::Large)
                                ->weight(FontWeight::Bold)
                                ->columnSpanFull(),

                            TextEntry::make('prod_slug')
                                ->placeholder('No Slug')
                                ->label('Slug')
                                ->badge()
                                ->color('warning'),

                            TextEntry::make('product_category.category_name')
                                ->placeholder('No Category')
                                ->label('Category')
                                ->icon('heroicon-o-tag'),
                        ])
                        ->columns([
                            'sm' => 1,
                            'md' => 2,
                            'lg' => 2
                        ]),

                        InfoSec::make([
                            TextEntry::make('prod__desc')
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
                            ImageEntry::make('prod_image')
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
