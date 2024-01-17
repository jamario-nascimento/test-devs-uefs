<?php

namespace Modules\Post\Entities;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Tag\Entities\Tag;
use Modules\Usuario\Entities\Usuario;

class Post extends Model
{
    public $incrementing = true;
    protected $guarded = [];
    protected $table        = 'Post';
    protected $primaryKey   = 'id';
    public $fillable = [
        'titulo',
        'resumo',
        'conteudo',
        'usuario_id',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PostFactory::new();
    }
}
