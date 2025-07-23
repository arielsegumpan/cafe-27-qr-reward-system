<?php

namespace App\Filament\Resources\ProductCategoryResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProductCategoryResource;

class CreateProductCategory extends CreateRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): Model
    {
        $data['category_name'] = Str::title($data['category_name']);
        return static::getModel()::create($data);
    }

}
