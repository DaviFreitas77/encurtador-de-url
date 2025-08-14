<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogOutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\QRCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisterController::class, 'create']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LogOutController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/links', [LinksController::class, 'fetchLinkUser']);
    Route::post('/links', [LinksController::class, 'createLink']);
    Route::get('/countLink', [LinksController::class, 'totalLinks']);
});

Route::middleware('auth:sanctum')->prefix('metrics')->group(function () {
    Route::get('/total', [LinksController::class, 'totalLinks']);
    Route::get('/total-click', [LinksController::class, 'totalClick']);
    Route::get('/active-expired', [LinksController::class, 'activeExpired']);
    Route::get('/top', [LinksController::class, 'topClick']);
});
Route::prefix('s')->group(function () {
    Route::get('/{slug}', [LinksController::class, 'redirectOriginalUrl']);
});


Route::get('/qrCode/{slug}', [QRCodeController::class, 'gerarQrCode']);
