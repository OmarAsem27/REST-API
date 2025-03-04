<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    Route::get('settings', SettingsController::class);

    Route::get('cities', CityController::class);

    // Route::get('districts/{city}', DistrictController::class);

    Route::get('districts', DistrictController::class); // use query parameters

    Route::post('message', MessageController::class);

});
