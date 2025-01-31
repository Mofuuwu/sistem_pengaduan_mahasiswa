<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Widgets\UserStatsOverview;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'user' => Tab::make('Semua User')
            ->icon('heroicon-m-user-group')
            ->badge(
                badge: function() {
                    return User::count();
                }
            ),
            'college_student' => Tab::make('Mahasiswa')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('role_id', 3))
            ->icon('heroicon-m-user-group')
            ->badge(
                badge: function() {
                    return User::where('role_id', '3')->count();
                }
            ),
            'employee' => Tab::make('Petugas')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('role_id', 2))
            ->icon('heroicon-m-user-group')
            ->badge(
                badge: function() {
                    return User::where('role_id', '2')->count();
                }
            ),
            'admin' => Tab::make('Admin')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('role_id', 1))
            ->icon('heroicon-m-user-group')
            ->badge(
                badge: function() {
                    return User::where('role_id', '1')->count();
                }
            ),
        ];
    }
}
