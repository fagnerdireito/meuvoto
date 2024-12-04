<?php

namespace App\Filament\Resources\CampanhaResource\Pages;

use App\Filament\Resources\CampanhaResource;
use App\Models\Campanha;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCampanha extends EditRecord
{
    protected static string $resource = CampanhaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            // Acessar
            Actions\Action::make('acessar')
                ->url(fn(Campanha $record) => route('campanha.show', $record->slug))
                ->openUrlInNewTab()
                ->icon('heroicon-o-eye'),
        ];
    }
}
