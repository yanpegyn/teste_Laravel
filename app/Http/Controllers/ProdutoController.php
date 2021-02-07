<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    
    public function create(Request $request)
    {
        $validator = validator()->make(request()->all(), [
            'categoria_id' => 'required|exists:categorias,id',
            'nome' => 'required|String',
            'preco' => 'required|numeric|min:0',
        ], [
            'categoria_id.exists' => 'ID de categoria não existente',
            'categoria_id.required' => "Esperado o campo 'categoria_id'",
            'nome.required' => "Esperado o campo 'nome'",
            'nome.String' => "O campo 'nome' deve ser uma String",
            'preco.required' => "Esperado o campo 'preco'",
            'preco.numeric' => "O campo 'preco' deve ser um Número",
            'preco.min' => "O campo 'preco' deve ser >= 0",
        ]);

        if ($validator->fails()) {
            abort(response()->json($validator->errors()->first(), 400));
        }

        Produto::create([
            'categoria_id' => $request->categoria_id,
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        return "Produto criado com sucesso!";
    }

    public function read($id = null)
    {
        if ($id === null) {
            return Produto::all();
        }
        return Produto::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validator = validator()->make(request()->all(), [
            'categoria_id' => 'required|exists:categorias,id',
            'nome' => 'required|String',
            'preco' => 'required|numeric|min:0',
        ], [
            'categoria_id.exists' => 'ID de categoria não existente',
            'categoria_id.required' => "Esperado o campo 'categoria_id'",
            'nome.required' => "Esperado o campo 'nome'",
            'nome.String' => "O campo 'nome' deve ser uma String",
            'preco.required' => "Esperado o campo 'preco'",
            'preco.numeric' => "O campo 'preco' deve ser um Número",
            'preco.min' => "O campo 'preco' deve ser >= 0",
        ]);

        if ($validator->fails()) {
            abort(response()->json($validator->errors()->first(), 400));
        }

        $produto = Produto::findOrFail($id);

        $produto->update([
            'categoria_id' => $request->categoria_id,
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        return "Produto atualizado com Sucesso!";
    }

    public function delete($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return "Produto deletado com Sucesso!";
    }
}
