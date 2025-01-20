<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiclesController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\Cors;

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

Route::middleware(['web'])->group(function() {
Route::group(['middleware' => Cors::class], function () {

// Route::middleware(['cors'])->group(function () {
    Route::get('/', [VehiclesController::class, 'show'])->name('vehicle.show');
    Route::post('/vehicle/save', [VehiclesController::class, 'save']);
    Route::post('/vehicle/delete', [VehiclesController::class, 'delete']);
});

});