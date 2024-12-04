<?php

namespace App\Filament\Resources;

use App\Filament\Imports\CadastroImporter;
use App\Filament\Resources\CadastroResource\Pages;
use App\Filament\Resources\CadastroResource\RelationManagers;
use App\Models\Cadastro;
use Filament\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction as ActionsImportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CadastroResource extends Resource
{
    protected static ?string $model = Cadastro::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('matricula')
                    ->maxLength(255),
                Forms\Components\TextInput::make('cpf')
                    ->maxLength(11),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('celular')
                    ->maxLength(20),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matricula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('celular')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                ActionsImportAction::make()
                    ->label('Importar')
                    ->importer(CadastroImporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCadastros::route('/'),
        ];
    }
}
