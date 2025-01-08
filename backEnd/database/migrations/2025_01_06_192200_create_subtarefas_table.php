<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubtarefasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtarefas', function (Blueprint $table) {
            $table->id();  
            $table->string('titulo');  
            $table->text('descricao');  
            $table->timestamp('concluido_em')->nullable(); 
            $table->enum('status', ['Pendente', 'Em Andamento', 'Concluida'])->default('pendente');  
            $table->foreignId('tarefa_id')->constrained()->onDelete('cascade');  
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subtarefas');
    }
}
