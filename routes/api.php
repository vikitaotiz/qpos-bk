<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix' => 'v1'], function(){
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/login', [AuthController::class, 'login']);


//     Route::group(['middleware' => ['auth:sanctum']], function(){
//         Route::post('/logout', [AuthController::class, 'logout']);
//         Route::post('/refresh', [AuthController::class, 'refresh']);

//         Route::resource('roles', RoleController::class);
//         Route::post('delete_role', [RoleController::class, 'destroy']);
//         Route::post('update_role', [RoleController::class, 'update']);
//     });
// });

Route::group(['prefix' => 'v1'], function(){
    // Authentication routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Routes protected by auth:sanctum middleware
    Route::group(['middleware' => ['auth:sanctum']], function(){
        // Logout and refresh routes
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);

        // Routes for categories
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/categories/{id}', [CategoryController::class, 'show']);
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

        // Routes for products
        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/products/{id}', [ProductController::class, 'show']);
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);

        // Resourceful routes for managing roles
        Route::resource('roles', RoleController::class);

        // Custom routes for roles
        Route::post('delete_role', [RoleController::class, 'destroy']);
        Route::post('update_role', [RoleController::class, 'update']);
    });
});