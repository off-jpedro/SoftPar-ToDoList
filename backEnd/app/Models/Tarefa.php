<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = [
        'titulo', 
        'descricao', 
        'status', 
        'concluido_em'
    ];

    // Caso você queira uma relação com as subtarefas
    public function subtasks()
    {
        return $this->hasMany(Subtarefa::class);
    }

    protected $dates = ['concluido_em'];
}
