<?php

namespace Modules\Tag\Services;

use Modules\Tag\Repositories\Interfaces\TagRepositoryInterface;
use Modules\Tag\Services\Interfaces\TagServiceInterface;

class TagService implements TagServiceInterface
{

    protected $TagRepository;

    public function __construct(TagRepositoryInterface $TagRepository)
    {
        $this->TagRepository = $TagRepository;
    }

    public function list()
    {
        return $this->TagRepository->all();
    }

    public function find($id)
    {
        return $this->TagRepository->find($id);
    }

    public function create(array $Tag)
    {
        $Tag['Slug'] = $Tag['Slug'];
        return $this->TagRepository->create($Tag);
    }

    public function update(array $Tag)
    {
        $update = $this->find($Tag['id']);
        $update['Slug'] = $Tag['Slug'];
        return $this->TagRepository->update($update);
    }

    public function delete($Tag)
    {
        $delete = $this->find($Tag['id']);
        return $this->TagRepository->delete($delete);
    }
}
