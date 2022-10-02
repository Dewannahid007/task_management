<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/',[TasksController::class,'index'])->name('index');
Route::get('/createTasksForm',[TasksController::class,'createTasksForm'])->name('createTasksForm');
Route::post('/createNewTask',[TasksController::class,'createNewTask'])->name('createNewTask');
Route::get('/editTasksForm/{id}',[TasksController::class,'editTasksForm'])->name('editTasksForm');
Route::post('/editTask',[TasksController::class,'editTask'])->name('editTask');
Route::get('/editAllTasks',[TasksController::class,'EditAllTasks'])->name('editAlltasks');
route::get('/deleteTask/{id}',[TasksController::class,'deleteTask'])->name('deleteTask');

route::get('/CompletedTasks',[TasksController::class,'CompletedTasks'])->name('CompletedTasks');
route::get('/InprogressTasks',[TasksController::class,'InprogressTasks'])->name('InprogressTasks');

