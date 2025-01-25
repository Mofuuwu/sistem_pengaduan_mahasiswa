<?php

namespace App\Filament\Employee\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Complaint;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\ComplaintBeingWorked;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Employee\Resources\ComplaintBeingWorkedResource\Pages;
use App\Filament\Employee\Resources\ComplaintBeingWorkedResource\RelationManagers;
use Filament\Tables\Contracts\HasTable;

class ComplaintBeingWorkedResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-s-briefcase';
    protected static ?string $navigationLabel = 'Aduan Diambil Alih';
    protected static ?string $modelLabel = 'Aduan Diambil Alih';
    protected static ?int $navigationSort = 1;

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
                Tables\Columns\TextColumn::make('user.name')
                ->label('Nama Pengirim'),
                Tables\Columns\TextColumn::make('location.name')
                ->label('Lokasi'),
                Tables\Columns\TextColumn::make('category.name')
                ->label('Kategori'),
                Tables\Columns\TextColumn::make('created_at')
                ->date('d F Y')
                ->color('success')
                ->label('Dibuat Pada'),
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
                Tables\Actions\ViewAction::make()
                    ->label('Lihat Aduan')
                    ->url(function ($record) {
                        return '/employee/complaints/detail/' . $record->id;
                    })
            ])
            ->bulkActions([
            ])
            ->modifyQueryUsing(function ($query) {
                return $query->whereHas('logs', function ($logQuery) {
                    $logQuery->where('employee_id', Auth::user()->employee->id);
                });
            });
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
            'index' => Pages\ListComplaintBeingWorkeds::route('/'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereHas('logs', function ($query) {
            $query->where('employee_id', Auth::user()->employee->id);
        })->count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }
    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Aduan Diambil Alih';
    }
}
