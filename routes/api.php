<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('customers/', CustomerController::class);

Route::get('customers/', [CustomerController::class, 'show']);

Route::get('customers/all', [CustomerController::class, 'index']);

Route::post('customers/', [CustomerController::class, 'store']);

Route::put('customers/{id}', [CustomerController::class, 'update']);

Route::delete('customers/', [CustomerController::class, 'destroy']);


