<?php

namespace App\Filament\Resources\CampanhaResource\Pages;

use App\Filament\Resources\CampanhaResource;
use App\Models\Cadastro;
use App\Models\Voto;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class Resultados extends Page
{
    use InteractsWithRecord;

    public $pessoasVotantes;
    public $pessoasNaoVotantes;
    public $votosPorOpcao;

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        // pessoas que votaram
        $pessoasVotantes = Cadastro::whereHas('votos', function ($query) {
            $query->where('campanha_id', $this->record->id);
        })->get();

        $this->pessoasVotantes = $pessoasVotantes;

        // count votos por opcao
        // $votosPorOpcao = Voto::where('campanha_id', $this->record->id)->distinct('resposta')->get();
        $votosPorOpcao = Voto::select('resposta', Voto::raw('COUNT(*) as total'))
            ->groupBy('resposta')
            ->get();
        $this->votosPorOpcao = $votosPorOpcao;
    }

    protected static string $resource = CampanhaResource::class;

    protected static string $view = 'filament.resources.campanha-resource.pages.resultados';
}
