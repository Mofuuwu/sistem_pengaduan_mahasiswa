<?php

namespace App\Filament\Employee\Resources\LogsResource\Pages;

use App\Filament\Employee\Resources\LogsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLogs extends ListRecords
{
    protected static string $resource = LogsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
