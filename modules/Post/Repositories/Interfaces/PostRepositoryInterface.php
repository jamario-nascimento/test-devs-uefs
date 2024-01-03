<?php

namespace Modules\Post\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function all();
    public function find($id,$param);
    public function create(array $data);
    public function update($update);
    public function delete($delete);
}
