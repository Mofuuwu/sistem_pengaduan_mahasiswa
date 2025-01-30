<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use App\Filament\Resources\ComplaintResource;
use App\Models\Complaint;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListComplaints extends ListRecords
{
    protected static string $resource = ComplaintResource::class;

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
                    return Complaint::count();
                }
            ), 
            'dikirim' => Tab::make('Dikirim')
            ->icon('heroicon-s-paper-airplane')
            ->badge(function() {
                return Complaint::whereHas('logs', function (Builder $query) {
                    $query->where('name', 'dikirim')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                })->count();
            })
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('logs', function (Builder $query) {
                    $query->where('name', 'dikirim')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                });
            }),
            'diterima' => Tab::make('Diterima')
            ->icon('heroicon-s-clipboard-document-check')
            ->badge(function() {
                return Complaint::whereHas('logs', function (Builder $query) {
                    $query->where('name', 'diterima')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                })->count();
            })
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('logs', function (Builder $query) {
                    $query->where('name', 'diterima')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                });
            }),
            'ditinjau' => Tab::make('Ditinjau')
            ->icon('heroicon-s-eye')
            ->badge(function() {
                return Complaint::whereHas('logs', function (Builder $query) {
                    $query->where('name', 'ditinjau')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                })->count();
            })
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('logs', function (Builder $query) {
                    $query->where('name', 'ditinjau')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                });
            }),
            'diproses' => Tab::make('Diproses')
            ->icon('heroicon-s-arrow-path')
            ->badge(function() {
                return Complaint::whereHas('logs', function (Builder $query) {
                    $query->where('name', 'diproses')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                })->count();
            })
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('logs', function (Builder $query) {
                    $query->where('name', 'diproses')
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
            'ditolak' => Tab::make('Ditolak')
            ->icon('heroicon-s-x-circle')
            ->badge(function() {
                return Complaint::whereHas('logs', function (Builder $query) {
                    $query->where('name', 'ditolak')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                })->count();
            })
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('logs', function (Builder $query) {
                    $query->where('name', 'ditolak')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                });
            }),
            'dibatalkan' => Tab::make('Dibatalkan')
            ->icon('heroicon-s-archive-box-x-mark')
            ->badge(function() {
                return Complaint::whereHas('logs', function (Builder $query) {
                    $query->where('name', 'dibatalkan')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                })->count();
            })
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('logs', function (Builder $query) {
                    $query->where('name', 'dibatalkan')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                });
            }),
            'ditangguhkan' => Tab::make('Ditangguhkan')
            ->icon('heroicon-s-pause-circle')
            ->badge(function() {
                return Complaint::whereHas('logs', function (Builder $query) {
                    $query->where('name', 'ditangguhkan')
                        ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('logs')
                                  ->groupBy('complaint_id');
                        });
                })->count();
            })
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('logs', function (Builder $query) {
                    $query->where('name', 'ditangguhkan')
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
