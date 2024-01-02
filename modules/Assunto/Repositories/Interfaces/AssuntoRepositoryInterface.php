<?php

namespace Modules\Assunto\Repositories\Interfaces;

interface AssuntoRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($update);
    public function delete($delete);
}
