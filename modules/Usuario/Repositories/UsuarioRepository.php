<?php

namespace Modules\Usuario\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Usuario\Entities\Usuario;
use Modules\Usuario\Repositories\Interfaces\UsuarioRepositoryInterface;

class UsuarioRepository extends BaseRepository implements UsuarioRepositoryInterface
{
    public function __construct(Usuario $usuario)
    {
        $this->model = $usuario;
    }

}
