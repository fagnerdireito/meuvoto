<?php

namespace App\Filament\Imports;

use App\Models\Cadastro;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class CadastroImporter extends Importer
{
    protected static ?string $model = Cadastro::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nome')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('matricula')
                ->rules(['max:255']),
            ImportColumn::make('cpf')
                ->requiredMapping()
                ->castStateUsing(function (string $state): ?string {
                    if (blank($state)) {
                        return null;
                    }

                    return preg_replace('/[^0-9.]/', '', $state);
                })
                ->rules(['required', 'max:14']),
            ImportColumn::make('email')
                ->rules(['max:255']),
            ImportColumn::make('celular')
                ->rules(['max:255']),
            ImportColumn::make('endereco')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Cadastro
    {
        // return Cadastro::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Cadastro();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your cadastro import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
