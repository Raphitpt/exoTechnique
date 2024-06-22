<?php

use Illuminate\Support\Facades\Route;
use App\Models\Animal;


Route::get('/', function () {
    return view('app');
});
