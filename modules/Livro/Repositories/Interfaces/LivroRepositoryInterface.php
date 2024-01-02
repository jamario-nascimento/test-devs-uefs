<?php

namespace Modules\Livro\Repositories\Interfaces;

interface LivroRepositoryInterface
{
    public function all();
    public function find($id,$param);
    public function create(array $data);
    public function update($update);
    public function delete($delete);
}
