<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use App\Http\Requests\UsuariosRequest;
use Exception;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $usuarios = Usuarios::all()->sortBy('nome');
        return response()->json([
            'usuarios' => $usuarios
        ]);
    }

    public function show(Usuarios $usuario)
    {
        return response()->json([
            'usuario' => $usuario
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuariosRequest $request)
    {
        $usuario = Usuarios::create($request->all());

        return response()->json([
            'message' => "Usuário adicionado a lista de contatos!",
            'usuario' => $usuario
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuarios $usuario)
    {
        $usuario->update($request->all());

        return response()->json([
            'message' => "Usuário alterado com sucesso!",
            'usuario' => $usuario
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($usuarioId)
    {
        try {
            $usuario = Usuarios::findOrFail($usuarioId);
            $usuario->delete();

            return response()->json([
                'message' => "Usuário removido da lista de contatos com sucesso!"
            ], 200);

        } catch(Exception $exception) {
            return response()->json([
                'error' => 'Usuário não existente ou inválido!'
            ], 404);
        }
    }
}
