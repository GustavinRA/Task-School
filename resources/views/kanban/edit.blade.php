{{-- kanban/edit.blade.php --}}

@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4">Editar Tarefa</h2>

    <form action="{{ route('kanban.update', $task->id) }}" method="POST"> {{-- Variável $task (controller) --}}
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Título</label> {{-- Alterado for="titulo" para for="title" --}}
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required> {{-- Alterado name="titulo" para name="title", id="titulo" para id="title", e $task->titulo para $task->title --}}
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioridade</label> {{-- Alterado for="prioridade" para for="priority" --}}
            <select name="priority" id="priority" class="form-select" required> {{-- Alterado name="prioridade" para name="priority" e id="prioridade" para id="priority" --}}
                <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>Alta</option>   {{-- Alterado value="alta" para value="high" e $tarefa->prioridade para $task->priority --}}
                <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Média</option> {{-- Alterado value="media" para value="medium" e $tarefa->prioridade para $task->priority --}}
                <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Baixa</option>     {{-- Alterado value="baixa" para value="low" e $tarefa->prioridade para $task->priority --}}
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label> {{-- Alterado for="descricao" para for="description" --}}
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $task->description) }}</textarea> {{-- Alterado name="descricao" para name="description", id="descricao" para id="description", e $tarefa->descricao para $task->description --}}
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('kanban.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</div>
@endsection