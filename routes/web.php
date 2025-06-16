<?php

use App\Http\Controllers\KanbanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');
    
Route::get('/home', [KanbanController::class, 'index'])->name('kanban.index');
Route::get('/home/task/create', [KanbanController::class, 'create'])->name('kanban.create');
Route::post('/home/task', [KanbanController::class, 'store'])->name('kanban.store');
Route::get('/home/task/{id}/edit', [KanbanController::class, 'edit'])->name('kanban.edit');
Route::put('/home/task/{id}', [KanbanController::class, 'update'])->name('kanban.update');

// NOVA ROTA PARA ATUALIZAR O STATUS VIA AJAX
Route::put('/home/task/{tarefa}/update-status', [KanbanController::class, 'updateStatus'])->name('kanban.updateStatus');
Route::delete('/home/task/{tarefa}', [KanbanController::class, 'destroy'])->name('kanban.destroy');
Route::get('/home/task/{tarefa}', [KanbanController::class, 'show'])->name('kanban.show'); // NOVA ROTA PARA VISUALIZAR DETALHES





Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('user-store');
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user-update');
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');



/*
Route::group(['middleware' => 'auth'], function() {
    Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('user-store');
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user-update');
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});
*/
