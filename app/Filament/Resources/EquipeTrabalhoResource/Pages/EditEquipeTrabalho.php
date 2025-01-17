<?php

namespace App\Filament\Resources\EquipeTrabalhoResource\Pages;

use App\Filament\Resources\EquipeTrabalhoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JoseEspinal\RecordNavigation\Traits\HasRecordNavigation;

class EditEquipeTrabalho extends EditRecord
{
    use HasRecordNavigation;

    protected static string $resource = EquipeTrabalhoResource::class;

    protected function getHeaderActions(): array
    {
        $existingActions = [
            Actions\DeleteAction::make(),
        ];

        return array_merge($existingActions, $this->getNavigationActions());
    }
}
