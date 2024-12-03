<?php

namespace App\Filament\Resources\CampanhaResource\Pages;

use App\Filament\Resources\CampanhaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCampanhas extends ManageRecords
{
    protected static string $resource = CampanhaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
