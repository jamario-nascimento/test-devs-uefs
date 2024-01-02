<?php

namespace Modules\Autor\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Livro\Entities\Livro;

class Autor extends Model
{
    public $incrementing = true;
    public $timestamps = false;

    protected $table        = 'Autor';
    protected $primaryKey   = 'CodAu';
    public $fillable = [
        'Nome'
    ];

    public function livros() {
        return $this->belongsToMany(Livro::class);
    }


}
