<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LinkController::class, 'index'])->name('links.index');

Route::resource('links', LinkController::class)->except('index');
Route::resource('tags', TagController::class);
