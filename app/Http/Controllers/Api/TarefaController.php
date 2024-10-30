<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TarefaController extends Controller
{
    public function index()
    {
        return Tarefa::all();
    }


    public function store(Request $request)
    {
        $tarefa = Tarefa::create($request->all());
        return response()->json($tarefa, 201);
    }


    public function show($id)
    {
        return Tarefa::findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update($request->all());
        return response()->json($tarefa, 200);
    }


    public function destroy($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->delete();
        return response()->json(null, 204);
    }

    public function importar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'arquivo' => 'required|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($file = $request->file('arquivo')) {
            $handle = fopen($file->getPathname(), 'r');

            fgetcsv($handle);

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                Tarefa::create([
                    'titulo' => $data[0],
                    'descricao' => $data[1],
                ]);
            }

            fclose($handle);

            return redirect()->back()->with('success', 'Tarefas importadas com sucesso!');
        }

        return redirect()->back()->with('error', 'Falha ao processar o arquivo.');
    }
}
