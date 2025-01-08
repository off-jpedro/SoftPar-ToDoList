<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtarefa extends Model
{
    protected $fillable = [
        'titulo', 
        'descricao', 
        'status',
        'concluido_em',
        'tarefa_id'
    ];

    public function task()
    {
        return $this->belongsTo(Tarefa::class);
    }
}
