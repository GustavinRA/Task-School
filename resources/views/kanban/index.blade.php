@extends('layouts.admin')

@section('content')

<body>
    <main class = "kanban">
      <!--coluna1-->
        <div class="kanban-column">
        <div class="kanban-title">
            <h2>
                Pendente
            </h2>
            <button class = "add-card">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
        
    <div class="kanban-cards">
        <div class="kanban-card">
            <div class = "badge-high">
                <span>
                    Alta prioridade
                </span>
            </div>
        <p class = card-title>
            Revisar documento 
        </p>
        <div class="card-icons">
            <p>
                <i class="fa-regular fa-comment"></i>
                1
            </p>
            <p>
                <i class="fa-solid fa-paperclip"></i>
                1
            </p>
        </div>
        <div class="user">
            <img src="task-school\frontend\img\avatar1.jpeg" alt="avatar1">
        </div>
    </div>
    </div>
    
</div>
   <!--coluna2--> 
<div class="kanban-column">
        <div class="kanban-title">
            <h2>
                Em andamento
            </h2>
            <button class = "add-card">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    <div class="kanban-cards">
        <div class="kanban-card">
            <div class = "badge-high">
                <span>
                    Alta prioridade
                </span>
            </div>
        <p class = card-title>
            Revisar documento 
        </p>
        <div class="card-icons">
            <p>
                <i class="fa-regular fa-comment"></i>
                1
            </p>
            <p>
                <i class="fa-solid fa-paperclip"></i>
                1
            </p>
        </div>
        <div class="user">
            <img src="task-school\frontend\img\avatar1.jpeg" alt="avatar1">
        </div>
    </div>
    </div>
    
</div>
<!--coluna3-->
 <div class="kanban-column">
        <div class="kanban-title">
            <h2>
                Concluído
            </h2>
            <button class = "add-card">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
        
    <div class="kanban-cards">
        <div class="kanban-card">
            <div class = "badge-high">
                <span>
                    Alta prioridade
                </span>
            </div>
        <p class = "card-title">
            Revisar documento 
        </p>
        <div class="card-icons">
            <p>
                <i class="fa-regular fa-comment"></i>
                1
            </p>
            <p>
                <i class="fa-solid fa-paperclip"></i>
                1
            </p>
        </div>
        <div class="user">
            <img src="task-school\frontend\img\avatar1.jpeg" alt="avatar1">
        </div>
    </div>
    </div>
    
</div>


</main>
  <script src="frontend/js/scripts.js"></script>
</body>

@endsection