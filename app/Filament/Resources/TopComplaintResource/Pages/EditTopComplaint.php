<?php

namespace App\Filament\Resources\TopComplaintResource\Pages;

use App\Filament\Resources\TopComplaintResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopComplaint extends EditRecord
{
    protected static string $resource = TopComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
