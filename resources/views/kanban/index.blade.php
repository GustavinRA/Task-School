{{-- resources/views/kanban/index.blade.php --}}

@extends('layouts.admin')

@section('content')
<div class="container mt-3">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<body>
    <main class="kanban">

        <div class="kanban-column" data-id="1" data-status="pending">
            <div class="kanban-title">
                <h2>Pendente</h2>
                <a href="{{ route('kanban.create') }}" class="add-card">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            <div class="kanban-cards">
                @foreach ($pending as $tarefa)
                    <div class="kanban-card" draggable="true" data-id="{{ $tarefa->id }}">
                        <div class="badge {{ $tarefa->priority }}">
                            <span>{{ ucfirst($tarefa->priority) }} prioridade</span>
                        </div>
                        <p class="card-title">{{ $tarefa->title }}</p>
                        <p class="card-date">Criado em: {{ $tarefa->created_at->format('d/m/Y H:i') }}</p>
                        <div class="card-icons" draggable="false">
                            <i class="bi bi-view-list view-task-btn" data-task-id="{{ $tarefa->id }}"></i>
                            <a href="{{ route('kanban.edit', $tarefa->id) }}"><i class="bi bi-pen"></i></a>
                            <i class="bi bi-trash delete-task-btn" data-task-id="{{ $tarefa->id }}"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="kanban-column" data-id="2" data-status="in_progress">
            <div class="kanban-title">
                <h2>Em andamento</h2>
                <a href="{{ route('kanban.create') }}" class="add-card">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            <div class="kanban-cards">
                @foreach ($inProgress as $tarefa)
                    <div class="kanban-card" draggable="true" data-id="{{ $tarefa->id }}">
                        <div class="badge {{ $tarefa->priority }}">
                            <span>{{ ucfirst($tarefa->priority) }} prioridade</span>
                        </div>
                        <p class="card-title">{{ $tarefa->title }}</p>
                        <p class="card-date">Criado em: {{ $tarefa->created_at->format('d/m/Y H:i') }}</p>
                        <div class="card-icons" draggable="false">
                            <i class="bi bi-view-list view-task-btn" data-task-id="{{ $tarefa->id }}"></i>
                            <a href="{{ route('kanban.edit', $tarefa->id) }}"><i class="bi bi-pen"></i></a>
                            <i class="bi bi-trash delete-task-btn" data-task-id="{{ $tarefa->id }}"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="kanban-column" data-id="3" data-status="testing">
            <div class="kanban-title">
                <h2>Em testes</h2>
                <a href="{{ route('kanban.create') }}" class="add-card">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            <div class="kanban-cards">
                @foreach ($testing as $tarefa)
                    <div class="kanban-card" draggable="true" data-id="{{ $tarefa->id }}">
                        <div class="badge {{ $tarefa->priority }}">
                            <span>{{ ucfirst($tarefa->priority) }} prioridade</span>
                        </div>
                        <p class="card-title">{{ $tarefa->title }}</p>
                        <p class="card-date">Criado em: {{ $tarefa->created_at->format('d/m/Y H:i') }}</p>
                        <div class="card-icons" draggable="false">
                            <i class="bi bi-view-list view-task-btn" data-task-id="{{ $tarefa->id }}"></i>
                            <a href="{{ route('kanban.edit', $tarefa->id) }}"><i class="bi bi-pen"></i></a>
                            <i class="bi bi-trash delete-task-btn" data-task-id="{{ $tarefa->id }}"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="kanban-column" data-id="4" data-status="completed">
            <div class="kanban-title">
                <h2>Concluído</h2>
                <a href="{{ route('kanban.create') }}" class="add-card">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            <div class="kanban-cards">
                @foreach ($completed as $tarefa)
                    <div class="kanban-card" draggable="true" data-id="{{ $tarefa->id }}">
                        <div class="badge {{ $tarefa->priority }}">
                            <span>{{ ucfirst($tarefa->priority) }} prioridade</span>
                        </div>
                        <p class="card-title">{{ $tarefa->title }}</p>
                        <p class="card-date">Criado em: {{ $tarefa->created_at->format('d/m/Y H:i') }}</p>
                        <div class="card-icons" draggable="false">
                            <i class="bi bi-view-list view-task-btn" data-task-id="{{ $tarefa->id }}"></i>
                            <a href="{{ route('kanban.edit', $tarefa->id) }}"><i class="bi bi-pen"></i></a>
                            <i class="bi bi-trash delete-task-btn" data-task-id="{{ $tarefa->id }}"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </main>

    {{-- AQUI ESTÁ A ESTRUTURA HTML COMPLETA DO MODAL! --}}
    <div class="modal fade" id="taskDetailModal" tabindex="-1" aria-labelledby="taskDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #373C3F; color: #E0E0E0;">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskDetailModalLabel" style="color: #ADD8E6;">Detalhes da Tarefa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Título:</strong> <span id="modalTaskTitle"></span></p>
                    <p><strong>Prioridade:</strong> <span id="modalTaskPriority"></span></p>
                    <strong>Status:</strong> <span id="modalTaskStatus"></span></p>
                    <p><strong>Descrição:</strong> <span id="modalTaskDescription"></span></p>
                    <p><strong>Criada em:</strong> <span id="modalTaskCreatedAt"></span></p>
                    <p><strong>Última Atualização:</strong> <span id="modalTaskUpdatedAt"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="#" id="modalEditButton" class="btn btn-primary">Editar Tarefa</a>
                </div>
            </div>
        </div>
    </div>

    {{-- MANTER ESTA LINHA: ESSA LINHA É CRUCIAL PARA CARREGAR SEU JAVASCRIPT! --}}
    <script src="{{ asset('scripts.js') }}"></script>
</body>
@endsection