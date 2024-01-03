<?php

namespace Modules\Post\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Post\Entities\Post;
use Modules\Post\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

}
