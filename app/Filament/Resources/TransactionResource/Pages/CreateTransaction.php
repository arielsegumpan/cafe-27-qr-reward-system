<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\TransactionResource;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
     protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $data['prod_name'] = Str::title($data['prod_name']);
        // $data['prod_slug'] = Str::lower($data['prod_name']);
        return $data;
    }
}
