<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'form'])->name('pdf.form');
Route::post('/gerar-pdf', [HomeController::class, 'gerar'])->name('pdf.gerar');
