<?php

use App\Http\Controllers\{TodoController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('listagem-usuario',[TodoController::class, '']);

Route::get('/home', function () {
    return view('home');
});


Route::get('/todo/{id}/mark', [TodoController::class, 'mark'])->name('todo.mark');
Route::get('/todo/{id}/delete',[TodoController::class, 'delete'])->name('todo.delete');
Route::put('/todo/{id}',[TodoController::class, 'update'])->name('todo.update');
Route::post('/todo',[TodoController::class, 'store'])->name('todo.store');
Route::get('/filter/{filter}',[TodoController::class,'filter'])->name('todo.filter');
Route::get('/todo',[TodoController::class,'index'])->name('todo.index');
Route::get('/todo/{id}',[Todocontroller::class,'show'])->name('todo.show');
Route::get('/todo/{id}/edit',[Todocontroller::class,'edit'])->name('todo.edit');

Route::get('/todo/create',[TodoController::class,'create'])->name('todo.create');

