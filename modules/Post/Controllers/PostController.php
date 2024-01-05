<?php

namespace Modules\Post\Controllers;

use App\Http\Controllers\Controller;

use Modules\Post\Request\PostRequest;
use Modules\Post\Services\Interfaces\PostServiceInterface;
use Exception;
use Modules\Usuario\Services\Interfaces\UsuarioServiceInterface;
use Modules\Tag\Services\Interfaces\TagServiceInterface;
/**
 * @OA\Info(title="Post", version="0.1")
 */
class PostController extends Controller
{
    protected $service;
    protected $serviceTag;
    protected $serviceUsuario;

    public function __construct(PostServiceInterface $service,
                                TagServiceInterface $serviceTag,
                                UsuarioServiceInterface $serviceUsuario)
    {
        $this->service = $service;
        $this->serviceTag = $serviceTag;
        $this->serviceUsuario = $serviceUsuario;
    }

    /**
     * Listagem dos dados para WEB
     */
    public function index()
    {
        try {
            $posts = $this->service->list();
            return view('post.listar', compact('posts'));
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
            $tags = $this->serviceTag->list();

            $usuarios = $this->serviceUsuario->list();

            // Monta retorno de campos para a tela.
            $dados = array(
                'title_page'    => 'Cadastrar Post',
                'titulo'        => null,
                'resumo'        => null,
                'conteudo'      => null,
                'tags'           => $tags,
                'usuarios'      => $usuarios,
                'listTags'       => [],
                'MANTER'        => 'Cadastrar'
            );

            // Retorna para a página de edição.
            return view('post/manter', $dados);

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
                return redirect()->route('indexPost')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Código do post não foi informado.');
            }

            $post = $this->service->find($id,['with' => 'tags']);

            // Verifica se objeto foi encontrado.
            if (empty($post)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexPost')
                    ->with('class', 'alert-warning')
                    ->with('message', 'post não encontrado.');
            } else {
                // Monta retorno de campos para a tela.
                $listTags = [];
                foreach($post->tags as $tag){
                    $listTags[] = $tag->id;
                }

                $listUsuarios = [];
                foreach($post->usuarios as $usuario){
                    $listUsuarios[] = $usuario->id;
                }

                $tags = $this->serviceTag->list();

                $usuarios = $this->serviceUsuario->list();

                $dados = array(
                    'title_page'     => 'Atualizar post',
                    'titulo'         => $usuario->titulo,
                    'resumo'         => $usuario->resumo,
                    'conteudo'       => $usuario->conteudo,
                    'tags'           => $tags,
                    'usuarios'          => $usuarios,
                    'listTags'       => $listTags,
                    'MANTER'            => 'Atualizar'
                );

                // Retorna para a página de edição.
                return view('post/manter', $dados);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/post/list",
     *     tags={"Post"},
     *     summary="Listar os Registros",
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response=500,description="Validate Error"),
     *     @OA\MediaType(mediaType="application/json")
     * )
     **/
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
     ** path="/api/post/create",
     *   tags={"Post"},
     *   summary="Criar Registro",
     *   @OA\Parameter(
     *      name="titulo",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="resumo",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="conteudo",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="usuario_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=201,description="Created"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function create(PostRequest $request)
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
     ** path="/api/post/update",
     *   tags={"Post"},
     *   summary="Atualizar Registro",
     *   @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *      name="titulo",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="resumo",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="conteudo",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="usuario_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200,description="Updated"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function update(PostRequest $request)
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
     ** path="/api/post/delete",
     *   tags={"Post"},
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
    public function delete(PostRequest $request)
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
