<?php

use App\Events\OderShipped;
use App\Http\Controllers\LamController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    OderShipped::dispatch('okok');
    dd(1);
});


Route::get('y1',[LamController::class, 'y1']);
Route::get('y2',[LamController::class,'y2']);
Route::get('y3',[LamController::class, 'y3']);
Route::get('y4',[LamController::class, 'y4']);
Route::get('y5/{id}',[LamController::class, 'y5']);
Route::get('y6', [LamController::class, 'y6']);
