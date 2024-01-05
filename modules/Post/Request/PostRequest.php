<?php

namespace Modules\Post\Request;

use Modules\Post\Rule\ExcludePostRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Post\Services\Interfaces\PostServiceInterface;

class PostRequest extends FormRequest
{
    protected $service;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(PostServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        // Remove caracteres especiais dos campos, deixando somente números.
        // $value = str_replace('.','',$this['Valor']);
        // $value = str_replace(',','.',$value);
        // $this['Valor'] = $value;
    }

    /**
     * Rules
     */
    public function rules()
    {
        // Inicializa variável.
        $rules_default = array();
        $rules_update = array();
        $rules_destroy = array();

        // Regras de criação e edição
        $rules_default = [
            'titulo' => [
                'required',
                'max:100',
            ],
            'resumo' => [
                'required',
                'max:200',
            ],
            'conteudo' => [
                'required',
            ],
            'tags' => [
                'min:0',
            ],
            'usuario_id' => [
                'required',
            ],
        ];

        // create
        if ($this->route()->getActionMethod() == 'create') {
            return $rules_default;
        }
        // update
        elseif ($this->route()->getActionMethod() == 'update') {
            $rules_update = [
                'id' => [
                    'required',
                    'unique:Post,id,' . $this->id . ',id',
                    'exists:Post,id',
                    'max:11'
                ],
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'id' => new ExcludePostRule(),
            ];

            return $rules_destroy;
        }

        // merg.
        return array_merge($rules_default, $rules_update, $rules_destroy);
    }
    // Fim do método rules.

    /**
     * Validate
     */
    public function validated(): array
    {
        $attributes = parent::validated();
        return $attributes;
    }

    /**
     * Return the friendly field name.
     *
     * @return array
     */
    public function attributes()
    {
        $result = [
            'id'            => 'Identificador',
            'titulo'        => 'Título',
            'resumo'        => 'Resumo',
            'conteudo'      => 'Conteúdo',
            'tags'          => 'Tags',
            'usuario_id'    => 'Autor',
        ];

        return $result;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required'           => 'O campo Identificador é obrigatório',
            'id.exists'             => 'O Identificador não foi encontrado',
            'titulo.required'       => 'O campo Título é obrigatório',
            'resumo.required'       => 'O campo Resumo é obrigatório',
            'conteudo.required'     => 'O campo Conteúdo é obrigatório',
            'tags.required'         => 'O campo Tags é obrigatório',
            'usuario_id.required'      => 'O campo Autor é obrigatório',
        ];
    }
}
