<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupoEquipeTrabalho extends Model
{
    /** @use HasFactory<\Database\Factories\GrupoEquipeTrabalhoFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'grupo_equipe_trabalhos';

    protected $fillable = [
        'nome',
        'image_path'
    ];

    public function equipeTrabalho()
    {
        return $this->hasMany(EquipeTrabalho::class);
    }


}
