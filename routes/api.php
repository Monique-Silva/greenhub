<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::post('/users/create', [UserController::class, 'store']); //profile creation - the user cannot be authentified before its creation, that's why it's separated from the middleware route of sanctum's authentification

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/products', ProductController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/orders', OrderController::class);
    Route::apiResource('/products', ProductController::class);
    Route::apiResource('/companies', CompanyController::class);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users{id}', [UserController::class, 'show']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
});
