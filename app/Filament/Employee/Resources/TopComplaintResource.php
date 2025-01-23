<?php

namespace App\Filament\Employee\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Complaint;
use Filament\Tables\Table;
use App\Models\TopComplaint;
use Filament\Resources\Resource;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Employee\Resources\TopComplaintResource\Pages;
use App\Filament\Employee\Resources\TopComplaintResource\RelationManagers;

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
            // Tables\Columns\TextColumn::make('created_at') 
            //     ->label('Dibuat Pada')
            //     ->date(),
            Tables\Columns\TextColumn::make('support_count')
                ->label('Dukungan'),
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            // 'create' => Pages\CreateTopComplaint::route('/create'),
            // 'edit' => Pages\EditTopComplaint::route('/{record}/edit'),
        ];
    }
}
