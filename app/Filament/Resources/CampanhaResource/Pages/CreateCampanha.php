<?php

namespace App\Filament\Resources\CampanhaResource\Pages;

use App\Filament\Resources\CampanhaResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;

class CreateCampanha extends CreateRecord
{
    protected static string $resource = CampanhaResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        dd($data);
        $record = new ($this->getModel())($data);

        if (
            static::getResource()::isScopedToTenant() &&
            ($tenant = Filament::getTenant())
        ) {
            return $this->associateRecordWithTenant($record, $tenant);
        }

        $record->save();

        return $record;
    }
}
