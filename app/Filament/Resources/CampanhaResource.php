<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampanhaResource\Pages;
use App\Filament\Resources\CampanhaResource\RelationManagers;
use App\Models\Campanha;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CampanhaResource extends Resource
{
    protected static ?string $model = Campanha::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->user()->id),
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->autocomplete(false)
                    ->maxLength(255),
                Forms\Components\TextInput::make('descricao')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('URL')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\Textarea::make('informacoes')
                    ->label('Informações / mural')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\DateTimePicker::make('data_inicio')
                    ->displayFormat('d/m/Y H:i')
                    ->native(false)
                    ->required(),
                Forms\Components\DateTimePicker::make('data_fim')
                    ->native(false)
                    ->displayFormat('d/m/Y H:i')
                    ->required(),
                Forms\Components\Toggle::make('ativa')
                    ->required(),
                Forms\Components\Toggle::make('votante_cadastrado')
                    ->helperText('O votante deve estar cadastrado para votar?')
                    ->required(),
                Forms\Components\TextInput::make('votos_por_usuario')
                    ->required()
                    ->default(1)
                    ->numeric(),
                Forms\Components\Toggle::make('mostrar_resultados_apos_voto')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome'),
                Tables\Columns\TextColumn::make('data_inicio')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('data_fim')
                    ->dateTime(),
                Tables\Columns\ToggleColumn::make('ativa'),
                Tables\Columns\TextColumn::make('votos_por_usuario'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageCampanhas::route('/'),
        ];
    }
}
