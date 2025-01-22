<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use App\Filament\Resources\ComplaintResource;
use App\Models\Complaint;
use Filament\Resources\Pages\Page;
use Filament\Actions;

class ViewComplaints extends Page
{
    public $complaint;
    protected static string $resource = ComplaintResource::class;
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
