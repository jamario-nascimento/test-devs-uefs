<?php

namespace Modules\Tag\Services;

use Modules\Tag\Repositories\Interfaces\TagRepositoryInterface;
use Modules\Tag\Services\Interfaces\TagServiceInterface;

class TagService implements TagServiceInterface
{

    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function list()
    {
        return $this->tagRepository->all();
    }

    public function find($id)
    {
        return $this->tagRepository->find($id);
    }

    public function create(array $tag)
    {
        $tag['Slug'] = $tag['Slug'];
        return $this->tagRepository->create($tag);
    }

    public function update(array $tag)
    {
        $update = $this->find($tag['id']);
        $update['Slug'] = $tag['Slug'];
        return $this->tagRepository->update($update);
    }

    public function delete($tag)
    {
        $delete = $this->find($tag['id']);
        return $this->tagRepository->delete($delete);
    }
}
