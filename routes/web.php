<?php

use App\Http\Controllers\GoogleMap\GoogleMapDataController;
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

Route::get('map-route-view/{id}',[GoogleMapDataController::class,'mapRouteView'])->name('map.view');
Route::post('map-data-store',[GoogleMapDataController::class,'store'])->name('map.store');
