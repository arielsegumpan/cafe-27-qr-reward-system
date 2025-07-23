<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CustomerResource;
use Illuminate\Database\Eloquent\Model;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = User::find($data['user_id']);

        $cleanName = preg_replace('/\s+/', ' ', trim($data['full_name'])); // Normalize spacing

        // Split by comma
        $nameParts = explode(',', $cleanName, 2);

        $data['user_id'] = $user->id;
        $data['first_name'] = trim($nameParts[0] ?? '');
        $data['last_name'] = trim($nameParts[1] ?? '');
        $data['email'] = $user->email;
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        $user = User::updateOrCreate(
            ['email' => $this->sanitizeData($data['email'])],
            [
                'name' => ucfirst($this->sanitizeData($data['first_name'])) . ' ' . ucfirst($this->sanitizeData($data['last_name'])),
                'email' => $this->sanitizeData($data['email']),
                'password' => bcrypt('password'),
            ]
        );

        $data['user_id'] = $user->id;
        $data['full_name'] = ucfirst($this->sanitizeData($data['first_name'])) . ', ' . ucfirst($this->sanitizeData($data['last_name']));

        $record->update($data);

        return $record;
    }


    protected function sanitizeData($data)
    {
        return htmlspecialchars(strip_tags(trim($data)));
    }
}
