<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

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
    return view('welcome');        //default route
});

Route::get('/weather', [WeatherController::class, 'index']);
Route::get('/weather/search', [WeatherController::class, 'getWeather'])->name('weather.search');
Route::post('/weather', [WeatherController::class, 'getWeather'])->name('getWeather');
