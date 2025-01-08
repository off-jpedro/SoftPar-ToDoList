<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use Illuminate\Support\Carbon;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Tarefa::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'tarefa.titulo' => 'required|string|max:70', 
            'tarefa.descricao' => 'required|string|max:255'
        ]);

        $newTarefa = new Tarefa;
        $newTarefa->titulo = $request->tarefa["titulo"];
        $newTarefa->descricao = $request->tarefa["descricao"];
        $newTarefa->save();

        return response()->json($newTarefa, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    $tarefaExistente = Tarefa::find($id);

    if ($tarefaExistente) {
        if (isset($request->tarefa['titulo'])) {
            $tarefaExistente->titulo = $request->tarefa['titulo'];
        }

        if (isset($request->tarefa['descricao'])) {
            $tarefaExistente->descricao = $request->tarefa['descricao'];
        }

        if (isset($request->tarefa['status'])) {
            $tarefaExistente->status = $request->tarefa['status'];

            if ($request->tarefa['status'] == 'Concluida') {
                $tarefaExistente->concluido_em = Carbon::now();
            } else {
                $tarefaExistente->concluido_em = null;
            }
        }

        $tarefaExistente->save();

        return response()->json($tarefaExistente);
    }

    return response()->json(['error' => 'Tarefa não encontrada.'], 404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tarefaExistente = Tarefa::find($id);

        if($tarefaExistente){
            $tarefaExistente->delete();
            return response()->json(['No Content' => 'Tarefa deletada com sucesso.'], 200);
        }

        return response()->json(['error' => 'Tarefa não encontrada.'], 404);
    }
}
