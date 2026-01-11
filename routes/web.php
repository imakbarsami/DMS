<?php

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

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::resource('drivers', 'Driver\DriverController');

// driver problem routes
Route::get('drivers/{id}/report-problem', 'Driver\DriverProblemController@create')->name('driver-problems.create');
Route::post('driver-problems/store', 'Driver\DriverProblemController@store')->name('driver-problems.store');
Route::get('driver-problems/{id}', 'Driver\DriverProblemController@show')->name('driver-problems.show');
Route::get('driver-problems/{id}/edit', 'Driver\DriverProblemController@edit')->name('driver-problems.edit');
Route::put('driver-problems/{id}', 'Driver\DriverProblemController@update')->name('driver-problems.update');
Route::delete('driver-problems/{id}', 'Driver\DriverProblemController@destroy')->name('driver-problems.destroy');