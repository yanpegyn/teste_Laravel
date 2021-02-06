<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'categoria_id' => 'required',
            'nome' => 'required',
            'preco' => 'required',
        ]);

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
        $this->validate($request, [
            'categoria_id' => 'required',
            'nome' => 'required',
            'preco' => 'required',
        ]);
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
