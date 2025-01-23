<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Tables;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmployeeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\User;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-s-wrench-screwdriver';
    protected static ?string $navigationLabel = 'Data Karyawan';
    protected static ?string $navigationGroup = 'User';
    protected static ?string $modelLabel = 'Semua Karyawan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->options(function () {
                    return User::whereNotIn('role_id', [1, 3]) 
                    ->whereNotIn('id', function($query) {
                        $query->select('user_id')->from('employees');
                    })
                    ->pluck('name', 'id');  
                })
                ->label('Nama')
                ->placeholder('Pilih User Untuk Role Ini, Jika Tidak Ada Silahkan Buat Terlebih Dahulu')
                ->searchable()
                ->preload()
                ->columnSpan(2)
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->label('Nama'),
                    Forms\Components\TextInput::make('email')
                        ->required()
                        ->maxLength(255)
                        ->label('Email')
                        ->email(),
                    Forms\Components\TextInput::make('password')
                        ->required()
                        ->maxLength(255)
                        ->label('password')
                        ->password(),
                    Forms\Components\Hidden::make('role_id')
                        ->dehydrated()
                        ->default('2')
                ])
                ->required(),
                Forms\Components\Select::make('email')
                ->relationship('user', 'email')
                ->disabled()
                ->visibleOn('view')
                ->label('Email')
                ->columnSpan(2),
                Forms\Components\TextInput::make('phone_number')
                ->label('Nomor Telepon')
                ->columnSpan(2)
                ->required(),
                Forms\Components\TextArea::make('address')
                ->label('Alamat')
                ->columnSpan(2)
                ->required(),
                Forms\Components\Hidden::make('created_at')
                ->label('Dibuat Pada')
                ->default(now())
                ->columnSpan(2)
                ->dehydrated(),
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
                ->alignStart()
                ->width(1),
                Tables\Columns\TextColumn::make('user.name')
                ->label('Nama'),
                Tables\Columns\TextColumn::make('user.email')
                ->label('Email'),
                Tables\Columns\TextColumn::make('phone_number')
                ->label('Nomor Telepon'),
                Tables\Columns\TextColumn::make('address')
                ->label('Alamat'),

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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
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
        return 'Total Semua Karyawan';
    }
}
