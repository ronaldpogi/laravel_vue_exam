<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function(){
    
    Route::get('/user/index', [UserController::class, 'index']);
    Route::post('/user/logout', [UserController::class, 'logout']);
    Route::get('/user/role/{id}', [UserController::class, 'getRole']);
    Route::get('/user/info/{id}', [UserController::class, 'getInfo']);
    Route::put('/user/role/update/{id}', [UserController::class, 'updateRole']);
    Route::put('/user/info/update/{id}', [UserController::class, 'updateInfo']);
    Route::delete('/user/delete/{id}', [UserController::class, 'destroyUser']);

});



Route::post('/user/register', [UserController::class, 'createUser']);
Route::post('/user/login', [UserController::class, 'loginUser']);


