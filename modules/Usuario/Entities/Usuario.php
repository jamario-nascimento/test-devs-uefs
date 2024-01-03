<?php

namespace Modules\Usuario\Entities;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $incrementing = true;

    protected $table        = 'usuario';
    protected $primaryKey   = 'id';
    public $fillable = [
        'nome',
        'data_nascimento',
        'email',
    ];

    public $timestamps = false;
}
