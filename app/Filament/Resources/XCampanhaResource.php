<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Campanha;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CampanhaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CampanhaResource\RelationManagers;

class CampanhaResource_ extends Resource
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
                Repeater::make('enquetes')
                    ->columnSpanFull()
                    ->relationship('enquetes')
                    ->schema([
                        Forms\Components\TextInput::make('pergunta')
                            ->required()
                            ->maxLength(255),
                        Repeater::make('opcoes')
                            ->schema([
                                Forms\Components\TextInput::make('opcao')
                                    ->required()
                                    ->maxLength(255),
                            ])
                    ])
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
                // acessar url slug
                Tables\Actions\Action::make('acessar')
                    ->url(fn(Campanha $record) => route('campanha.show', $record->slug))
                    ->openUrlInNewTab(),
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
