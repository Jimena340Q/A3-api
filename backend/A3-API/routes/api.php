<?php

use App\Models\EnvironmentType;
use App\Models\Instructor;
use App\Models\LearningEnvironment;
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

Route::apiResource('environmet_type',EnvironmentType::class);
Route::apiResource('instructor',Instructor::class);
Route::apiResource('learning_environment',LearningEnvironment::class);