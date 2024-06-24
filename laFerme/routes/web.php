<?php

use Illuminate\Support\Facades\Route;
use App\Models\Animal;

Route::view('/{any}', 'app')->where('any', '.*');
