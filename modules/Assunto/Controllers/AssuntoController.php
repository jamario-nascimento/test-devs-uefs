<?php

namespace Modules\Assunto\Controllers;

use App\Http\Controllers\Controller;

use Modules\Assunto\Request\AssuntoRequest;
use Modules\Assunto\Services\Interfaces\AssuntoServiceInterface;
use Exception;

class AssuntoController extends Controller
{
    protected $service;

    public function __construct(AssuntoServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Listagem dos dados para WEB
     */
    public function index()
    {
        try {
            $assuntos = $this->service->list();
            return view('assunto.listar', compact('assuntos'));
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * Edição dos dados para WEB
     */
    public function edit($CodAs = null)
    {
        try {

            // Verifica se código foi informado.
            if (empty($CodAs)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexAssunto')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Código do Assunto não foi informado.');
            }

            $assunto = $this->service->find($CodAs);

            // Verifica se objeto foi encontrado.
            if (empty($assunto)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexAssunto')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Assunto não encontrado.');
            } else {
                // Monta retorno de campos para a tela.
                $dados = array(
                    'title_page'    => 'Atualizar Assunto',
                    'assunto'         => $assunto,
                    'MANTER'        => 'Atualizar'
                );

                // Retorna para a página de edição.
                return view('assunto/manter', $dados);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/assunto/list",
     *     tags={"Assunto"},
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
     ** path="/api/assunto/create",
     *   tags={"Assunto"},
     *   summary="Criar Registro",
     *   @OA\Parameter(
     *      name="Descricao",
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
    public function create(AssuntoRequest $request)
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
     ** path="/api/assunto/update",
     *   tags={"Assunto"},
     *   summary="Atualizar Registro",
     *   @OA\Parameter(
     *      name="CodAs",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *      name="Descricao",
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
    public function update(AssuntoRequest $request)
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
     ** path="/api/assunto/delete",
     *   tags={"Assunto"},
     *   summary="Excluir Registro",
     *   @OA\Parameter(
     *      name="CodAs",
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
    public function delete(AssuntoRequest $request)
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
