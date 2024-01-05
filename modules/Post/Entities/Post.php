<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Tag\Entities\Tag;

class Post extends Model
{
    public $incrementing = true;

    protected $table        = 'Post';
    protected $primaryKey   = 'id';
    public $fillable = [
        'titulo',
        'resumo',
        'conteudo',
        'usuario_id',
    ];

    public function tags() {
        return $this->belongsToMany(Tag::class,'post_tag');
    }

}
