<?php

namespace Modules\Assunto\Entities;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    public $incrementing = true;

    protected $table        = 'Assunto';
    protected $primaryKey   = 'CodAs';
    public $fillable = [
        'Descricao'
    ];

    public $timestamps = false;
}
