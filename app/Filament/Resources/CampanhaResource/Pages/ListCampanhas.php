<?php

namespace App\Filament\Resources\CampanhaResource\Pages;

use App\Filament\Resources\CampanhaResource;
use App\Models\Campanha;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCampanhas extends ListRecords
{
    protected static string $resource = CampanhaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
