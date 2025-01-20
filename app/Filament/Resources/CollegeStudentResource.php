<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CollegeStudent;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CollegeStudentResource\Pages;
use App\Filament\Resources\CollegeStudentResource\RelationManagers;

class CollegeStudentResource extends Resource
{
    protected static ?string $model = CollegeStudent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nim')
                ->label('Nim')
                ->columnSpan(2),
                Forms\Components\Select::make('user_id')
                ->label('Nama User')
                ->options(User::pluck('name', 'id'))
                ->searchable()
                ->disabled()
                ->columnSpan(2),
                Forms\Components\TextArea::make('address')
                ->label('Alamat')
                ->columnSpan(2),
                Forms\Components\TextInput::make('phone_number')
                ->label('Nomor Telepon')
                ->columnSpan(2),
                Forms\Components\DatePicker::make('dob')
                ->label('Tanggal Lahir'),
                Forms\Components\DatePicker::make('created_at')
                ->label('Dibuat Pada')
                ->disabled(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nim')
                ->label('NIM'),
                Tables\Columns\TextColumn::make('user.name')
                ->label('Nama')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCollegeStudents::route('/'),
            // 'create' => Pages\CreateCollegeStudent::route('/create'),
            // 'view' => Pages\ViewCollegeStudent::route('/{record}'),
            'edit' => Pages\EditCollegeStudent::route('/{record}/edit'),
        ];
    }
}
