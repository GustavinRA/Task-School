<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    // Se o nome da sua tabela for 'tasks' e não 'tarefas'
    protected $table = 'tasks';

    // Campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = ['title', 'priority', 'description', 'status']; // Alterado para inglês
}