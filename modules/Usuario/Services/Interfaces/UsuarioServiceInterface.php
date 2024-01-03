<?php

namespace Modules\Usuario\Services\Interfaces;

interface UsuarioServiceInterface
{
    public function list();
    public function find($id);
    public function create(array $data);
    public function update(array $data);
    public function delete($model);
}
