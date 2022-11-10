<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('dash', [TaskController::class, 'ViewTasks']);
Route::get('deleteTask/{id}', [TaskController::class, 'DeleteTask'])->middleware('loginGuard');
Route::get('editTask', [TaskController::class, 'EditTask'])->middleware('loginGuard');
Route::get('logout', [LoginController::class,'Logout']);
Route::post('login', [LoginController::class,'Login']);