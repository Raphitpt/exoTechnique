<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RacesController;
use App\Http\Controllers\TypesController;

// Routes publiques sans authentification
Route::get('/animals', AnimalController::class . '@index')->name('animals.index');
Route::get('/animals/{id}', AnimalController::class . '@show')->name('animals.show');
Route::get('/races/{type_id}', RacesController::class . '@index')->name('races.index');
Route::get('/types', TypesController::class . '@index')->name('types.index');
Route::get('/animals/type/{type_id}', AnimalController::class . '@findByType')->name('animals.types.index');
Route::get('animals/race/{type_id}/{race_id}', AnimalController::class . '@findByRace')->name('animals.races.index');

// Routes CRUD pour les animaux nécessitant une authentification
Route::middleware(['auth:api'])->group(function () {
    Route::post('/animals/save', AnimalController::class . '@save')->name('animals.save');
    Route::post('/animals/{id}', AnimalController::class . '@update')->name('animals.update');
    Route::post('/animals/delete/{id}', AnimalController::class . '@delete')->name('animals.delete');
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
