<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosAtualizacaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "nome" => "sometimes",
            "telefone" => "sometimes",
            "email" => "sometimes|email:rfc,dns",
            "cep" => "sometimes",
            "estado" => "sometimes",
            "cidade" => "sometimes",
            "bairro" => "sometimes",
            "endereco" => "sometimes"
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => "O nome é obrigatório",
            'telefone.required' => "O telefone é obrigatório",
            'email.required' => "O email é obrigatório",
            'email.email' => "Insira um email válido",
            'cep.required' => "O cep é obrigatório",
            'estado.required' => "O estado é obrigatório",
            'cidade.required' => "O cidade é obrigatório",
            'bairro.required' => "O bairro é obrigatório",
            'endereco.required' => "O endereco é obrigatório",
        ];
    }
}
