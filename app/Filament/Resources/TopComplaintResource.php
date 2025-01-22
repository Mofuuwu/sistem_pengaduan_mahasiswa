<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Complaint;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TopComplaintResource\Pages;
use App\Filament\Resources\TopComplaintResource\RelationManagers;

class TopComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-s-fire';
    protected static ?string $modelLabel = 'Aduan Teratas';
    protected static ?string $navigationLabel = 'Aduan Teratas';
    protected static ?string $navigationGroup = 'Aduan';

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
                    ->label('Nama Mahasiswa'),
                Tables\Columns\TextColumn::make('location.name') 
                    ->label('Lokasi'),
                Tables\Columns\TextColumn::make('category.name') 
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('created_at') 
                    ->label('Dibuat Pada')
                    ->date(),
                Tables\Columns\TextColumn::make('support_count')
                    ->label('Jumlah Support'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $query->select('complaints.*', DB::raw('COUNT(supports.id) as support_count'))
                    ->leftJoin('supports', 'supports.complaint_id', '=', 'complaints.id')
                    ->groupBy('complaints.id')
                    ->orderByDesc('support_count'); // Urutkan berdasarkan jumlah support terbanyak
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
            'index' => Pages\ListTopComplaints::route('/'),
            'view' => Pages\ViewTopComplaints::route('detail/{record}'),
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
        return 'Total Semua Aduan Teratas';
    }
}
