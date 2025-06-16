{{-- kanban/create.blade.php --}}

@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4">Nova Tarefa</h2>

    <form action="{{ route('kanban.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Título</label> {{-- Alterado for="titulo" para for="title" --}}
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required> {{-- Alterado name="titulo" para name="title" e id="titulo" para id="title" --}}
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioridade</label> {{-- Alterado for="prioridade" para for="priority" --}}
            <select name="priority" id="priority" class="form-select" required> {{-- Alterado name="prioridade" para name="priority" e id="prioridade" para id="priority" --}}
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Alta</option>   {{-- Alterado value="alta" para value="high" --}}
                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Média</option> {{-- Alterado value="media" para value="medium" --}}
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Baixa</option>     {{-- Alterado value="baixa" para value="low" --}}
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label> {{-- Alterado for="descricao" para for="description" --}}
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea> {{-- Alterado name="descricao" para name="description" e id="descricao" para id="description" --}}
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('kanban.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</div>
@endsection