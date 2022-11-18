<?php

namespace tests\Controller;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;


class UsuariosControllerTests extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    protected function tearDown(): void
    {
        DB::rollback();
        parent::tearDown();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
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
            "estado"=> "estado teste",
            "cidade"=> "cidade teste",
            "bairro"=> "bairro teste",
            "endereco"=> "Rua teste",
            "endereco_numero"=> "0"
        ];

        $this->json('POST', 'api/usuarios', $newUserData, ['Accept' => 'application/json', 'Content-type' => 'application/json'])
        ->assertStatus(500);

    }
}
