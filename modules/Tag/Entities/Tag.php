<?php

namespace Modules\Tag\Entities;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $incrementing = true;
    protected $guarded = [];
    protected $table        = 'tag';
    protected $primaryKey   = 'id';
    public $fillable = [
        'Slug'
    ];

}
