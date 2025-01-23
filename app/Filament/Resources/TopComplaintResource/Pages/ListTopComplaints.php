<?php

namespace App\Filament\Resources\TopComplaintResource\Pages;

use App\Filament\Resources\TopComplaintResource;
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
