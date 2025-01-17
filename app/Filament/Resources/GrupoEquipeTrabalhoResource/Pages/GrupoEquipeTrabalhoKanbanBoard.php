<?php

namespace App\Filament\Resources\GrupoEquipeTrabalhoResource\Pages;

use App\Models\EquipeTrabalho;
use App\Models\GrupoEquipeTrabalho;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Panel;
use Filament\Resources\Pages\PageRegistration;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route as RouteFacade;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class GrupoEquipeTrabalhoKanbanBoard extends KanbanBoard
{
    protected static string $model = EquipeTrabalho::class;
    protected static string $statusEnum = GrupoEquipeTrabalho::class;

    public bool $disableEditModal = true;

    protected static string $recordStatusAttribute = 'grupo_equipe_trabalho_id';

    protected static string $recordTitleAttribute = 'nome';

    protected function records(): Collection
    {
        return EquipeTrabalho::orderBy('grupo_equipe_trabalho_id')->orderBy('nome')->get();
    }

    protected function statuses(): Collection
    {
        $arrayResult = [
            [
                'id' => 0,
                'title' => 'Sem Definição',
                'image_path' => null
            ]
        ];

        $resultGrupoEquipeTrabalho = GrupoEquipeTrabalho::query()
            ->selectRaw('id, nome as title, image_path')
            ->get()
            ->toArray();

        return collect(array_merge($arrayResult, $resultGrupoEquipeTrabalho));
    }

    public static function route(string $path): PageRegistration
    {
        return new PageRegistration(
            page: static::class,
            route: fn (Panel $panel): Route => RouteFacade::get($path, static::class)
                ->middleware(static::getRouteMiddleware($panel))
                ->withoutMiddleware(static::getWithoutRouteMiddleware($panel)),
        );
    }

    public function onStatusChanged(int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void
    {
        EquipeTrabalho::whereId($recordId)->update([
            'grupo_equipe_trabalho_id' => $status,
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->label('Criar Grupo - Equipe de Trabalho')
                ->url(route('filament.admin.resources.grupo-equipe-trabalhos.create')),
            Action::make('list')
                ->color('warning')
                ->icon('bi-list')
                ->label('Visualizar em Lista')
                ->url(route('filament.admin.resources.grupo-equipe-trabalhos.index')),
        ];
    }
}
