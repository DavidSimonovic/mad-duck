<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\TaskController;
use App\Http\Controllers\User\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('todo', TodoListController::class)->except(['edit']);
    Route::post('todo/title/{id}', [TodoListController::class, 'updateTitle']);
    Route::post('todo/description/{id}', [TodoListController::class, 'updateDescription']);

    Route::apiResource('task', TodoListController::class)->except(['edit']);
    Route::post('task/title/{id}', [TaskController::class, 'updateTitle']);
    Route::post('task/description/{id}', [TaskController::class, 'updateDescription']);
    Route::post('task/deadline/{id}', [TaskController::class, 'updateDeadline']);
    Route::post('task/status/{id}', [TaskController::class, 'updateStatus']);

});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
