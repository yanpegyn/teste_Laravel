<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function create(Request $request)
    {
        $validator = validator()->make(request()->all(), [
            'nome' => 'required|String',
        ], [
            'nome.required' => "Esperado o campo 'nome'",
            'nome.String' => "O campo 'nome' deve ser uma String",
        ]);

        if ($validator->fails()) {
            abort(response()->json($validator->errors()->first(), 400));
        }

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
        $validator = validator()->make(request()->all(), [
            'nome' => 'required|String',
        ], [
            'nome.required' => "Esperado o campo 'nome'",
            'nome.String' => "O campo 'nome' deve ser uma String",
        ]);

        if ($validator->fails()) {
            abort(response()->json($validator->errors()->first(), 400));
        }
        
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
