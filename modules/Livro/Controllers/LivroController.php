<?php

namespace Modules\Livro\Controllers;

use App\Http\Controllers\Controller;

use Modules\Livro\Request\LivroRequest;
use Modules\Livro\Services\Interfaces\LivroServiceInterface;
use Exception;
use Modules\Assunto\Services\Interfaces\AssuntoServiceInterface;
use Modules\Autor\Services\Interfaces\AutorServiceInterface;

class LivroController extends Controller
{
    protected $service;
    protected $serviceAutor;
    protected $serviceAssunto;

    public function __construct(LivroServiceInterface $service,
                                AutorServiceInterface $serviceAutor,
                                AssuntoServiceInterface $serviceAssunto)
    {
        $this->service = $service;
        $this->serviceAutor = $serviceAutor;
        $this->serviceAssunto = $serviceAssunto;
    }

    /**
     * Listagem dos dados para WEB
     */
    public function index()
    {
        try {
            $livros = $this->service->list();
            return view('livro.listar', compact('livros'));
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * Cadastro dos dados para WEB
     */
    public function register()
    {
        try {
            $autores = $this->serviceAutor->list();

            $assuntos = $this->serviceAssunto->list();

            // Monta retorno de campos para a tela.
            $dados = array(
                'title_page'        => 'Cadastrar Livro',
                'livro'             => null,
                'autores'           => $autores,
                'assuntos'          => $assuntos,
                'listAutores'       => [],
                'listAssuntos'      => [],
                'MANTER'            => 'Cadastrar'
            );

            // Retorna para a página de edição.
            return view('livro/manter', $dados);

        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * Edição dos dados para WEB
     */
    public function edit($CodAl = null)
    {
        try {

            // Verifica se código foi informado.
            if (empty($CodAl)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexLivro')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Código do Livro não foi informado.');
            }

            $livro = $this->service->find($CodAl,['with' => 'autores']);

            // Verifica se objeto foi encontrado.
            if (empty($livro)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexLivro')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Livro não encontrado.');
            } else {
                // Monta retorno de campos para a tela.
                $listAutores = [];
                foreach($livro->autores as $autor){
                    $listAutores[] = $autor->CodAu;
                }

                $listAssuntos = [];
                foreach($livro->assuntos as $assunto){
                    $listAssuntos[] = $assunto->CodAs;
                }

                $autores = $this->serviceAutor->list();

                $assuntos = $this->serviceAssunto->list();

                $dados = array(
                    'title_page'        => 'Atualizar Livro',
                    'livro'             => $livro,
                    'autores'           => $autores,
                    'assuntos'          => $assuntos,
                    'listAutores'       => $listAutores,
                    'listAssuntos'      => $listAssuntos,
                    'MANTER'            => 'Atualizar'
                );

                // Retorna para a página de edição.
                return view('livro/manter', $dados);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/livro/list",
     *     tags={"Livro"},
     *     summary="Listar os Registros",
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response=500,description="Validate Error"),
     *     @OA\MediaType(mediaType="application/json")
     * )
     */
    public function list()
    {
        try {
            return $this->service->list();
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem'], 500);
        }
    }

    /**
     * @OA\Post(
     ** path="/api/livro/create",
     *   tags={"Livro"},
     *   summary="Criar Registro",
     *   @OA\Parameter(
     *      name="Titulo",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="Editora",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="Edicao",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *      name="AnoPublicacao",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="Valor",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="number",format="decimal")
     *   ),
     *   @OA\Response(response=201,description="Created"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function create(LivroRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar o cadastro'], 500);
        }
    }

    /**
     * @OA\Put(
     ** path="/api/livro/update",
     *   tags={"Livro"},
     *   summary="Atualizar Registro",
     *   @OA\Parameter(
     *      name="Codl",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *      name="Titulo",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="Editora",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="Edicao",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *      name="AnoPublicacao",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="Valor",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="number",format="decimal")
     *   ),
     *   @OA\Response(response=200,description="Updated"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function update(LivroRequest $request)
    {
        try {
            if($this->service->update($request->validated())) {
                return response()->json(['message' => 'Atualizado com sucesso'], 200);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a edição'], 500);
        }
    }

    /**
     * @OA\Delete(
     ** path="/api/livro/delete",
     *   tags={"Livro"},
     *   summary="Excluir Registro",
     *   @OA\Parameter(
     *      name="Codl",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200,description="Deleted"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function delete(LivroRequest $request)
    {
        try {
            if($this->service->delete($request->validated())) {
                return response()->json(['message' => 'Excluído com sucesso'], 200);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a exclusão'], 500);
        }
    }
}
