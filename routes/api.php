<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\PermissionController;
use App\Models\Component;
use App\Http\Controllers\RolesController;

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

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
//Auth Routes
Route::post('/login', [AuthController::class, 'geToken']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

//Componentes Route
Route::middleware('api')->get('/components', [ComponentController::class, 'index']);
Route::middleware('api')->get('/components/{id}', [ComponentController::class, 'specific']);
Route::middleware('api')->get('/componentsid/{id}', [ComponentController::class, 'getComponentById']);


//Permission Routes
Route::middleware('api')->get('/permission', [PermissionController::class, 'index']);
Route::middleware('api')->get('/permission/{id}', [PermissionController::class, 'specific']);

//Role Route
Route::middleware('api')->get('/role', [RolesController::class, 'index']);
Route::middleware('api')->get('/role/{id}', [RolesController::class, 'specific']);