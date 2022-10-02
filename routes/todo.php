<?php


use App\Http\Controllers\User\TodoListController;
use Illuminate\Support\Facades\Route;

Route::apiResource('todo', TodoListController::class)->except(['edit']);
Route::post('todo/title/{id}', [TodoListController::class, 'updateTitle']);
Route::post('todo/description/{id}', [TodoListController::class, 'updateDescription']);
