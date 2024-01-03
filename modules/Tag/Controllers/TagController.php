<?php

namespace Modules\Tag\Controllers;

use App\Http\Controllers\Controller;

use Modules\Tag\Request\TagRequest;
use Modules\Tag\Services\Interfaces\TagServiceInterface;
use Exception;
use Modules\Tag\Entities\Tag;


class TagController extends Controller
{
    protected $service;

    public function __construct(TagServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Listagem dos dados para WEB
     */
    public function index()
    {
        try {
            $tags = $this->service->list();
            return view('tag.listar', compact('tags'));
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * Edição dos dados para WEB
     */
    public function edit($id = null)
    {
        try {

            // Verifica se id foi informado.
            if (empty($id)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexTag')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Id do Tag não foi informado.');
            }

            $tag = $this->service->find($id);

            // Verifica se objeto foi encontrado.
            if (empty($tag)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexTag')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Tag não encontrado.');
            } else {
                // Monta retorno de campos para a tela.
                $dados = array(
                    'title_page'    => 'Atualizar Tag',
                    'tag'         => $tag,
                    'MANTER'        => 'Atualizar'
                );

                // Retorna para a página de edição.
                return view('tag/manter', $dados);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/tag/list",
     *     tags={"tag"},
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
     ** path="/api/tag/create",
     *   tags={"tag"},
     *   summary="Criar Registro",
     *   @OA\Parameter(
     *      name="slug",
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
    public function create(TagRequest $request)
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
     ** path="/api/tag/update",
     *   tags={"tag"},
     *   summary="Atualizar Registro",
     *   @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *      name="Slug",
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
    public function update(TagRequest $request)
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
     ** path="/api/tag/delete",
     *   tags={"tag"},
     *   summary="Excluir Registro",
     *   @OA\Parameter(
     *      name="id",
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
    public function delete(TagRequest $request)
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
