<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
        ]);

        Categoria::create(['nome' => $request->nome]);
        return "Categoria criada com sucesso!";
    }

    public function read($id = null)
    {
        if ($id === null) {
            return Categoria::all();
        }
        return Categoria::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required',
        ]);
        $categoria = Categoria::findOrFail($id);

        $categoria->update([
            'nome' => $request->nome,
        ]);

        return "Categoria atualizada com Sucesso!";
    }

    public function delete($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return "Categoria deletada com Sucesso!";
    }
}
