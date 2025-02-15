<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Resources\Components\Tab;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';
    protected static ?string $navigationLabel = 'Data User';
    protected static ?string $navigationGroup = 'User';
    protected static ?int $navigationSort = 6;
    protected static ?string $modelLabel = 'Semua User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nama')
                ->required()
                ->columnSpan(2),
                Forms\Components\TextInput::make('email')
                ->label('Email')
                ->required()
                ->email()
                ->columnSpan(2),
                Forms\Components\TextInput::make('password')
                ->label('Password')
                ->required()
                ->password()
                ->columnSpan(2)
                ->visibleOn('create'),
                Forms\Components\Select::make('role_id')
                ->options([
                    '1' => 'Admin',
                    '2' => 'Petugas',
                    '3' => 'Mahasiswa',
                ])
                ->label('Role')
                ->required()
                ->columnSpan(2),
                Forms\Components\DatePicker::make('created_at')
                ->label('Dibuat Pada')
                ->disabled()
                ->hiddenOn('create'),
                Forms\Components\DatePicker::make('updated_at')
                ->label('Diubah Pada')
                ->disabled()
                ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('')->state(
                    static function (HasTable $livewire, $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                )->label('No')
                    ->width(1),
                Tables\Columns\TextColumn::make('name')
                ->label('Nama'),
                Tables\Columns\TextColumn::make('email')
                ->label('Email'),
                Tables\Columns\TextColumn::make('role_id')
                ->label('Role')
                ->getStateUsing(function ($record) {
                    switch ($record->role_id) {
                        case 1:
                            return 'Admin';
                        case 2:
                            return 'Petugas';
                        case 3:
                            return 'Mahasiswa';
                        default:
                            return 'Unknown';
                    }
                })

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([

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
            'index' => Pages\ListUsers::route('/'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }
    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Semua User';
    }
}
