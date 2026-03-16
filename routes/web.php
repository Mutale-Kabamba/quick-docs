<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::get('/', [DocumentController::class, 'index']);
Route::post('/generate', [DocumentController::class, 'generate'])->name('generate.pdf');
