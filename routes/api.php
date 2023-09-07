<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\PermissionController;
use App\Models\Component;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SubdepartmentController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\FreedomController;



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

//User route
Route::middleware('api')->get('/user' , [UserController::Class, 'index']);
Route::middleware('api')->get('/user/{id}' , [UserController::Class, 'specific']);
Route::middleware('api')->put('/update/{id}' , [UserController::Class, 'update']);


//Role Route
Route::middleware('api')->get('/role', [RolesController::class, 'index']);
Route::middleware('api')->get('/role/{id}', [RolesController::class, 'specific']);

//Departments Routes
Route::middleware('api')->get('/department', [DepartmentController::class, 'index']);
Route::middleware('api')->get('/department/{id}', [DepartmentController::class, 'specific']);

//Subdepartments Route
Route::middleware('api')->get('/subdepartment', [SubdepartmentController::class, 'index']);
Route::middleware('api')->get('/subdepartment/{id}', [SubdepartmentController::class, 'specific']);

//Office Route
Route::middleware('api')->get('/office', [OfficeController::class, 'index']);
Route::middleware('api')->get('/office/{id}', [OfficeController::class, 'specific']);

//Room Route
Route::middleware('api')->get('/room', [RoomController::class, 'index']);
Route::middleware('api')->get('/room/{id}', [RoomController::class, 'specific']);
Route::middleware('api')->get('/roomid/{id}', [RoomController::class, 'getComponentById']);

//Batch Route
Route::middleware('api')->get('/batch', [BatchController::class, 'index']);
Route::middleware('api')->get('/batch/{id}', [BatchController::class, 'specific']);

//Semester Route
Route::middleware('api')->get('/semester', [SemesterController::class, 'index']);
Route::middleware('api')->get('/semester/{id}', [SemesterController::class, 'specific']);

//Subject Route
Route::middleware('api')->get('/subject', [SubjectController::class, 'index']);
Route::middleware('api')->get('/subject/{id}', [SubjectController::class, 'specific']);

//Class Route
Route::middleware('api')->get('/class' , [ClassController::Class, 'index']);
Route::middleware('api')->get('/class/{id}' , [ClassController::Class, 'specific']);

//Date Route
Route::middleware('api')->get('/day' , [DaysController::Class, 'index']);
Route::middleware('api')->get('/day/{id}' , [DaysController::Class, 'specific']);

//Time Route
Route::middleware('api')->get('/time' , [TimeController::Class, 'index']);
Route::middleware('api')->get('/time/{id}' , [TimeController::Class, 'specific']);

//Lecture Route
Route::middleware('api')->get('/lecture' , [LectureController::Class, 'index']);
Route::middleware('api')->get('/lecture/{id}' , [LectureController::Class, 'specific']);
Route::middleware('api')->get('/lectureU/{UserID}' , [LectureController::Class, 'userLectures']);
Route::middleware('api')->get('/lectureR/{RoomID}' , [LectureController::Class, 'roomLectures']);

//Freedom Route
Route::middleware('api')->get('/freedom' , [FreedomController::Class, 'index']);
Route::middleware('api')->get('/freedom/{id}' , [FreedomController::Class, 'specific']);

