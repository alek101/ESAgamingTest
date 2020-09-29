<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\ArmiesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [GamesController::class, 'index']);

Route::prefix('/games')->group(function()
{
    Route::get('/index',[GamesController::class, 'index']);
    Route::get('/store',[GamesController::class, 'store']);
});

Route::prefix('/armies')->group(function()
{
    Route::get('/index/{id}',[ArmiesController::class, 'index']);
    Route::get('/create/{id}',[ArmiesController::class, 'create']);
    Route::post('/store',[ArmiesController::class, 'store']);
});

