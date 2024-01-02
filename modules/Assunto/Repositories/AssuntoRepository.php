<?php

namespace Modules\Assunto\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Assunto\Entities\Assunto;
use Modules\Assunto\Repositories\Interfaces\AssuntoRepositoryInterface;

class AssuntoRepository extends BaseRepository implements AssuntoRepositoryInterface
{
    public function __construct(Assunto $assunto)
    {
        $this->model = $assunto;
    }

}
