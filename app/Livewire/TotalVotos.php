<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalVotos extends BaseWidget
{
    public $total;

    public function mount($total)
    {
        $this->total = $total;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total de Votos', $this->total),
        ];
    }
}
