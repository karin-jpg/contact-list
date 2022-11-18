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
            "endereco" => "required",
            "endereco_numero" => "number"
        ];
    }
}
