<?php

use Illuminate\Support\Facades\Route;
use App\UI\Controller\API\BoardController;

Route::prefix('board')->group(function () {
    Route::post('', [BoardController::class, 'add']);
});
