<?php

namespace App\Filament\Employee\Resources\ComplaintBeingWorkedResource\Pages;

use Filament\Actions;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Employee\Resources\ComplaintBeingWorkedResource;

class ListComplaintBeingWorkeds extends ListRecords
{
    protected static string $resource = ComplaintBeingWorkedResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
    public function getTabs(): array
    {
        return [
            
            'semua' => Tab::make('Semua')
            ->icon('heroicon-s-square-3-stack-3d')
            ->badge(
                badge: function() {
                    return Complaint::whereHas('logs', function (Builder $query) {
                        $query->where('employee_id', Auth::user()->employee->id)
                            ->whereIn('id', function ($query) {
                                $query->selectRaw('max(id)')
                                      ->from('logs')
                                      ->groupBy('complaint_id');
                            });
                    })->count();
                }
            ), 
            'belum selesai' => Tab::make('Belum Delesai')
            ->icon('heroicon-s-x-circle')
            ->badge(function() {
                return Complaint::whereHas('logs', function (Builder $query) {
                    $query->whereNot('name', 'selesai')->where('employee_id', Auth::user()->employee->id)
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                })->count();
            })
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('logs', function (Builder $query) {
                    $query->whereNot('name', 'selesai')->where('employee_id', Auth::user()->employee->id)
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                });
            }),
            'selesai' => Tab::make('Selesai')
            ->icon('heroicon-s-check-circle')
            ->badge(function() {
                return Complaint::whereHas('logs', function (Builder $query) {
                    $query->where('name', 'selesai')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                })->count();
            })
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('logs', function (Builder $query) {
                    $query->where('name', 'selesai')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                });
            }),
        ];
    }
}
