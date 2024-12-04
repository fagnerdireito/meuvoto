<?php

namespace App\Livewire;

use Filament\Widgets\ChartWidget;

class VotosPorOpcao extends ChartWidget
{
    protected static ?string $heading = 'Votos por opção';

    public $votos;

    // public function mount($votos): void
    // {
    //     $this->votos = $votos;
    // }

    protected function getData(): array
    {
        // $colors to randomize, blue-600, red-600, yellow-600
        $colors = ['rgb(59, 130, 246)', 'rgb(239, 68, 68)', 'rgb(245, 158, 11)'];

        return [
            'datasets' => [
                [
                    'label' => 'Votos',
                    'data' => $this->votos->pluck('total'),
                    'backgroundColor' => $colors,
                ],
            ],
            'labels' => $this->votos->pluck('resposta'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
