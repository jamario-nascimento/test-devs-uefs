<?php

namespace Modules\Autor\Controllers;

use App\Http\Controllers\Controller;

use Modules\Autor\Request\AutorRequest;
use Modules\Autor\Services\Interfaces\AutorServiceInterface;
use Exception;
use Modules\Autor\Entities\Autor;

/**
 * @OA\Info(title="Livros", version="0.1")
 */
class AutorController extends Controller
{
    protected $service;

    public function __construct(AutorServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Listagem dos dados para WEB
     */
    public function index()
    {
        try {
            $autores = $this->service->list();
            return view('autor.listar', compact('autores'));
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * Edição dos dados para WEB
     */
    public function edit($CodAu = null)
    {
        try {

            // Verifica se código foi informado.
            if (empty($CodAu)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexAutor')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Código do Autor não foi informado.');
            }

            $autor = $this->service->find($CodAu);

            // Verifica se objeto foi encontrado.
            if (empty($autor)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexAutor')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Autor não encontrado.');
            } else {
                // Monta retorno de campos para a tela.
                $dados = array(
                    'title_page'    => 'Atualizar Autor',
                    'autor'         => $autor,
                    'MANTER'        => 'Atualizar'
                );

                // Retorna para a página de edição.
                return view('autor/manter', $dados);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/autor/list",
     *     tags={"Autor"},
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
     ** path="/api/autor/create",
     *   tags={"Autor"},
     *   summary="Criar Registro",
     *   @OA\Parameter(
     *      name="Nome",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=201,description="Created"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function create(AutorRequest $request)
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
     ** path="/api/autor/update",
     *   tags={"Autor"},
     *   summary="Atualizar Registro",
     *   @OA\Parameter(
     *      name="CodAu",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *      name="Nome",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=200,description="Updated"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function update(AutorRequest $request)
    {
        try {
            if($this->service->update($request->validated())) {
                return response()->json(['message' => 'Atualizado com sucesso'], 200);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a Atualização'], 500);
        }
    }

    /**
     * @OA\Delete(
     ** path="/api/autor/delete",
     *   tags={"Autor"},
     *   summary="Excluir Registro",
     *   @OA\Parameter(
     *      name="CodAu",
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
    public function delete(AutorRequest $request)
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
