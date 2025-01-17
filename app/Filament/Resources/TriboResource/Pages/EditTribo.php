<?php

namespace App\Filament\Resources\TriboResource\Pages;

use App\Filament\Resources\TriboResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JoseEspinal\RecordNavigation\Traits\HasRecordNavigation;

class EditTribo extends EditRecord
{
    use HasRecordNavigation;

    protected static string $resource = TriboResource::class;

    protected function getHeaderActions(): array
    {
        $existingActions = [
            Actions\DeleteAction::make(),
        ];

        return array_merge($existingActions, $this->getNavigationActions());
    }
}
