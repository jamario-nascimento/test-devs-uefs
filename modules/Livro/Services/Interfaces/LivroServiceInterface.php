<?php

namespace Modules\Livro\Services\Interfaces;

interface LivroServiceInterface
{
    public function list();
    public function find($id);
    public function create(array $data);
    public function update(array $data);
    public function delete($model);
}
