<?php

use Illuminate\Support\Facades\Route;


Route::get('/images/{filename}', function ($filename) {
    $path = public_path('storage/images/' . $filename);

    return response()->file($path);
});

Route::view('/{any}', 'app')->where('any', '.*');
