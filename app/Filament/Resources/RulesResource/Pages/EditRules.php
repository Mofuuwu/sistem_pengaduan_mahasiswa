<?php

namespace App\Filament\Resources\RulesResource\Pages;

use App\Filament\Resources\RulesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRules extends EditRecord
{
    protected static string $resource = RulesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
