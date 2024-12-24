<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\UI\Controller\API\BoardController::class, 'add']);
