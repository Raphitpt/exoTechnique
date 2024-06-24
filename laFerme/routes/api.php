<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Routes publiques sans authentification
Route::get('/animals', AnimalController::class . '@index')->name('animals.index');
Route::get('/animals/{id}', AnimalController::class . '@show')->name('animals.show');

// Routes CRUD pour les animaux nécessitant une authentification
Route::middleware(['auth:api'])->group(function () {
    Route::post('/animals/save', AnimalController::class . '@save')->name('animals.save');
    Route::put('/animals/{id}', AnimalController::class . '@update')->name('animals.update');
    Route::delete('/animals/{id}', AnimalController::class . '@delete')->name('animals.delete');
});


// Routes d'authentification
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', AuthController::class . '@login')->name('login');
    Route::post('logout', AuthController::class .  '@logout')->name('logout');
    Route::post('refresh', AuthController::class . '@refresh')->name('refresh');
    Route::post('me', AuthController::class . '@me')->name('me');
});
