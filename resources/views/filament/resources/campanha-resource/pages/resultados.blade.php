<x-filament-panels::page>
    <div>{{ $this->record->nome }}</div>

    @livewire(TotalVotos::class, ['total' => $pessoasVotantes->count()])

    <div class="chart-container flex">
        <div class="w-2/5">
            @livewire(VotosPorOpcao::class, ['votos' => $votosPorOpcao])
        </div>
        <div></div>
    </div>

    <div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                <thead class="bg-gray-200 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3" scope="col">
                            Nome
                        </th>
                        <th class="px-6 py-3" scope="col">
                            CPF
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Matrícula
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Voto
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pessoasVotantes as $pessoaVotante)
                        <tr
                            class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $pessoaVotante->nome }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pessoaVotante->cpf }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pessoaVotante->matricula }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pessoaVotante->votos->first()->resposta }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-filament-panels::page>
