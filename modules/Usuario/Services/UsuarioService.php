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
        $usuario['nome'] = $usuario['nome'];
        $usuario['data_nascimento'] = $usuario['data_nascimento'];
        $usuario['email'] = $usuario['email'];
        return $this->usuarioRepository->create($usuario);
    }

    public function update(array $usuario)
    {
        $update = $this->find($usuario['id']);
        $update['nome'] = $usuario['nome'];
        $update['data_nascimento'] = $usuario['data_nascimento'];
        $update['email'] = $usuario['email'];
        return $this->usuarioRepository->update($update);
    }

    public function delete($usuario)
    {
        $delete = $this->find($usuario['id']);
        return $this->usuarioRepository->delete($delete);
    }
}
