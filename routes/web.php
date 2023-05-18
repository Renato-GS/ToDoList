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


Route::get('/todo/{id}/mark', [TodoController::class, 'mark'])->name('todo.mark');
Route::get('/todo/{id}/delete',[TodoController::class, 'delete'])->name('todo.delete');
Route::post('/todo',[TodoController::class, 'store'])->name('todo.store');
Route::get('/filter/{filter}',[TodoController::class,'filter'])->name('todo.filter');
Route::get('/todo',[TodoController::class,'index'])->name('todo.index');
