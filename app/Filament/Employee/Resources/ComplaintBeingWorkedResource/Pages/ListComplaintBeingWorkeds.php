<?php

namespace App\Filament\Employee\Resources\ComplaintBeingWorkedResource\Pages;

use App\Filament\Employee\Resources\ComplaintBeingWorkedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComplaintBeingWorkeds extends ListRecords
{
    protected static string $resource = ComplaintBeingWorkedResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
