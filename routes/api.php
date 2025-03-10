<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
});

Route::prefix('v1')->group(function () {

    Route::get('settings', SettingsController::class);

    Route::get('cities', CityController::class);

    // Route::get('districts/{city}', DistrictController::class);

    Route::get('districts', DistrictController::class); // use query parameters

    Route::post('message', MessageController::class);

    Route::get('domains', DomainController::class);

});

Route::prefix('ads')->controller(AdController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/latest', 'latest');
    Route::get('/domain/{domain_id}', 'domain');
    Route::get('/search', 'search');
});
