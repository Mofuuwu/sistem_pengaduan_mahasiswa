<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Logs;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LogsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LogsResource\RelationManagers;

class LogsResource extends Resource
{
    protected static ?string $model = Logs::class;

    protected static ?string $navigationIcon = 'heroicon-s-clock';
    protected static ?string $modelLabel = 'Logs Aduan';
    protected static ?string $navigationLabel = 'Logs Aduan';
    protected static ?string $navigationGroup = 'Aduan';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
                Tables\Columns\BadgeColumn::make('name')
                ->label('Nama Logs')
                ->color('primary'),
                Tables\Columns\TextColumn::make('complaint_id')
                ->label('ID Aduan'),
                Tables\Columns\TextColumn::make('employee.user.name')
                ->label('Dibuat Oleh')
                ->default('User')
                ->color('primary'),
                Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat Pada')
                ->color('success')
                ->date('d F Y'),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->label('Lihat Aduan')
                ->url(function ($record) {
                    return '/admin/complaints/detail/' . $record->complaint->id;
                })            
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
            'index' => Pages\ListLogs::route('/'),
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
        return 'Total Semua Logs';
    }
}
