<?php

<<<<<<< HEAD
use App\Models\EnvironmentType;
use App\Models\Instructor;
use App\Models\LearningEnvironment;
=======
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SchedulingEnvironmentController;
>>>>>>> e3f21cdf7acd3a7c04555b91180456eb584e5f49
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<<<<<<< HEAD
Route::apiResource('environmet_type',EnvironmentType::class);
Route::apiResource('instructor',Instructor::class);
Route::apiResource('learning_environment',LearningEnvironment::class);
=======
Route::apiResource('location' , LocationController::class);
Route::apiResource('scheduling_environment' , SchedulingEnvironmentController::class);

>>>>>>> e3f21cdf7acd3a7c04555b91180456eb584e5f49
