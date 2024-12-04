<?php

namespace App\Livewire;

use App\Models\Cadastro;
use App\Models\Campanha;
use App\Models\Enquete;
use App\Models\Voto;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CampanhaShow extends Component implements HasForms
{
    use InteractsWithForms;

    public $cpf;
    public $cpfValido = false;
    public $cadastro;
    public $campanhaId;
    public $pergunta;
    public $campanha;

    public $slug;
    public $voto;
    public $votoConfirmado = false;
    public string $mensagemFinal;



    public function mount($slug)
    {
        if (!$slug) {
            abort(404);
        }

        $this->campanha = Campanha::where('slug', $this->slug)->first();

        if (!$this->campanha) {
            abort(404);
        }

        $this->mensagemFinal = "Voto registrado com sucesso!";


        // verifica a data inicial para exibir
        if ($this->campanha->data_inicio > now()) {
            abort(404);
        }

        // verifica a data final para exibir
        if ($this->campanha->data_fim < now()) {
            abort(404);
        }

        // verificar se esta ativa
        if (!$this->campanha->ativa) {
            abort(404);
        }

        // $this->slug = $slug;
        // $this->cpf = '69534101249';
        // $this->cpfValido = true;
        // $this->cadastro = Cadastro::where('cpf', $this->cpf)->first();
    }

    protected function messages()
    {
        return [
            'cpf.required' => 'O CPF é obrigatório',
            'cpf.size' => 'O CPF é inválido',
        ];
    }

    public function consultaCpf()
    {
        $validated = $this->validate([
            'cpf' => 'required|string|size:14',
        ]);

        // limpa cpf com regex somente numeros
        $cpfLimpo = preg_replace('/[^0-9]/', '', $this->cpf);

        $cadastro = Cadastro::where('cpf', $cpfLimpo)->first();

        if ($cadastro) {
            $this->cpfValido = true;
        } else {
            $this->cpfValido = false;
            // validation exception
            throw ValidationException::withMessages([
                'cpf' => 'CPF não encontrado',
            ]);
        }

        $this->cadastro = $cadastro;

        // verifica se o cadastro já votou
        $votou = Voto::where('cadastro_id', $this->cadastro->id)
            ->where('campanha_id', $this->campanha->id)
            ->first();

        if ($votou) {
            $this->votoConfirmado = true;
            $this->mensagemFinal = "Verificamos que você já votou, Obrigado!<br><br>Voto registrado com sucesso!";
        }
    }

    public function confirmarVoto()
    {
        // sleep(3);
        $validated = $this->validate([
            'voto' => 'required|string',
        ]);

        // 1. verifica se o cadastro já votou
        $votou = Voto::where('cadastro_id', $this->cadastro->id)
            ->where('campanha_id', $this->campanha->id)
            ->first();

        if ($votou) {
            Notification::make()
                ->title('Você já votou, Obrigado!')
                ->danger()
                ->send();

            $this->votoConfirmado = true;
            $this->mensagemFinal = "Verificamos que você já votou, Obrigado!<br><br>Voto registrado com sucesso!";

            throw ValidationException::withMessages([
                'voto' => 'Você já votou, Obrigado!',
            ]);
        }

        // 2. cria o voto
        $votacao = Voto::create([
            'cadastro_id' => $this->cadastro->id,
            'campanha_id' => $this->campanha->id,
            'voto' => true,
            'pergunta' => $this->pergunta,
            'resposta' => $this->voto,
            'ip' => request()->ip(),
            'navegador' => request()->userAgent(),
        ]);

        if ($votacao) {
            $this->votoConfirmado = true;
            Notification::make()
                ->title('Voto registrado com sucesso!')
                ->success()
                ->send();
        }
    }

    public function render()
    {

        $this->pergunta = Enquete::where('campanha_id', $this->campanha->id)->first()->pergunta ?? null;
        $this->enquetes = Enquete::where('campanha_id', $this->campanha->id)->get();

        return view('livewire.campanha-show', [
            'campanha' => $this->campanha,
            'cadastro' => $this->cadastro,
            'pergunta' => $this->pergunta,
            'enquetes' => $this->enquetes,
        ]);
    }
}
