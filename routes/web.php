<?php

use App\Http\Controllers\ImageController;

Route::get('/', [ImageController::class, 'index'])->name('images.index');
Route::post('/upload', [ImageController::class, 'store'])->name('images.store');
