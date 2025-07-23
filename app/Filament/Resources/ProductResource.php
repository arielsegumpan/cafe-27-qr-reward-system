<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
                TextInput::make('prod_name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255)
                    ->unique(Product::class, 'prod_name', ignoreRecord: true)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('prod_slug', Str::slug($state))),
                TextInput::make('prod_slug')
                    ->label('Slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->maxLength(255)
                    ->unique(Product::class, 'prod_slug', ignoreRecord: true),

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
                    ->numeric(),

                TextInput::make('prod_qty')
                    ->label('Quantity')
                    ->required()
                    ->numeric(),

                ToggleButtons::make('is_active')
                    ->boolean()
                    ->inline()
                    ->label('Is product active?')
                    ->default(true)
                    ->dehydrated(),

                FileUpload::make('prod_image')
                    ->label('Upload Image')
                    ->image()
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->maxSize(2048)
                    ->columnSpanFull(),




                RichEditor::make('prod__desc')
                    ->label('Description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
