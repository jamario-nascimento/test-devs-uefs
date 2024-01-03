<?php

namespace Modules\Usuario\Repositories\Interfaces;

interface UsuarioRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($update);
    public function delete($delete);
}
