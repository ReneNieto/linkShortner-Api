<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->post('link', [LinkController::class, 'store']);
Route::middleware('auth:sanctum')->delete('link/{link}', [LinkController::class, 'destroy']);
Route::middleware('auth:sanctum')->patch('link/{link}', [LinkController::class, 'update']);
Route::middleware('auth:sanctum')->get('links', [LinkController::class, 'index']);

Route::middleware('auth:sanctum')->get('views', [ViewsController::class, 'views']);

Route::middleware('auth:sanctum')->get('users', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
