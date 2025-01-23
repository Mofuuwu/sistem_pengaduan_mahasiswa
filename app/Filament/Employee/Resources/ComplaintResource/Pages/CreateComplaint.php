<?php

namespace App\Filament\Employee\Resources\ComplaintResource\Pages;

use App\Filament\Employee\Resources\ComplaintResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateComplaint extends CreateRecord
{
    protected static string $resource = ComplaintResource::class;
}
