<?php

use App\Http\Controllers\Api\MatrixTableController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::middleware([
    EnsureFrontendRequestsAreStateful::class,
    'auth:sanctum',
])->group(function () {
    Route::post('/matrix-tables/create', [MatrixTableController::class, 'createTable']);
    Route::post('/matrix-tables/add-user', [MatrixTableController::class, 'addUser']);
    Route::post('/matrix-tables/close', [MatrixTableController::class, 'closeTable']);
    });
