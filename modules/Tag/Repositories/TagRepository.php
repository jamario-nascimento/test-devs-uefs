<?php

namespace Modules\Tag\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Tag\Entities\Tag;
use Modules\Tag\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

}
