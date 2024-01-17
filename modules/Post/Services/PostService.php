<?php

namespace Modules\Post\Services;

use Illuminate\Support\Facades\DB;
use Modules\Post\Repositories\Interfaces\PostRepositoryInterface;
use Modules\Post\Services\Interfaces\PostServiceInterface;

class PostService implements PostServiceInterface
{

    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function list()
    {
        return $this->postRepository->all();
    }

    public function find($id, $param = null)
    {
        return $this->postRepository->find($id,$param);
    }

    public function create(array $post)
    {
        $post['titulo'] = $post['titulo'];
        $post['resumo'] = $post['resumo'];
        $post['conteudo'] = $post['conteudo'];
        $post['usuario_id'] = $post['usuario_id'];

        DB::beginTransaction();
        $objPost = $this->postRepository->create($post);
        $auxPost = $this->find($objPost->id,['with' => ['tags']]);

        $auxPost->tags()->attach($post['tags']);
        DB::commit();
        return $objPost;
    }

    public function update(array $post)
    {
        DB::beginTransaction();
        $update = $this->find($post['id'],['with' => ['tags']]);
        $update['titulo'] = $post['titulo'];
        $update['resumo'] = $post['resumo'];
        $update['conteudo'] = $post['conteudo'];
        $update['usuario_id'] = $post['usuario_id'];

        $update->tags()->detach($update->tags);

        if(!empty($post['tags'])) {
            $update->tags()->attach($post['tags']);
        }
        DB::commit();
        return $this->postRepository->update($update);
    }

    public function delete($post)
    {
        $delete = $this->find($post['id'],['with' => ['tags']]);

        $delete->tags()->detach($delete->tags);


        return $this->postRepository->delete($delete);
    }
}
