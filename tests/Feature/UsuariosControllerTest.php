<?php

namespace tests\Controller;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;


class UsuariosControllerTests extends TestCase
{

	use RefreshDatabase;


    public function criar_usuario()
    {
        $newUserData = [
            "nome"=> "Teste",
            "telefone"=> "12999999999",
            "email"=> "test@gmail.com",
            "cep"=> "11111111",
            "estado"=> "estado teste",
            "cidade"=> "cidade teste",
            "bairro"=> "bairro teste",
            "endereco"=> "Rua teste",
            "endereco_numero"=> "0"
        ];

        $this->call('POST', 'api/usuarios', $newUserData);
    }

    public function test_recuperacao_de_usuarios_da_agenda()
    {
        $this->criar_usuario();

        $this->json('GET', 'api/usuarios', ['Accept' => 'application/json', 'Content-type' => 'application/json'])
        ->assertStatus(200)
        ->assertJsonStructure([
            'usuarios' => [[
                "id",
                "nome",
                "telefone",
                "email",
                "cep",
                "estado",
                "cidade",
                "bairro",
                "endereco",
                "endereco_numero",
                "updated_at",
                "created_at"
            ]]
        ]);
    }

    public function test_cadastro_de_usuario_na_agenda_com_resposta_de_sucesso()
    {

        $newUserData = [
            "nome"=> "Teste",
            "telefone"=> "12999999999",
            "email"=> "test@gmail.com",
            "cep"=> "11111111",
            "estado"=> "estado teste",
            "cidade"=> "cidade teste",
            "bairro"=> "bairro teste",
            "endereco"=> "Rua teste",
            "endereco_numero"=> "0"
        ];

        $this->json('POST', 'api/usuarios', $newUserData, ['Accept' => 'application/json', 'Content-type' => 'application/json'])
        ->assertStatus(201)
        ->assertJsonCount(12, 'usuario')
        ->assertJsonStructure([
            'message',
            'usuario' => [
                "nome",
                "telefone",
                "email",
                "cep",
                "estado",
                "cidade",
                "bairro",
                "endereco",
                "endereco_numero",
                "updated_at",
                "created_at",
                "id"
            ],
        ]);

    }

    public function test_cadastro_de_usuario_na_agenda_com_resposta_de_erro()
    {

        $newUserData = [
            "nome"=> "",
            "telefone"=> "12999999999",
            "email"=> "test@gmail.com",
            "cep"=> "11111111",
            "estado"=> "",
            "cidade"=> "cidade teste",
            "bairro"=> "bairro teste",
            "endereco"=> "Rua teste",
            "endereco_numero"=> "0"
        ];

        $this->json('POST', 'api/usuarios', $newUserData, ['Accept' => 'application/json', 'Content-type' => 'application/json'])
        ->assertStatus(422)
        ->assertJsonCount(2)
        ->assertJsonStructure([
            'message',
            'errors' => [
                'nome',
                'estado'
            ]
        ]);

    }

    public function test_atualizacao_de_usuario_na_agenda_com_resposta_de_sucesso()
    {

        $this->criar_usuario();

        $updateUserData = [
            "nome"=> "New user name",
            "telefone"=> "12888888888",
            "email"=> "test@gmail.com",
        ];

        $this->json('PUT', 'api/usuarios/1', $updateUserData, ['Accept' => 'application/json', 'Content-type' => 'application/json'])
        ->assertStatus(200)
        ->assertJsonCount(2)
        ->assertJsonCount(12, 'usuario')
        ->assertJsonFragment([
            'message' => "Usuário alterado com sucesso!"
        ]);

    }

    public function test_remocao_usuario_da_agenda()
    {
        $this->criar_usuario();

        $this->json('DELETE', 'api/usuarios/1', ['Accept' => 'application/json', 'Content-type' => 'application/json'])
        ->assertStatus(200)
        ->assertJsonCount(1)
        ->assertJsonFragment([
            'message' => "Usuário removido da lista de contatos com sucesso!"
        ]);
    }
}
