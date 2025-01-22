<?php

namespace App\Filament\Resources;

use Filament\Forms;
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
                ->options(User::all()->pluck('name', 'id'))
                ->label('Nama')
                ->disabled()
                ->columnSpan(2),
                Forms\Components\Select::make('user_id')
                ->options(User::all()->pluck('email', 'id'))
                ->label('Email')
                ->disabled()
                ->columnSpan(2),
                Forms\Components\TextInput::make('phone_number')
                ->label('Nomor Telepon')
                ->columnSpan(2),
                Forms\Components\TextArea::make('address')
                ->label('Alamat')
                ->columnSpan(2),
                Forms\Components\DatePicker::make('created_at')
                ->label('Dibuat Pada')
                ->columnSpan(2),
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
            // 'create' => Pages\CreateEmployee::route('/create'),
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
