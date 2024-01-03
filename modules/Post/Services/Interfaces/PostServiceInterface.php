<?php

namespace Modules\Post\Services\Interfaces;

interface PostServiceInterface
{
    public function list();
    public function find($id);
    public function create(array $data);
    public function update(array $data);
    public function delete($model);
}
