<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Forms\Components\QrCodeField;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Split;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as InfoSec;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Filament\Resources\CustomerResource\RelationManagers\TransactionsRelationManager;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([

                    TextInput::make('cust_num')
                    ->label('Customer #')
                    ->required()
                    ->unique(Customer::class, 'cust_num', ignoreRecord: true)
                    ->maxLength(255)
                    ->disabled()
                    ->default('CUST-NUM' . '-' . strtoupper(Str::random(4)) . '-' . rand(500, 9999))
                    ->dehydrated()
                    ->columnSpanFull()
                    ->prefixIcon('heroicon-o-hashtag'),

                    TextInput::make('first_name')
                    ->maxLength(255)
                    ->required(),

                    TextInput::make('last_name')
                    ->maxLength(255)
                    ->required(),

                    TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->required(),

                    TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(255)
                    ->required(),

                    TextInput::make('password')
                    ->password()
                    ->maxLength(255)
                    ->revealable(),

                    TextInput::make('password_confirmation')
                    ->password()
                    ->maxLength(255)
                    ->same('password')
                    ->revealable(),
                ])
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2
                ]),

                Section::make()
                ->schema([
                    QrCodeField::make('qr_code')
                    ->label('Customer QR Code')
                    ->size(250)
                    ->columnSpanFull()
                    ->visible(fn ($record) => $record?->exists),
                ])
                ->visibleOn('edit')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('qr_code')
                ->label('QR Code')
                ->getStateUsing(function ($record) {
                    // Generate QR code URL from stored data
                    $qrData = $record->qr_code ?? [];

                    dd($qrData);
                    if (empty($qrData)) return null;

                    $params = http_build_query([
                        'size' => '100x100',
                        'data' => json_encode($qrData),
                        'format' => 'png',
                    ]);

                    return 'https://api.qrserver.com/v1/create-qr-code/?' . $params;
                })
                ->height(50)
                ->width(50)
                ->visible(fn ($record) => !empty($record->qr_code)),

                TextColumn::make('cust_num')
                ->sortable()
                ->searchable()
                ->badge()
                ->icon('heroicon-o-hashtag')
                ->label('Customer #')
                ->color('warning'),

                TextColumn::make('full_name')
                ->sortable()
                ->searchable()
                ->label('Name'),

                TextColumn::make('user.email')
                ->sortable()
                ->searchable()
                ->label('Email'),

                TextColumn::make('phone_number')
                ->sortable()
                ->searchable()
                ->icon('heroicon-o-phone')
                ->label('Phone Number'),

                TextColumn::make('address')
                ->sortable()
                ->searchable()
                ->label('Address')
                ->toggleable(isToggledHiddenByDefault: true)
                ->wrap()
                ->limit(50),


                TextColumn::make('created_at')
                ->label('Created At')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->since(),

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
                ->label(__('New Customer')),
            ])
            ->emptyStateIcon('heroicon-o-user-group')
            ->emptyStateHeading('No Customers are created')
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            TransactionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }



    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Split::make([
                    InfoSec::make([
                        TextEntry::make('cust_num')
                            ->placeholder('No Customer #')
                            ->label('Customer #')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-hashtag')
                            ->columnSpanFull()
                            ->color('warning'),

                        TextEntry::make('full_name')
                            ->placeholder('No Name')
                            ->label('Name')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-user'),

                        TextEntry::make('user.email')
                            ->placeholder('No Email')
                            ->label('Email')
                            ->weight(FontWeight::Bold)
                            ->badge()
                            ->icon('heroicon-o-envelope')
                            ->color('success'),

                        TextEntry::make('phone_number')
                            ->placeholder('No Phone Number')
                            ->label('Phone Number')
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-phone'),

                        TextEntry::make('address')
                            ->placeholder('No Address')
                            ->label('Address')
                            ->weight(FontWeight::Bold)
                            ->columnSpanFull()
                            ->icon('heroicon-o-map-pin'),
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2
                    ]),
                    InfoSec::make([
                        TextEntry::make('created_at')
                            ->date('M j, Y - g:i A'),
                        TextEntry::make('updated_at')
                            ->date('M j, Y - g:i A'),


                        // // Add QR Code to the right side
                        // QrCodeField::make('qr_code')
                        // ->label('Customer QR Code')
                        // ->size(200)
                        // ->columnSpanFull(),
                    ])->grow(false),
                ])->from('md')
                ->columnSpanFull()

            ]);
    }
}
