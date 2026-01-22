<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PagesController::class, 'home'])->name('pages.home');
Route::get('/monsters/{monster}/{slug}', [\App\Http\Controllers\MonstersController::class, 'show'])->name('monster.show');