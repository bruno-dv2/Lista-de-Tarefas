<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tarefas', [Controller::class, 'index'])->name('tarefas.index');
Route::get('/tarefas/create', [Controller::class, 'create'])->name('tarefas.create');
Route::get('/tarefas/{id}/edit', [Controller::class, 'edit'])->name('tarefas.edit');
Route::post('/tarefas', [Controller::class, 'store'])->name('tarefas.store');
Route::put('/tarefas/{id}', [Controller::class, 'update'])->name('tarefas.update');
Route::delete('/tarefas/{id}', [Controller::class, 'destroy'])->name('tarefas.destroy');
