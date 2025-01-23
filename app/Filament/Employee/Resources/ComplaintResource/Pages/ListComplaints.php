<?php

namespace App\Filament\Employee\Resources\ComplaintResource\Pages;

use App\Filament\Employee\Resources\ComplaintResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComplaints extends ListRecords
{
    protected static string $resource = ComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
}
