<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WalkController as APIWalkController;
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

Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('/auth/logout',[AuthController::class, 'logout']);
    Route::get('/user', function(){
        return auth()->user();
    });
    Route::get('walk',[APIWalkController::class, 'index']);
    Route::post('walk/tambah',[APIWalkController::class, 'store']);
    //edit
    Route::post('/user/ubah/{kode_user}',[UserController::class, 'update']);
  

});
// Route::resource('walk',WalkController::class);
