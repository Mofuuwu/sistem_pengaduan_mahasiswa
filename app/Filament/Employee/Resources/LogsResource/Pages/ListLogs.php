<?php

namespace App\Filament\Employee\Resources\LogsResource\Pages;

use App\Models\Logs;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Employee\Resources\LogsResource;

class ListLogs extends ListRecords
{
    protected static string $resource = LogsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
    public function getTabs(): array
    {
        return [
            
            'semua' => Tab::make('Semua')
            ->icon('heroicon-s-clock')
            ->badge(
                badge: function() {
                    return Logs::count();
                }
            ),
            'dikirim' => Tab::make('Dikirim')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('name', 'dikirim'))
            ->icon('heroicon-s-paper-airplane')
            ->badge(
                badge: function() {
                    return Logs::where('name', 'dikirim')->count();
                }
            ),
            'diterima' => Tab::make('Diterima')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('name', 'diterima'))
            ->icon('heroicon-s-clipboard-document-check')
            ->badge(
                badge: function() {
                    return Logs::where('name', 'diterima')->count();
                }
            ),
            'ditinjau' => Tab::make('Ditinjau')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('name', 'ditinjau'))
            ->icon('heroicon-s-eye')
            ->badge(
                badge: function() {
                    return Logs::where('name', 'ditinjau')->count();
                }
            ),
            'diproses' => Tab::make('Diproses')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('name', 'diproses'))
            ->icon('heroicon-s-arrow-path')
            ->badge(
                badge: function() {
                    return Logs::where('name', 'diproses')->count();
                }
            ),
            'selesai' => Tab::make('Selesai')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('name', 'selesai'))
            ->icon('heroicon-s-check-circle')
            ->badge(
                badge: function() {
                    return Logs::where('name', 'selesai')->count();
                }
            ),
            'ditolak' => Tab::make('ditolak')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('name', 'ditolak'))
            ->icon('heroicon-s-x-circle')
            ->badge(
                badge: function() {
                    return Logs::where('name', 'ditolak')->count();
                }
            ),
            'dibatalkan' => Tab::make('Dibatalkan')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('name', 'dibatalkan'))
            ->icon('heroicon-s-archive-box-x-mark')
            ->badge(
                badge: function() {
                    return Logs::where('name', 'dibatalkan')->count();
                }
            ),
            'ditangguhkan' => Tab::make('Ditangguhkan')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('name', 'ditangguhkan'))
            ->icon('heroicon-s-pause-circle')
            ->badge(
                badge: function() {
                    return Logs::where('name', 'ditangguhkan')->count();
                }
            ),
        ];
    }
}
