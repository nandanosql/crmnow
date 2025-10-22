<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('toggle_status')
                ->label(fn (): string => $this->record->is_active ? 'Disable User' : 'Enable User')
                ->icon(fn (): string => $this->record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                ->color(fn (): string => $this->record->is_active ? 'danger' : 'success')
                ->requiresConfirmation()
                ->modalHeading(fn (): string => $this->record->is_active ? 'Disable User' : 'Enable User')
                ->modalDescription(fn (): string => 
                    $this->record->is_active 
                        ? 'Are you sure you want to disable this user? They will not be able to login.'
                        : 'Are you sure you want to enable this user? They will be able to login.'
                )
                ->action(function () {
                    $this->record->update(['is_active' => !$this->record->is_active]);
                    $this->refreshFormData(['is_active']);
                }),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Remove password from form data for edit
        unset($data['password']);
        unset($data['password_confirmation']);
        
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
