<?php

use Illuminate\Support\Facades\Route;
use App\Models\Animal;

Route::get('/images/{filename}', function ($filename) {
    $path = public_path('storage/images/' . $filename);

    return response()->file($path);
});

// Route générique pour toutes les autres requêtes
Route::view('/{any}', 'app')->where('any', '.*');
