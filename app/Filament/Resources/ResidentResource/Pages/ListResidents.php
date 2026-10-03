<?php

namespace App\Filament\Resources\ResidentResource\Pages;

use App\Filament\Resources\ResidentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Override;

class ListResidents extends ListRecords
{
    protected static string $resource = ResidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Hapus'),
        ];
    }
    public function getHeading(): string
    {
        return 'Data Warga';
    }
}
