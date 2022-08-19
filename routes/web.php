<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
//Route::get('/dashboard', function () {
  //  return view('dashboard');
//})->middleware(['auth'])->name('dashboard');


//Route::group(['middleware' => ['auth']], function() {
   // Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
//});


Route::group(['middleware' => ['auth', 'role:director']], function() {
    Route::get('/dashboard/director',[DashboardController::class, 'director'] )->name('dashboard.director');
});

Route::group(['middleware' => ['auth', 'role:clerk']], function() {
    Route::get('/dashboard/clerk', [DashboardController::class, 'index'])->name('dashboard.clerk');
    Route::get('/farmers', [FarmerController::class, 'index'])->name('farmers.index');
});

Route::group(['middleware' => ['auth', 'role:finance']], function() {
    Route::get('/dashboard/finance', [DashboardController::class, 'index'])->name('dashboard.finance');
});


Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

require __DIR__.'/auth.php';
