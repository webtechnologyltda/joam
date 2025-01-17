<?php

namespace App\Filament\Resources\GrupoEquipeTrabalhoResource\RelationManagers;

use App\Filament\Resources\EquipeTrabalhoResource\EquipeTrabalhoTable;
use App\Models\EquipeTrabalho;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AssociateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Michaeld555\FilamentCroppie\Components\Croppie;

class EquipeTrabalhoRelationManager extends RelationManager
{
    protected static string $relationship = 'equipeTrabalho';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nome')
            ->columns(EquipeTrabalhoTable::getColumns())
            ->filters([
                //
            ])
            ->headerActions([
                AssociateAction::make()
                    ->recordSelectOptionsQuery(fn(Builder $query) => $query->whereNull('grupo_equipe_trabalho_id'))
                    ->multiple()
                    ->form(fn(AssociateAction $action): array => [
                        $action->getRecordSelect()
                            ->hint('Caso o nome da pessoa não esteja na lista, possivelmente esta pessoa já está
                            em um grupo de equipe de trabalho.'),
                    ])
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\Action::make('Visualizar')
                    ->icon('heroicon-s-eye')
                    ->url(fn(EquipeTrabalho $record) => route('filament.admin.resources.equipe-trabalhos.edit', $record->id)),
                Tables\Actions\DissociateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
