<?php

use App\Events\OderShipped;
use App\Http\Controllers\LamController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [OrderController::class, 'index']);
Route::get('/order', [OrderController::class, 'order'])->name('order');
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');


Route::get('y1',[LamController::class, 'y1']);
Route::get('y2',[LamController::class,'y2']);
Route::get('y3',[LamController::class, 'y3']);
Route::get('y4',[LamController::class, 'y4']);
Route::get('y5/{id}',[LamController::class, 'y5']);
Route::get('y6', [LamController::class, 'y6']);
