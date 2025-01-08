<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubTarefa;
use Illuminate\Support\Carbon;

class SubTarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return SubTarefa::orderBy('created_at', 'DESC')->get();
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
            'subTarefa.titulo' => 'required|string|max:70', 
            'subTarefa.descricao' => 'required|string|max:255',
            'subTarefa.tarefa_id' => 'required|exists:tarefas,id',
        ]);
    

        $newSubTarefa = new SubTarefa;
        $newSubTarefa->titulo = $request->subTarefa["titulo"];
        $newSubTarefa->descricao = $request->subTarefa["descricao"];
        $newSubTarefa->tarefa_id = $request->subTarefa["tarefa_id"];
        $newSubTarefa->save();

        return response()->json($newSubTarefa, 201);
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
        $subTarefaExistente = SubTarefa::find($id);

        if ($subTarefaExistente) {
            if (isset($request->subTarefa['titulo'])) {
                $subTarefaExistente->titulo = $request->subTarefa['titulo'];
            }
    
            if (isset($request->tarefa['descricao'])) {
                $subTarefaExistente->descricao = $request->subTarefa['descricao'];
            }
    
            if (isset($request->tarefa['status'])) {
                $subTarefaExistente->status = $request->subTarefa['status'];
    
                if ($request->tarefa['status'] == 'Concluida') {
                    $subTarefaExistente->concluido_em = Carbon::now();
                } else {
                    $subTarefaExistente->concluido_em = null;
                }
            }
    
            $subTarefaExistente->save();
    
            return response()->json($subTarefaExistente);
        }
    
        return response()->json(['error' => 'SubTarefa não encontrada.'], 404);
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
        $subTarefaExistente = SubTarefa::find($id);

        if($subTarefaExistente){
            $subTarefaExistente->delete();
            return response()->json(['No Content' => 'SubTarefa deletada com sucesso.'], 200);
        }

        return response()->json(['error' => 'SubTarefa não encontrada.'], 404);
    }
}
