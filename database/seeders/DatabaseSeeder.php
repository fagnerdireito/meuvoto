<?php

namespace Database\Seeders;

use App\Models\Cadastro;
use App\Models\Campanha;
use App\Models\Enquete;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Fagner Santos',
            'email' => 'admin@admin.com',
            'password' => Hash::make('meuvoto@2024'),
        ]);

        // seed cadastros
        Cadastro::create([
            'nome' => 'Fagner dos Santos Goncalves',
            'matricula' => '223',
            'cpf' => '69534100124',
            'email' => 'fagnerdireito@gmail.com',
            'celular' => '64992251987',
        ]);

        // seed campanhas
        Campanha::create([
            'user_id' => 1,
            'logo' => 'https://meuvoto.sigov.com.br/sindisleg.png',
            'nome' => 'Campanha de teste',
            'descricao' => 'Campanha de teste',
            'slug' => 'campanha-de-teste',
            'informacoes' => 'Campanha de teste',
            'data_inicio' => now(),
            'data_fim' => now()->addDays(1),
            'ativa' => true,
            'votante_cadastrado' => true,
            'votos_por_usuario' => 1,
            'mostrar_resultados_apos_voto' => false,
        ]);

        // seed enquetes
        Enquete::create([
            'campanha_id' => 1,
            'pergunta' => 'Pergunta de teste',
            'opcoes' => [
                ['opcao' => 'Sim'],
                ['opcao' => 'Não'],
            ],
        ]);
    }
}
