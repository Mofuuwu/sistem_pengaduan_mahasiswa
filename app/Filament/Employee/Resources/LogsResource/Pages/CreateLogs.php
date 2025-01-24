<?php

namespace App\Filament\Employee\Resources\LogsResource\Pages;

use App\Filament\Employee\Resources\LogsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLogs extends CreateRecord
{
    protected static string $resource = LogsResource::class;
}
