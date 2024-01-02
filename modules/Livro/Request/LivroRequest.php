<?php

namespace Modules\Livro\Request;

use Modules\Livro\Rule\ExcludeLivroRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Livro\Services\Interfaces\LivroServiceInterface;

class LivroRequest extends FormRequest
{
    protected $service;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(LivroServiceInterface $service)
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
        $value = str_replace('.','',$this['Valor']);
        $value = str_replace(',','.',$value);
        $this['Valor'] = $value;
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
            'Titulo' => [
                'required',
                'max:40',
            ],
            'Editora' => [
                'required',
                'max:40',
            ],
            'Edicao' => [
                'required',
                'max:11',
            ],
            'AnoPublicacao' => [
                'required',
                'max:4',
            ],
            'Valor' => [
                'required',
                'min:0',
            ],
            'Autores' => [
                'min:0',
            ],
            'Assuntos' => [
                'min:0',
            ],
        ];

        // create
        if ($this->route()->getActionMethod() == 'create') {
            return $rules_default;
        }
        // update
        elseif ($this->route()->getActionMethod() == 'update') {
            $rules_update = [
                'Codl' => [
                    'required',
                    'unique:Livro,Codl,' . $this->Codl . ',Codl',
                    'exists:Livro,Codl',
                    'max:11'
                ],
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'Codl' => new ExcludeLivroRule(),
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
            'Codl'             => 'Identificador',
            'Titulo'           => 'Título',
            'Editora'          => 'Editora',
            'Edicao'           => 'Edicao',
            'AnoPublicacao'    => 'AnoPublicacao',
            'Valor'            => 'Valor',
            'Autores'          => 'Autores',
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
            'Codl.required'            => 'O campo Identificador é obrigatório',
            'Codl.exists'              => 'O Identificador não foi encontrado',
            'Titulo.required'          => 'O campo Título é obrigatório',
            'Editora.required'         => 'O campo Editora é obrigatório',
            'Edicao.required'          => 'O campo Edição é obrigatório',
            'AnoPublicacao.required'   => 'O campo Ano de Publicação é obrigatório',
            'Valor.required'           => 'O campo Valor é obrigatório',
        ];
    }
}
