<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\Admin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Admins';

    protected static ?string $modelLabel = 'Admin';

    protected static ?string $pluralModelLabel = 'Admins';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Admin Information')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(255)
                            ->label('First Name'),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(255)
                            ->label('Last Name'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->label('Email Address')
                            ->disabled(fn (string $context): bool => $context === 'edit')
                            ->dehydrated(fn (string $context): bool => $context !== 'edit')
                            ->helperText(fn (string $context): string => $context === 'edit' ? 'Email cannot be changed' : ''),
                    ])->columns(2),
                
                Forms\Components\Section::make('Security')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->minLength(8)
                            ->maxLength(255)
                            ->label('Password')
                            ->helperText('Minimum 8 characters')
                            ->visible(fn (string $context): bool => $context === 'create'),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->same('password')
                            ->label('Confirm Password')
                            ->dehydrated(false)
                            ->visible(fn (string $context): bool => $context === 'create'),
                        Forms\Components\Placeholder::make('password_info')
                            ->label('Password')
                            ->content('Password cannot be changed from this form. Contact system administrator if password reset is needed.')
                            ->visible(fn (string $context): bool => $context === 'edit')
                            ->columnSpanFull(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Status')
                            ->helperText('Inactive admins cannot login')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All admins')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->hidden(fn (Admin $record): bool => $record->email === 'admin@crmnow.com'),
                Tables\Actions\Action::make('toggle_status')
                    ->label(fn (Admin $record): string => $record->is_active ? 'Disable' : 'Enable')
                    ->icon(fn (Admin $record): string => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn (Admin $record): string => $record->is_active ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->modalHeading(fn (Admin $record): string => $record->is_active ? 'Disable Admin' : 'Enable Admin')
                    ->modalDescription(fn (Admin $record): string => 
                        $record->is_active 
                            ? 'Are you sure you want to disable this admin? They will not be able to login.'
                            : 'Are you sure you want to enable this admin? They will be able to login.'
                    )
                    ->action(function (Admin $record) {
                        $record->update(['is_active' => !$record->is_active]);
                    })
                    ->hidden(fn (Admin $record): bool => $record->email === 'admin@crmnow.com'),
            ])
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
