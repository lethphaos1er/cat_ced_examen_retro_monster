<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MonstersController;

Route::get('/', [PagesController::class, 'home'])->name('home');

Route::get('/monsters/{monster}/{slug?}', [MonstersController::class, 'show'])
    ->name('monster.show');

Route::get('/post/create', [MonstersController::class, 'create'])
    ->name('monster.create');

Route::post('/post', [MonstersController::class, 'store'])
    ->name('monster.store');
