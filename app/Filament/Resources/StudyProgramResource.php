<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudyProgramResource\Pages;
use App\Filament\Resources\StudyProgramResource\RelationManagers;
use App\Models\Faculty;
use App\Models\StudyProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Contracts\HasTable;

class StudyProgramResource extends Resource
{
    protected static ?string $model = StudyProgram::class;

    protected static ?string $navigationIcon = 'heroicon-s-building-library';
    protected static ?string $modelLabel = 'Daftar Program Studi';
    protected static ?string $navigationLabel = 'Program Studi';
    protected static ?string $navigationGroup = 'Data Universitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nama Fakultas')
                ->columnSpan(2)
                ->required(),
                Forms\Components\Select::make('faculty_id')
                ->label('Fakultas')
                ->options(Faculty::all()->pluck('name', 'id'))
                ->columnSpan(2)
                ->required(),
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
                Tables\Columns\TextColumn::make('name')
                ->label('Nama Program Studi'),
                Tables\Columns\TextColumn::make('faculty.name')
                ->label('Fakultas'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListStudyPrograms::route('/'),
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
        return 'Total Semua Program Studi';
    }
}
