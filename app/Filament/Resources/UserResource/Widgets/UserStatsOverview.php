<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\CollegeStudent;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
class UserStatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;
    protected ?string $heading = 'Analisa User';
 
    protected ?string $description = 'Analisa User';
    protected function getStats(): array
    {
        return [
        Stat::make(' User', User::all()->count()),
            // ->description('Jumlah User Terdaftar'),
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->color('success')
            // ->chart([7, 2, 10, 3, 15, 4, 17])
        Stat::make('Mahasiswa', CollegeStudent::all()->count()),
        // ->description('Jumlah Mahasiswa Terdaftar'),
            // ->description('7% decrease')
            // ->descriptionIcon('heroicon-m-arrow-trending-down')
            // ->color('danger')
            // ->chart([17, 4, 15, 3, 10, 2, 7]),
        Stat::make('Petugas', Employee::all()->count()),
        // ->description('Jumlah Petugas Terdaftar'),
            // ->description('3% increase')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->color('success'),
        Stat::make('Admin', User::where('role_id', 1)->count())
            // ->description('3% increase')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->color('success'),
        ];
    }
}
