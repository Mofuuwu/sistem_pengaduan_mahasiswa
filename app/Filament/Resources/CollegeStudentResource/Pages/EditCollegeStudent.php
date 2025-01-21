<?php

namespace App\Filament\Resources\CollegeStudentResource\Pages;

use App\Filament\Resources\CollegeStudentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCollegeStudent extends EditRecord
{
    protected static string $resource = CollegeStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
