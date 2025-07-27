<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Models\User;
use Filament\Actions;
use Spatie\Permission\Models\Role;
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
        // Create the user
        $user = User::create([
            'name' => ucfirst($this->sanitizeData($data['first_name'])) . ' ' . ucfirst($this->sanitizeData($data['last_name'])),
            'email' => $this->sanitizeData($data['email']),
            'password' => bcrypt('password'),
        ]);

        // Ensure the 'customer' role exists or create it
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // Assign the role to the user
        $user->assignRole($customerRole);

        // Add user_id and full_name to the $data array
        $data['user_id'] = $user->id;
        $data['points_balance'] = (int)0;
        $data['full_name'] = ucfirst($this->sanitizeData($data['first_name'])) . ', ' . ucfirst($this->sanitizeData($data['last_name']));

        // Create and return the related model
        return static::getModel()::create($data);
    }

    protected function sanitizeData($data)
    {
        return htmlspecialchars(strip_tags(trim($data)));
    }
}
