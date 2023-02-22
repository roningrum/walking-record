<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\WalkController as APIWalkController;
use App\Http\Controllers\WalkController;
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

Route::post('auth/daftar',[AuthController::class, 'register']);
Route::post('auth/masuk',[AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('walk', [APIWalkController::class, 'index']);
Route::post('walk/tambah', [APIWalkController::class, 'store']);
// Route::resource('walk',WalkController::class);
