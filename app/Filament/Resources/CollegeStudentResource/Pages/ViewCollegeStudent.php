<?php

namespace App\Filament\Resources\CollegeStudentResource\Pages;

use App\Filament\Resources\CollegeStudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCollegeStudent extends ViewRecord
{
    protected static string $resource = CollegeStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
