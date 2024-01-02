<?php

namespace Modules\Livro\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Assunto\Entities\Assunto;
use Modules\Autor\Entities\Autor;

class Livro extends Model
{
    public $incrementing = true;
    public $timestamps = false;

    protected $table        = 'Livro';
    protected $primaryKey   = 'Codl';
    public $fillable = [
        'Titulo',
        'Editora',
        'Edicao',
        'AnoPublicacao',
        'Valor',
    ];

    public function autores() {
        return $this->belongsToMany(Autor::class,'Livro_Autor');
    }

    public function assuntos() {
        return $this->belongsToMany(Assunto::class,'Livro_Assunto');
    }


}
