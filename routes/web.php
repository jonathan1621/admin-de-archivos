<?php

use Illuminate\Support\Facades\Route;

Route::get('/archivos', [ App\Http\Controllers\ArchivoController::class, 'index'])->name('archivos.index');

Route::resource('archivos', App\Http\Controllers\ArchivoController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () { return view('inicio');})->name('inicio');


Route::get('/archivos', [ App\Http\Controllers\ArchivoController::class, 'index'])->name('archivos.index');

