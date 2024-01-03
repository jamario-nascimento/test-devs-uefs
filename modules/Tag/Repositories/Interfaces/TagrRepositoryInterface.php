<?php

namespace Modules\Tag\Repositories\Interfaces;

interface TagRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($update);
    public function delete($delete);
}
