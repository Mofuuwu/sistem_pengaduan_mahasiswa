<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Category;
use App\Models\Location;
use Filament\Forms\Form;
use App\Models\Complaint;
use Filament\Tables\Table;
use App\Models\CollegeStudent;
use Filament\Resources\Resource;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ComplaintResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ComplaintResource\RelationManagers;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-s-megaphone';
    protected static ?string $navigationLabel = 'Semua Aduan';
    protected static ?string $navigationGroup = 'Aduan';
    protected static ?string $modelLabel = 'Semua Aduan';
    
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                ->date()
                ->color('success'),
                Tables\Columns\BadgeColumn::make('logs.name')
                ->label('Status')
                ->limit(30)
                ->getStateUsing(function ($record) {
                    $latestLog = $record->logs()->latest()->first();
                    return $latestLog ? $latestLog->name : 'Tidak Ada Logs Terbaru';
                })
                ->color('primary'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListComplaints::route('/'),
            'view' => Pages\ViewComplaints::route('detail/{record}'),
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
