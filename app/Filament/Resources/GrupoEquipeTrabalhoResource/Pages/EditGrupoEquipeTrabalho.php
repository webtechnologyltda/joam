<?php

namespace App\Filament\Resources\GrupoEquipeTrabalhoResource\Pages;

use App\Filament\Resources\GrupoEquipeTrabalhoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JoseEspinal\RecordNavigation\Traits\HasRecordNavigation;

class EditGrupoEquipeTrabalho extends EditRecord
{
    use HasRecordNavigation;

    protected static string $resource = GrupoEquipeTrabalhoResource::class;

    protected function getHeaderActions(): array
    {
        $existingActions = [
            Actions\DeleteAction::make()
            ->before(fn($record) => $record->equipeTrabalho()->update(['grupo_equipe_trabalho_id' => null])),
        ];

        return array_merge($existingActions, $this->getNavigationActions());
    }
}
