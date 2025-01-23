<?php

namespace App\Filament\Employee\Resources\TopComplaintResource\Pages;

use App\Models\Complaint;
use Filament\Resources\Pages\Page;
use App\Filament\Employee\Resources\TopComplaintResource;
use Filament\Actions;

class ViewTopComplaints extends Page
{
    protected static string $resource = TopComplaintResource::class;
    public $complaint;
    protected static ?string $title = 'Detail Aduan';

    protected static string $view = 'filament.resources.complaint-resource.pages.view-complaints';
    public function mount($record) {
        $this->complaint = Complaint::where('id', $record)->first();
    }
    public function getHeaderActions(): array{
        return [
            Actions\Action::make('back')
                ->label('Kembali')
                ->color('info')
                ->url(fn () => static::getResource()::getUrl('index')),
        ];
    }
}
