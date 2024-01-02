<?php

namespace Modules\Assunto\Request;

use Modules\Assunto\Rule\ExcludeAssuntoRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Assunto\Services\Interfaces\AssuntoServiceInterface;

class AssuntoRequest extends FormRequest
{
    protected $service;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(AssuntoServiceInterface $service)
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
            'Descricao' => [
                'required',
                'max:20',
            ],
        ];

        // create
        if ($this->route()->getActionMethod() == 'create') {
            return $rules_default;
        }
        // update
        elseif ($this->route()->getActionMethod() == 'update') {
            $rules_update = [
                'CodAs' => [
                    'required',
                    'unique:Assunto,CodAs,' . $this->CodAs . ',CodAs',
                    'exists:Assunto,CodAs',
                    'max:11'
                ],
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'CodAs' => new ExcludeAssuntoRule(),
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
            'CodAs'             => 'Identificador',
            'Descricao'         => 'Descrição'
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
            'CodAs.required'            => 'O campo Identificador é obrigatório',
            'CodAs.exists'            => 'O Identificador não foi encontrado',
            'Descricao.required'        => 'O campo Descrição é obrigatório',
        ];
    }
}
