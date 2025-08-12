<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisterController::class, 'create']);
    Route::post('/login', [LoginController::class, 'login']);
    // Route::post('/logout', [LoginController::class, 'login']);
});
