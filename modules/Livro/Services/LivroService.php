<?php

namespace Modules\Livro\Services;

use Illuminate\Support\Facades\DB;
use Modules\Livro\Repositories\Interfaces\LivroRepositoryInterface;
use Modules\Livro\Services\Interfaces\LivroServiceInterface;

class LivroService implements LivroServiceInterface
{

    protected $livroRepository;

    public function __construct(LivroRepositoryInterface $livroRepository)
    {
        $this->livroRepository = $livroRepository;
    }

    public function list()
    {
        return $this->livroRepository->all();
    }

    public function find($id, $param = null)
    {
        return $this->livroRepository->find($id,$param);
    }

    public function create(array $livro)
    {
        $livro['Titulo'] = $livro['Titulo'];
        $livro['Editora'] = $livro['Editora'];
        $livro['Edicao'] = $livro['Edicao'];
        $livro['AnoPublicacao'] = $livro['AnoPublicacao'];
        $livro['Valor'] = $livro['Valor'];

        DB::beginTransaction();
        $objLivro = $this->livroRepository->create($livro);

        $auxLivro = $this->find($objLivro->Codl,['with' => ['autores','assuntos']]);

        $auxLivro->autores()->attach($livro['Autores']);

        $auxLivro->assuntos()->attach($livro['Assuntos']);
        DB::commit();
        return $objLivro;
    }

    public function update(array $livro)
    {
        DB::beginTransaction();
        $update = $this->find($livro['Codl'],['with' => ['autores','assuntos']]);
        $update['Titulo'] = $livro['Titulo'];
        $update['Editora'] = $livro['Editora'];
        $update['Edicao'] = $livro['Edicao'];
        $update['AnoPublicacao'] = $livro['AnoPublicacao'];
        $update['Valor'] = $livro['Valor'];

        $update->autores()->detach($update->autores);
        $update->assuntos()->detach($update->assuntos);

        if(!empty($livro['Autores'])) {
            $update->autores()->attach($livro['Autores']);
        }
        if(!empty($livro['Assuntos'])) {
            $update->assuntos()->attach($livro['Assuntos']);
        }
        DB::commit();
        return $this->livroRepository->update($update);
    }

    public function delete($livro)
    {
        $delete = $this->find($livro['Codl'],['with' => ['autores','assuntos']]);

        $delete->autores()->detach($delete->autores);
        $delete->assuntos()->detach($delete->assuntos);


        return $this->livroRepository->delete($delete);
    }
}
