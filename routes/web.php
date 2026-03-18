<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::get('/', [DocumentController::class, 'landing'])->name('landing');
Route::get('/quotation', [DocumentController::class, 'index'])->name('quotation.page');
Route::post('/generate', [DocumentController::class, 'generate'])->name('generate.pdf');

// Category pages
Route::view('/business-docs', 'business-docs')->name('business.docs');
Route::view('/career-docs', 'career-docs')->name('career.docs');
Route::view('/general-docs', 'general-docs')->name('general.docs');

// All tools page
Route::view('/all-tools', 'all-tools')->name('all.tools');