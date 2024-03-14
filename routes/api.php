<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

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


Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:api')->get('/api/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['role:admin']], function () {
    //
    Route::post('/courses', [CourseController::class, 'store'])->middleware('auth:api');
    Route::post('/getPermissions', [CourseController::class, 'showPermissions'])->middleware('auth:api');
});
