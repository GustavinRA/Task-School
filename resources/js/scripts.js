// public/scripts.js

// Adicione esta linha no TOPO do seu scripts.js
import { Modal } from 'bootstrap'; // Importa o componente Modal do Bootstrap

// Garante que o DOM está completamente carregado antes de anexar eventos
document.addEventListener('DOMContentLoaded', () => {

    // --- FUNÇÕES HELPER ---
    function ucfirst(str) {
        if (!str) return '';
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    function getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('.kanban-card:not(.dragging)')];
        return draggableElements.reduce((closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest.offset) {
                return { offset: offset, element: child };
            } else {
                return closest;
            }
        }, { offset: Number.NEGATIVE_INFINITY }).element;
    }

    // --- DRAG AND DROP ---
    function addDragEvents(card) {
        card.addEventListener('dragstart', e => {
            if (e.target.closest('.card-icons')) {
                e.preventDefault();
                return;
            }
            e.currentTarget.classList.add('dragging');
            e.dataTransfer.setData('text/plain', e.currentTarget.dataset.id);
        });
        card.addEventListener('dragend', e => {
            e.currentTarget.classList.remove('dragging');
        });
    }

    document.querySelectorAll('.kanban-card').forEach(addDragEvents);

    document.querySelectorAll('.kanban-cards').forEach(column => {
        column.addEventListener('dragover', e => {
            e.preventDefault();
            const draggingCard = document.querySelector('.kanban-card.dragging');
            const afterElement = getDragAfterElement(column, e.clientY);
            if (afterElement == null) {
                column.appendChild(draggingCard);
            } else {
                column.insertBefore(draggingCard, afterElement);
            }
            column.classList.add('cards-hover');
        });
        column.addEventListener('dragleave', () => {
            column.classList.remove('cards-hover');
        });
        column.addEventListener('drop', e => {
            e.preventDefault();
            column.classList.remove('cards-hover');
            const cardId = e.dataTransfer.getData('text/plain');
            const draggedCard = document.querySelector(`.kanban-card[data-id="${cardId}"]`);
            const newStatus = column.closest('.kanban-column').dataset.status;
            if (draggedCard && newStatus) {
                updateTaskStatus(cardId, newStatus);
            }
        });
    });

    // --- FUNÇÃO PARA ENVIAR REQUISIÇÃO AJAX (Atualizar Status) ---
    async function updateTaskStatus(taskId, newStatus) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        try {
            const response = await fetch(`/home/task/${taskId}/update-status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ status: newStatus })
            });
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Erro ao atualizar o status da tarefa.');
            }
            const data = await response.json();
            console.log('Sucesso na atualização de status:', data.message);
        } catch (error) {
            console.error('Erro ao atualizar status:', error);
            alert('Erro ao atualizar status: ' + error.message);
        }
    }

    // --- FUNÇÃO PARA ENVIAR REQUISIÇÃO AJAX (Excluir Tarefa) ---
    async function deleteTask(taskId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        try {
            const response = await fetch(`/home/task/${taskId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Erro ao excluir a tarefa.');
            }
            const data = await response.json();
            console.log('Exclusão Sucesso:', data.message);
            return data;
        } catch (error) {
            console.error('Erro na requisição de exclusão:', error);
            throw error;
        }
    }

    // --- EVENT LISTENER PARA BOTÕES DE EXCLUIR TAREFA ---
    const deleteButtons = document.querySelectorAll('.delete-task-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
            const taskId = e.currentTarget.dataset.taskId;
            if (confirm('Tem certeza que deseja excluir esta tarefa?')) {
                try {
                    await deleteTask(taskId);
                    const cardToRemove = document.querySelector(`.kanban-card[data-id="${taskId}"]`);
                    if (cardToRemove) {
                        cardToRemove.remove();
                        console.log(`Tarefa ${taskId} removida do DOM.`);
                    }
                } catch (error) {
                    console.error('Falha ao excluir tarefa:', error);
                    alert('Não foi possível excluir a tarefa: ' + error.message);
                }
            }
        });
    });

    // --- LÓGICA PARA VISUALIZAR DETALHES DA TAREFA (MODAL) ---
    const viewButtons = document.querySelectorAll('.view-task-btn');
    const taskDetailModalElement = document.getElementById('taskDetailModal');
    let taskDetailModal;

    // AQUI: Usando o 'Modal' que foi importado diretamente
    if (taskDetailModalElement) {
        taskDetailModal = new Modal(taskDetailModalElement); // <--- Corrigido para usar a classe Modal importada
    } else {
        console.error('Elemento modal #taskDetailModal não encontrado no DOM. O modal não poderá ser exibido.');
    }

    viewButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
            if (!taskDetailModal) {
                console.error('Modal de detalhes não está instanciado. Verifique os logs anteriores.');
                alert('Erro: Não foi possível abrir o modal. Verifique o console do navegador.');
                return;
            }

            const taskId = e.currentTarget.dataset.taskId;

            try {
                const response = await fetch(`/home/task/${taskId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Erro ao buscar detalhes da tarefa.');
                }

                const task = await response.json();

                document.getElementById('modalTaskTitle').textContent = task.title;
                document.getElementById('modalTaskPriority').textContent = ucfirst(task.priority);
                document.getElementById('modalTaskStatus').textContent = ucfirst(task.status.replace(/_/g, ' '));
                document.getElementById('modalTaskDescription').textContent = task.description || 'Nenhuma descrição.';
                document.getElementById('modalTaskCreatedAt').textContent = task.created_at ? new Date(task.created_at).toLocaleString('pt-BR') : 'N/A';
                document.getElementById('modalTaskUpdatedAt').textContent = task.updated_at ? new Date(task.updated_at).toLocaleString('pt-BR') : 'N/A';

                const modalEditButton = document.getElementById('modalEditButton');
                if (modalEditButton) {
                    modalEditButton.href = `/home/task/${task.id}/edit`;
                }

                taskDetailModal.show();
            } catch (error) {
                console.error('Erro ao visualizar tarefa:', error);
                alert('Não foi possível carregar os detalhes da tarefa: ' + error.message);
            }
        });
    });
});