<?php

namespace Modules\Usuario\Services;

use Modules\Usuario\Repositories\Interfaces\UsuarioRepositoryInterface;
use Modules\Usuario\Services\Interfaces\UsuarioServiceInterface;

class UsuarioService implements UsuarioServiceInterface
{

    protected $usuarioRepository;

    public function __construct(UsuarioRepositoryInterface $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function list()
    {
        return $this->usuarioRepository->all();
    }

    public function find($id)
    {
        return $this->usuarioRepository->find($id);
    }

    public function create(array $usuario)
    {
        $usuario['Descricao'] = $usuario['Descricao'];
        return $this->usuarioRepository->create($usuario);
    }

    public function update(array $usuario)
    {
        $update = $this->find($usuario['CodAs']);
        $update['Descricao'] = $usuario['Descricao'];
        return $this->usuarioRepository->update($update);
    }

    public function delete($usuario)
    {
        $delete = $this->find($usuario['CodAs']);
        return $this->usuarioRepository->delete($delete);
    }
}
