<?php

namespace Modules\Usuario\Request;

use Modules\Usuario\Rule\ExcludeUsuarioRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Usuario\Services\Interfaces\UsuarioServiceInterface;

class UsuarioRequest extends FormRequest
{
    protected $service;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(UsuarioServiceInterface $service)
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
        //$this['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $this['cpf_cnpj']);
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
            'nome' => [
                'required',
                'max:100',
            ],
            'data_nascimento' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                'max:100',
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
                    'unique:Usuario,id,' . $this->CodAs . ',id',
                    'exists:Usuario,id',
                    'max:11'
                ],
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'id' => new ExcludeUsuarioRule(),
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
            'id'             => 'Identificador',
            'nome'         => 'Nome'
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
            'id.required'               => 'O campo Identificador é obrigatório',
            'id.exists'                 => 'O Identificador não foi encontrado',
            'nome.required'             => 'O campo Nome é obrigatório',
            'email.required'            => 'O campo E-mail é obrigatório',
            'email.email'               => 'O campo E-mail deve ser válido',
            'data_nascimento.required'  => 'O campo Data de Nascimento é obrigatório'
        ];
    }
}
