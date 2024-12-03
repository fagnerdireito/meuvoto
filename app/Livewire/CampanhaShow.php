<?php

namespace App\Livewire;

use App\Models\Cadastro;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CampanhaShow extends Component implements HasForms
{
    use InteractsWithForms;

    // form de votacao
    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('cpf')
                ->required()
                ->maxLength(11)
                // verificar se existe no banco de dados
                ->rule(fn($attribute, $value, $fail) => Cadastro::where('cpf', $value)->exists() ? $fail('CPF não encontrado') : null),
        ]);
    }

    public function render()
    {
        return view('livewire.campanha-show');
    }
}
