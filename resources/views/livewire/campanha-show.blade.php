<div>
    <div>
        <div class="h-[50px] bg-gray-200"></div>
        <div class="container mx-auto mb-[50px] mt-[50px]">
            <div class="container mx-auto mb-[20px]">
                <img class="mb-3 w-[200px]" src="https://meuvoto.sigov.com.br/sindisleg.png" alt="Logo">
                <hr>
            </div>
            @if (!$cpfValido)
                <div class="flex w-[500px] justify-start">
                    <div>
                        <div class="my-1" for="cpf">Digite seu CPF</div>
                        <div class="flex gap-2">
                            <div class="w-72" x-data="{ errors: ['cpf'] }">
                                <x-filament::input.wrapper>
                                    <x-filament::input id="cpf"
                                        type="text"
                                        placeholder="Número do CPF"
                                        wire:model="cpf"
                                        maxlength="14" />
                                </x-filament::input.wrapper>
                                <div class="py-1 text-sm text-red-500">
                                    @error('cpf')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <x-filament::button wire:click="consultaCpf">
                                    Validar
                                </x-filament::button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4 mt-14">
                    <div class="text-lg font-bold">Informações</div>
                    <hr>
                    <div class="mt-4">{!! $campanha->informacoes !!}</div>
                </div>
            @endif
            @if ($cpfValido)
                @if (!$votoConfirmado)
                    <div class="flex justify-start">
                        <form wire:submit="confirmarVoto">
                            <div class="my-1 text-lg font-bold" for="cpf">Olá, {{ $cadastro->nome }}</div>
                            <div class="my-1 text-lg" for="cpf">Confirme seu Voto</div>
                            <div class="flex flex-col gap-2">
                                <div class="my-4 mt-8 text-lg font-bold">
                                    {{ $pergunta }}
                                </div>
                                <div>
                                    @foreach ($enquetes as $enquete)
                                        @foreach ($enquete->opcoes as $opcao)
                                            @php
                                                $cor = $loop->first ? 'bg-blue-100' : 'bg-violet-100';
                                            @endphp
                                            <div class="{{ $cor }} mb-5 flex items-center rounded border border-gray-200 ps-4 dark:border-gray-700"
                                                wire:key="opcao-{{ $opcao['opcao'] }}">
                                                <input
                                                    class="h-5 w-5 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                                                    id="bordered-radio-{{ $loop->index }}"
                                                    name="bordered-radio"
                                                    type="radio"
                                                    value="{{ $opcao['opcao'] }}"
                                                    wire:model="voto">
                                                <label
                                                    class="text-md ms-2 w-full cursor-pointer py-4 font-bold text-gray-900 dark:text-gray-300"
                                                    for="bordered-radio-{{ $loop->index }}">{{ $opcao['opcao'] }}</label>
                                            </div>
                                        @endforeach
                                    @endforeach
                                    <div class="py-1 text-sm text-red-500">
                                        @error('voto')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="block">
                                    <x-filament::button type="submit">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">Votar</span>
                                            <x-filament::loading-indicator class="h-5 w-5" wire:target="confirmarVoto"
                                                wire:loading />
                                        </div>
                                    </x-filament::button>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="flex justify-start">
                        <div class="my-1 text-lg font-bold text-green-600" for="cpf">
                            {!! $mensagemFinal !!}
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="_h-[calc(100vh-100px)] relative bg-gray-300">
        </div>
    </div>
    <script src="https://unpkg.com/imask"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            mask = new IMask(document.getElementById('cpf'), {
                mask: '000.000.000-00'
            });
        });
    </script>
</div>
