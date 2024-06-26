<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Requests\UserRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\AddressController;

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

//Route::post('/users/create', [UserController::class, 'store']); //profile creation - the user cannot be authentified before its creation, that's why it's separated from the middleware route of sanctum's authentification


//apiResource replaces the get, put and delete routes for all items and their ids - there's the classic routes for user to exemplify what it replaces.
Route::apiResource('/products', ProductController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/orders', OrderController::class);
Route::apiResource('/companies', CompanyController::class);
Route::get('/products/categories/{categoryName}', [ProductController::class, 'showProductsByCategory']);
Route::get('/cart', [ProductController::class, 'showShoppingCart']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'showCurrentUser']);
    Route::get('/user/address/{id}', [AddressController::class, 'showCurrentUsersAddress']);
});
