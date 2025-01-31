<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\Complaint;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class ComplaintStats extends BaseWidget
{
    protected static bool $isLazy = false;
    protected ?string $heading = 'Analisa Pengaduan';
 
    protected ?string $description = 'Analisa Pengaduan';
    protected function getStats(): array
    {
        return [
        Stat::make('Semua Pengaduan', Complaint::all()->count()),
        Stat::make('Pengaduan Belum Selesai', Complaint::whereHas('logs', function (Builder $query) {
            $query->whereNot('name', 'selesai')
                ->whereIn('id', function ($query) {
                    $query->selectRaw('max(id)')
                          ->from('logs')
                          ->groupBy('complaint_id');
                });
        })->count()),
        Stat::make('Aduan Selesai', Complaint::whereHas('logs', function (Builder $query) {
            $query->where('name', 'selesai')
                ->whereIn('id', function ($query) {
                    $query->selectRaw('max(id)')
                          ->from('logs')
                          ->groupBy('complaint_id');
                });
        })->count()),
        ];
    }
}
