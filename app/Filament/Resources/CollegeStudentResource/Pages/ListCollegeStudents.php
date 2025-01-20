<?php

namespace App\Filament\Resources\CollegeStudentResource\Pages;

use App\Filament\Resources\CollegeStudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCollegeStudents extends ListRecords
{
    protected static string $resource = CollegeStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
}
