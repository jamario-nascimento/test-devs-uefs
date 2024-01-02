<?php

namespace Modules\Autor\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Autor\Entities\Autor;
use Modules\Autor\Repositories\Interfaces\AutorRepositoryInterface;

class AutorRepository extends BaseRepository implements AutorRepositoryInterface
{
    public function __construct(Autor $autor)
    {
        $this->model = $autor;
    }

}
