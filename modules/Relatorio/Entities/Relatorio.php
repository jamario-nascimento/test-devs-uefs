<?php

namespace Modules\Relatorio\Entities;

use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $table        = 'relatorioview';

}
