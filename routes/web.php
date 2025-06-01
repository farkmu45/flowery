<?php

use App\Http\Controllers\FlowerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $menuDashboard = 'active';

        return view('dashboard', compact('menuDashboard'));
    });

    Route::resource('flower', FlowerController::class)
        ->middleware('auth');
});

require __DIR__.'/auth.php';
