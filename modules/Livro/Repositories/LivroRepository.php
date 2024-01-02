<?php

namespace Modules\Livro\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Livro\Entities\Livro;
use Modules\Livro\Repositories\Interfaces\LivroRepositoryInterface;

class LivroRepository extends BaseRepository implements LivroRepositoryInterface
{
    public function __construct(Livro $livro)
    {
        $this->model = $livro;
    }

}
