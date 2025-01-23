<?php

namespace App\Filament\Employee\Resources\TopComplaintResource\Pages;

use App\Filament\Employee\Resources\TopComplaintResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopComplaints extends ListRecords
{
    protected static string $resource = TopComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
}
