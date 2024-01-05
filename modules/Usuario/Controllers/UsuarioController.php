<?php

namespace Modules\Usuario\Controllers;

use App\Http\Controllers\Controller;

use Modules\Usuario\Request\UsuarioRequest;
use Modules\Usuario\Services\Interfaces\UsuarioServiceInterface;
use Exception;

class UsuarioController extends Controller
{
    protected $service;

    public function __construct(UsuarioServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Listagem dos dados para WEB
     */
    public function index()
    {
        try {
            $usuarios = $this->service->list();
            return view('usuario.listar', compact('usuarios'));
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

            // Verifica se código foi informado.
            if (empty($id)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexUsuario')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Código do Usuario não foi informado.');
            }

            $usuario = $this->service->find($id);

            // Verifica se objeto foi encontrado.
            if (empty($usuario)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexUsuario')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Usuario não encontrado.');
            } else {
                // Monta retorno de campos para a tela.
                $dados = array(
                    'title_page'    => 'Atualizar Usuario',
                    'usuario'         => $usuario,
                    'MANTER'        => 'Atualizar'
                );

                // Retorna para a página de edição.
                return view('usuario/manter', $dados);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/Usuario/list",
     *     tags={"usuario"},
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
     ** path="/api/usuario/create",
     *   tags={"usuario"},
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
    public function create(UsuarioRequest $request)
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
     ** path="/api/usuario/update",
     *   tags={"usuario"},
     *   summary="Atualizar Registro",
     *   @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *      name="nome",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     * *   @OA\Parameter(
     *      name="data_nascimento",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="date")
     *   ),
     * *   @OA\Parameter(
     *      name="email",
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
    public function update(UsuarioRequest $request)
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
     ** path="/api/usuario/delete",
     *   tags={"usuario"},
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
    public function delete(UsuarioRequest $request)
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
