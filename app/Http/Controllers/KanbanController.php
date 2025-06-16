<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa; // Ou Task, se você renomear
use Illuminate\Support\Facades\Log;

class KanbanController extends Controller
{
    public function index()
    {
        // Alterado para consultar status em inglês
        $pending = Tarefa::where('status', 'pending')->get();
        $inProgress = Tarefa::where('status', 'in_progress')->get();
        $testing = Tarefa::where('status', 'testing')->get();
        $completed = Tarefa::where('status', 'completed')->get();

        return view('kanban.index', compact('pending', 'inProgress', 'testing', 'completed'));
    }

    public function create()
    {
        return view('kanban.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:high,medium,low',
            'description' => 'nullable|string',
        ]);

        try {
            Tarefa::create([
                'title' => $request->title, // Alterado para 'title'
                'priority' => $request->priority, // Alterado para 'priority'
                'description' => $request->description, // Alterado para 'description'
                'status' => 'pending', // Alterado para 'pending'
            ]);

            return redirect()->route('kanban.index')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error creating task.');
        }
    }

    public function edit($id)
    {
        $task = Tarefa::findOrFail($id);
        return view('kanban.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:high,medium,low',
            'description' => 'nullable|string',
        ]);

        try {
            $task = Tarefa::findOrFail($id);
            $task->update([
                'title' => $request->title, // Alterado para 'title'
                'priority' => $request->priority, // Alterado para 'priority'
                'description' => $request->description, // Alterado para 'description'
            ]);

            return redirect()->route('kanban.index')->with('success', 'Task updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error updating task.');
        }
    }

    // --- NOVO MÉTODO PARA ATUALIZAR STATUS VIA AJAX/LIVEWIRE ---
    public function updateStatus(Request $request, Tarefa $tarefa)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,testing,completed', // Valida os novos status em inglês
        ]);

        try {
            $tarefa->update(['status' => $request->status]);
            return response()->json(['message' => 'Status updated successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating status.'], 500);
        }
    }

    
public function destroy(Tarefa $tarefa)
    {
        try {
            $tarefa->delete(); // Exclui a tarefa usando Model Binding

            // Retorna uma resposta JSON para o AJAX
            return response()->json(['message' => 'Task deleted successfully!'], 200);
        } catch (\Exception $e) {
            // Em caso de erro, loga e retorna um erro JSON
            Log::error('Error deleting task: ' . $e->getMessage());
            return response()->json(['message' => 'Error deleting task.'], 500);
        }
    }

     /**
     * Exibe os detalhes de uma tarefa específica.
     * @param Tarefa $tarefa
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Tarefa $tarefa)
    {
        // O Model Binding já garante que $tarefa é uma instância válida de Tarefa
        // e que a tarefa existe. Se não existir, ele lançará um 404 automaticamente.
        return response()->json($tarefa, 200);
    }

}