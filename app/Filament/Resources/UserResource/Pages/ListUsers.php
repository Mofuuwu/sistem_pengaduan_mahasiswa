<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
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
