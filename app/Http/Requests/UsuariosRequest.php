<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
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
            "nome" => "required",
            "telefone" => "required",
            "email" => "required|email:rfc,dns",
            "cep" => "required",
            "estado" => "required",
            "cidade" => "required",
            "bairro" => "required",
            "endereco" => "required"
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
