<?php

namespace App\Filament\Resources\GrupoEquipeTrabalhoResource\Pages;

use App\Filament\Resources\GrupoEquipeTrabalhoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JoseEspinal\RecordNavigation\Traits\HasRecordsList;

class ListGrupoEquipeTrabalhos extends ListRecords
{
    use HasRecordsList;
    protected static string $resource = GrupoEquipeTrabalhoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('kanban')
                ->color('warning')
                ->icon('bi-kanban-fill')
                ->label('Visualizar em cards')
                ->url(route('filament.admin.resources.grupo-equipe-trabalhos.view')),
        ];
    }
}
