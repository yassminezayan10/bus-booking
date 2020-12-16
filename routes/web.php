<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login','App\Http\Controllers\UsersController@loginForm');
Route::post('/login','App\Http\Controllers\UsersController@loginHandle');
Route::get('/register','App\Http\Controllers\UsersController@registerForm');
Route::post('/register','App\Http\Controllers\UsersController@registerHandle');
Route::get('/logout','App\Http\Controllers\UsersController@logout');

Route::group( ['middleware' => ['auth'] ], function(){
Route::get('/book','App\Http\Controllers\TripController@bookView');
Route::post('/book','App\Http\Controllers\Tripcontroller@bookTrip');

Route::get('/seats','App\Http\Controllers\BookingController@ticketView');
Route::post('/book/fetch','App\Http\Controllers\RegionsController@fetch')->name('RegionsController.fetch');

Route::get('/book','App\Http\Controllers\Tripcontroller@availableSeats');
Route::post('/trip/fetch','App\Http\Controllers\TripController@fetch')->name('TripController.fetch');



});
//create bus
Route::middleware('is_admin')->group(function(){
 Route::get('/bus','App\Http\Controllers\TripController@create');
Route::post('/bus','App\Http\Controllers\Tripcontroller@createHandle');
Route::get('/reset','App\Http\Controllers\TripController@reset');
Route::post('/reset','App\Http\Controllers\Tripcontroller@resetHandle');

});
