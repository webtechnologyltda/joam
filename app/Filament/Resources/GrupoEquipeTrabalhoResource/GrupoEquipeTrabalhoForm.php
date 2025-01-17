<?php

namespace App\Filament\Resources\GrupoEquipeTrabalhoResource;

use App\Enums\StatusInscricaoEquipeTrabalho;
use Carbon\Carbon;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Leandrocfe\FilamentPtbrFormFields\Cep;
use Michaeld555\FilamentCroppie\Components\Croppie;

abstract class GrupoEquipeTrabalhoForm
{
    public static function getFormCreate(): array
    {
        return [
            ...self::getFormGrupoEquipeTrabalho()
        ];
    }

    public static function getFormUpdate(): array
    {
        return [
            ...self::getFormGrupoEquipeTrabalho()
        ];
    }

    public static function getFormGrupoEquipeTrabalho(): array
    {
        return [
            Section::make('Dados Grupo de Trabalho')
                ->icon('phosphor-user-list-fill')
                ->columns([
                    'default' => 1,
                    'lg' => 5,
                ])
                ->schema([
                    ...self::getFormFoto(),
                    TextInput::make('nome')
                        ->required()
                        ->columnSpan(['default' => 1, 'lg' => 5])
                        ->maxLength(255),
                ])

        ];
    }

    public static function getFormFoto(): array
    {
        return [

            Croppie::make('image_path')
                ->directory('foto-formulario-grupo-equipe-trabalho')
                ->placeholder(fn() => new HtmlString('<span><a class="text-primary-600 font-bold">Clique aqui</a></br>Para adicionar uma foto</span>'))
                ->modalTitle('Recorte e encaixe sua foto:')
                ->enableOrientation(true)
                ->modalDescription('Corte a imagem na proporção correta.')
                ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/webp'])
                ->label('Foto de Perfil')
                ->hiddenLabel()
                ->disk('public')
                ->optimize('webp')
                ->modalSize('sm')
                ->imageFormat('webp')
                ->viewportType('square')
                ->imagePreviewHeight('250')
                ->imageSize('viewport')
                ->boundaryWidth('250')
                ->boundaryHeight('250')
                ->panelAspectRatio('1:1')
                ->panelLayout('integrated')
                ->maxSize(10240)
                ->columnStart([
                    'default' => 1,
                    'lg' => 3,
                ])
                ->loadingIndicatorPosition('center')
                ->removeUploadedFileButtonPosition('top-center')
                ->uploadProgressIndicatorPosition('center')
                ->imageResizeTargetWidth(400)
                ->imageResizeTargetHeight(400),

            Actions::make([
                FormAction::make('star')
                    ->icon('heroicon-m-eye')
                    ->label('Visualizar foto')
                    ->requiresConfirmation()
                    ->visible(fn(string $operation, array $data) => $operation !== 'create')
                    ->url(fn(Model $record) => Storage::url($record->image_path), shouldOpenInNewTab: true),
            ])
                ->visibleOn(['edit', 'view'])
                ->alignCenter()
                ->columnSpanFull(),
        ];
    }
}
