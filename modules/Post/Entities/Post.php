<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Tag\Entities\Tag;
use Modules\Usuario\Entities\Usuario;

class Post extends Model
{
    public $incrementing = true;

    protected $table        = 'Post';
    protected $primaryKey   = 'id';
    public $fillable = [
        'titulo',
        'resumo',
        'conteudo',
    ];

    public function tags() {
        return $this->belongsTo(Tag::class);
    }

    public function usuarios() {
        return $this->belongsTo(Usuario::class);
    }


}
