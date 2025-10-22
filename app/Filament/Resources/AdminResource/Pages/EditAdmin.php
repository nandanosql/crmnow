<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use App\Models\Admin;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('toggle_status')
                ->label(fn (): string => $this->record->is_active ? 'Disable Admin' : 'Enable Admin')
                ->icon(fn (): string => $this->record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                ->color(fn (): string => $this->record->is_active ? 'danger' : 'success')
                ->requiresConfirmation()
                ->modalHeading(fn (): string => $this->record->is_active ? 'Disable Admin' : 'Enable Admin')
                ->modalDescription(fn (): string => 
                    $this->record->is_active 
                        ? 'Are you sure you want to disable this admin? They will not be able to login.'
                        : 'Are you sure you want to enable this admin? They will be able to login.'
                )
                ->action(function () {
                    $this->record->update(['is_active' => !$this->record->is_active]);
                    $this->refreshFormData(['is_active']);
                })
                ->visible(fn (): bool => $this->record->email !== 'admin@crmnow.com'),
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
