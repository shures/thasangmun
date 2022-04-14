<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post("login",[UserController::class,'login']);
Route::post("register",[UserController::class,'register']);
Route::post("changePassword",[UserController::class,'changePassword']);
Route::post("logout",[UserController::class,'logout']);

Route::post("getDashboard",[ProjectController::class,'getDashboard']);
Route::post("putData",[ProjectController::class,'putData']);

Route::post("getOptionRecord",[ProjectController::class,'getOptionRecord']);
Route::post("getProject",[ProjectController::class,'getProject']);
Route::post("getDetail",[ProjectController::class,'getDetail']);
Route::post("putDetail",[ProjectController::class,'putDetail']);
Route::post("deleteDetail",[ProjectController::class,'deleteDetail']);
Route::post("getSearch",[ProjectController::class,'getSearch']);
Route::post("getSifaris",[ProjectController::class,'getSifaris']);
Route::get("projects",[ProjectController::class,'projects']);
Route::delete("project",[ProjectController::class,'deleteProject']);
Route::post("updateSetting",[ProjectController::class,'updateSetting']);
Route::post("getSetting",[ProjectController::class,'getSetting']);
//Route::post("dbBackup",[DBBackupController::class,'dbBackup']);
