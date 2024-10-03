<?php

use App\Http\Controllers\API\Auth\APIAuthController;
use App\Http\Controllers\API\Customer\CustomerController;
use App\Http\Controllers\API\Project\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [APIAuthController::class, 'store']);
Route::middleware(['auth:sanctum'])->group(
    function () {
        Route::prefix('/customer')->controller(CustomerController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{id}', 'show');
            Route::get('/{id}/edit', 'edit');
            Route::put('/remove-address/{id}', 'removeAddress');
            Route::post('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });
        Route::prefix('/project')->controller(ProjectController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{id}', 'show');
            Route::get('/{id}/edit', 'edit');
            Route::post('/update/{id}', 'update');
            Route::delete('/delete/{id}', 'destroy');
        });

    }
);
