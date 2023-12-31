<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;

Route::view('/', 'home')->name('home');

Route::get('/download-and-save-images', [ImageController::class, 'downloadAndSaveImages'])
    ->name('download.images');
