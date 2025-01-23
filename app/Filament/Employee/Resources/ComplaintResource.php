<?php

namespace App\Filament\Employee\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Complaint;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Employee\Resources\ComplaintResource\Pages;
use App\Filament\Employee\Resources\ComplaintResource\RelationManagers;
use App\Models\User;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-s-megaphone';
    protected static ?string $navigationLabel = 'Semua Aduan';
    protected static ?string $navigationGroup = 'Aduan';
    protected static ?string $modelLabel = 'Semua Aduan';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Tabs::make('Tabs')
                //     ->columnSpan(2)
                //     ->tabs([
                //         Forms\Components\Tabs\Tab::make('Aduan')
                //             ->icon('heroicon-m-bell')
                //             ->schema([
                //                 Forms\Components\TextInput::make('id')
                //                     ->label('Kode Unik')
                //                     ->disabled()
                //                     ->columnSpan(2),
                //                 Forms\Components\Select::make('user_name')
                //                     ->relationship('user', 'name')
                //                     ->disabled()
                //                     ->label('Nama Pengirim')
                //                     ->columnSpan(2),
                //                 Forms\Components\Select::make('location_name')
                //                     ->relationship('location', 'name')
                //                     ->disabled()
                //                     ->label('Lokasi'),
                //                 Forms\Components\Select::make('category_name')
                //                     ->relationship('category', 'name')
                //                     ->disabled()
                //                     ->label('Kategori'),
                //                 Forms\Components\TextArea::make('description')
                //                     ->disabled()
                //                     ->label('Keterangan')
                //                     ->columnSpan(2),
                //                 Forms\Components\DatePicker::make('created_at')
                //                     ->disabled()
                //                     ->label('Dibuat Pada')
                //                     ->columnSpan(1),
                //                 Forms\Components\DatePicker::make('updated_at')
                //                     ->disabled()
                //                     ->label('Diperbarui Pada')
                //                     ->columnSpan(1),
                //             ]),
                //         Forms\Components\Tabs\Tab::make('Profil Pengirim')
                //             ->icon('heroicon-m-bell')
                //             ->schema([
                //                 Forms\Components\Select::make('user_name')
                //                     ->relationship('user', 'name')
                //                     ->label('Nama Pengirim')
                //                     ->disabled(),
                //                 Forms\Components\Select::make('user_email')
                //                     ->relationship('user', 'email')
                //                     ->label('Email Pengirim')
                //                     ->disabled(),
                //             ]),
                    // ])
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
                    ->label('Nama Mahasiswa'),
                Tables\Columns\TextColumn::make('location.name')
                    ->label('Lokasi'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->date(),
                Tables\Columns\TextColumn::make('logs.name')
                    ->label('Status')
                    ->limit(30)
                    ->getStateUsing(function ($record) {
                        $latestLog = $record->logs()->latest()->first();
                        return $latestLog ? $latestLog->name : 'Tidak Ada Logs Terbaru';
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListComplaints::route('/'),
            'view' => Pages\ViewComplaints::route('detail/{record}'),
            // 'create' => Pages\CreateComplaint::route('/create'),
            // 'edit' => Pages\EditComplaint::route('/{record}/edit'),
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
        return 'Total Semua Aduan';
    }
}
