<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Complaint;
use Filament\Tables\Table;
use App\Models\CollegeStudent;
use Filament\Resources\Resource;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CollegeStudentResource\Pages;
use App\Filament\Resources\CollegeStudentResource\RelationManagers;
use App\Models\Faculty;
use App\Models\StudyProgram;

class CollegeStudentResource extends Resource
{
    protected static ?string $model = CollegeStudent::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationLabel = 'Data Mahasiswa';
    protected static ?string $navigationGroup = 'User';
    protected static ?string $modelLabel = 'Semua Mahasiswa';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nim')
                    ->label('Nim')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('Nama User')
                    ->options(User::pluck('name', 'id'))
                    ->disabled()
                    ->columnSpan(2),
                Forms\Components\Select::make('study_program_id')
                    ->label('Program Studi')
                    ->options(fn($get) => StudyProgram::pluck('name', 'id'))  // Menampilkan semua program studi awal
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $studyProgram = StudyProgram::find($state);
                        if ($studyProgram) {
                            $set('faculty_id', $studyProgram->faculty_id);
                        }
                    }),

                Forms\Components\Select::make('faculty_id')
                    ->label('Fakultas')
                    ->options(fn($get) => Faculty::pluck('name', 'id')) // Menampilkan semua fakultas
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('study_program_id', null);
                    })
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\TextArea::make('address')
                    ->label('Alamat')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->label('Nomor Telepon')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\DatePicker::make('dob')
                    ->label('Tanggal Lahir')
                    ->required(),
                Forms\Components\DatePicker::make('created_at')
                    ->label('Dibuat Pada')
                    ->disabled(),
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
                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->width(1),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama'),
                Tables\Columns\BadgeColumn::make('total_complaints')
                    ->label('Aduan Dibuat')
                    ->state(static function ($record) {
                        $userId = $record->user_id;
                        return Complaint::where('user_id', $userId)->count();
                    })
                    ->color('success'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
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
            'edit' => Pages\EditCollegeStudent::route('/{record}/edit'),
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
        return 'Total Semua Mahasiswa';
    }
}
