<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CustomerResource;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): Model
    {

        $user = User::create([
            'name' => ucfirst($this->sanitizeData($data['first_name'])) . ' ' . ucfirst($this->sanitizeData($data['last_name'])),
            'email' => $this->sanitizeData($data['email']),
            'password' => bcrypt('password'),
        ]);

        $data['user_id'] = $user->id;
        $data['full_name'] = ucfirst($this->sanitizeData($data['first_name'])) . ', ' . ucfirst($this->sanitizeData($data['last_name']));

        return static::getModel()::create($data);
    }


    protected function sanitizeData($data)
    {
        return htmlspecialchars(strip_tags(trim($data)));
    }
}
