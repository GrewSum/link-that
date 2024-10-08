<?php

use App\Http\Controllers\TagAssignmentController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LinkController::class, 'index'])->name('links.index');

Route::resource('links', LinkController::class)->except('index');
Route::resource('tags', TagController::class);

Route::get('assign/{tag}', [TagAssignmentController::class, 'show'])->name('assign.show');
Route::post('assign/{tag}', [TagAssignmentController::class, 'store'])->name('assign.store');
