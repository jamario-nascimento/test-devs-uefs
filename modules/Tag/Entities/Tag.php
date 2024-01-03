<?php

namespace Modules\Tag\Entities;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $incrementing = true;
    public $timestamps = false;

    protected $table        = 'Tag';
    protected $primaryKey   = 'id';
    public $fillable = [
        'Slug'
    ];

}
