<?php


use App\Http\Controllers\User\TaskController;
use Illuminate\Support\Facades\Route;

Route::apiResource('task', TaskController::class)->except(['edit']);
Route::post('task/title/{id}', [TaskController::class, 'updateTitle']);
Route::post('task/description/{id}', [TaskController::class, 'updateDescription']);
Route::post('task/deadline/{id}', [TaskController::class, 'updateDeadline']);
Route::post('task/status/{id}', [TaskController::class, 'updateStatus']);
