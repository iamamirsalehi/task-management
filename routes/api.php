<?php

use App\UI\Controller\API\SubTaskController;
use App\UI\Controller\API\TaskController;
use Illuminate\Support\Facades\Route;
use App\UI\Controller\API\BoardController;

Route::prefix('board')->group(function () {
    Route::post('', [BoardController::class, 'add']);
    Route::get('{user_id}', [BoardController::class, 'getUserBoards']);
    Route::get('{id}/tasks', [BoardController::class, 'getTasks']);
});

Route::prefix('task')->group(function () {
    Route::post('', [TaskController::class, 'add']);
    Route::post('{id}/start', [TaskController::class, 'start']);
    Route::post('{id}/complete', [TaskController::class, 'complete']);
    Route::post('{id}/reopen', [TaskController::class, 'reopen']);
    Route::post('{id}/prioritize', [TaskController::class, 'prioritize']);
    Route::post('{id}/assign-deadline', [TaskController::class, 'assignDeadline']);
    Route::post('{id}/sub-tasks', [SubTaskController::class, 'getSubTasks']);
});

Route::prefix('sub-task')->group(function () {
    Route::post('', [SubTaskController::class, 'add']);
    Route::post('{id}/start', [SubTaskController::class, 'start']);
    Route::post('{id}/complete', [SubTaskController::class, 'complete']);
    Route::post('{id}/reopen', [SubTaskController::class, 'reopen']);
    Route::get('{id}/remove', [SubTaskController::class, 'remove']);
});
