<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class Controller
{
    public function index()
    {
        $tarefas = Tarefa::all();
        return view('index', compact('tarefas'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required',
        ]);

        Tarefa::create($request->all());
        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function edit($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('edit', compact('tarefa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required',
        ]);

        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update($request->all());
        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->delete();

        return response()->json(['success' => true, 'message' => 'Tarefa deletada com sucesso!']);
    }

}
