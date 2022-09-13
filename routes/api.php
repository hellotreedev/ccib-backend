<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChambersController;
use App\Http\Controllers\RennovationController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\EServicesController;
use App\Http\Controllers\LegislationController;
use App\Http\Controllers\DirectoryController;




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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/general', [GeneralController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/chambers', [ChambersController::class, 'index']);
Route::get('/rennovation', [RennovationController::class, 'index']);
Route::get('/board-directors', [BoardController::class, 'index']);
Route::get('/services', [ServicesController::class, 'index']);
Route::get('/e-services', [EServicesController::class, 'index']);
Route::get('/legislation', [LegislationController::class, 'index']);
Route::get('/directory', [DirectoryController::class, 'index']);









