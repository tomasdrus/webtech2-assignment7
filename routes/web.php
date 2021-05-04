<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


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

Route::get('/',[MainController::class, 'index'])->name('weather');
Route::get('/position',[MainController::class, 'position'])->name('position');
Route::get('/statistics',[MainController::class, 'statistics'])->name('statistics');
Route::get('/country/{name}',[MainController::class, 'country'])->name('country');
Route::get('/coordinates',[MainController::class, 'coordinates'])->name('coordinates');
