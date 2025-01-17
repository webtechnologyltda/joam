<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GrupoEquipeTrabalhoResource\GrupoEquipeTrabalhoForm;
use App\Filament\Resources\GrupoEquipeTrabalhoResource\Pages;
use App\Filament\Resources\GrupoEquipeTrabalhoResource\RelationManagers;
use App\Models\GrupoEquipeTrabalho;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GrupoEquipeTrabalhoResource extends Resource
{
    protected static ?string $model = GrupoEquipeTrabalho::class;

    protected static ?string $navigationIcon = 'eos-category';

    protected static ?string $label = 'Grupo - Equipe de Trabalho';

    protected static ?string $pluralLabel = 'Grupos - Equipe de Trabalho';

    protected static ?string $navigationGroup = 'Gestão Acampamento';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(GrupoEquipeTrabalhoForm::getFormUpdate());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->square()
                    ->extraImgAttributes(['class' => 'rounded-xl'])
                    ->label('Imagem'),

                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->label('Criado em'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->label('Atualizado em'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('deleted_at')
                    ->modifyQueryUsing(fn (Builder $query) => $query->withTrashed())
                    ->label('Excluído'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\EquipeTrabalhoRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrupoEquipeTrabalhos::route('/'),
            'create' => Pages\CreateGrupoEquipeTrabalho::route('/create'),
            'edit' => Pages\EditGrupoEquipeTrabalho::route('/{record}/edit'),
            'view' => Pages\GrupoEquipeTrabalhoKanbanBoard::route('/cards-view'),
        ];
    }
}
