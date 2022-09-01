<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\WorkController;

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



Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('all-product', [ProductController::class, 'show']);
Route::get('all-employee', [EmployeeController::class, 'all']);
Route::get('single-employee/{id}', [EmployeeController::class, 'single']);


Route::group(['middleware' => ['auth:api']], function() {
   Route::get('profile/{id}', [UserController::class, 'profile']); 
   Route::post('logout', [UserController::class, 'logout']);
   Route::post('add-product', [ProductController::class, 'addProduct']);
   Route::get('single-product/{id}', [ProductController::class, 'singleProduct']);
   Route::get('user-product', [ProductController::class, 'userProduct']);
   Route::post('update-product/{id}', [ProductController::class, 'update']);
   Route::get('delete-product/{id}', [ProductController::class, 'delete']);

   Route::post('add-employee', [EmployeeController::class, 'addEmployee']);
   Route::post('update-employee/{id}', [EmployeeController::class, 'update']);
   Route::get('delete-employee/{id}', [EmployeeController::class, 'delete']);

   Route::post('add-work', [WorkController::class, 'add']);
   Route::post('update-work/{id}', [WorkController::class, 'update']);
   Route::get('delete-work{id}', [WorkController::class, 'delete']);

   Route::get('all-work', [WorkController::class, 'all']);
   Route::get('single-work/{id}', [WorkController::class, 'single']);


 

});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
