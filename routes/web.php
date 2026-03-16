<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::get('/', [DocumentController::class, 'landing'])->name('landing');
Route::get('/quotation', [DocumentController::class, 'index'])->name('quotation.page');
Route::post('/generate', [DocumentController::class, 'generate'])->name('generate.pdf');