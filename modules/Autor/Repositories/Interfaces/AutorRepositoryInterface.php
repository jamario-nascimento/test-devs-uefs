<?php

namespace Modules\Autor\Repositories\Interfaces;

interface AutorRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($update);
    public function delete($delete);
}
