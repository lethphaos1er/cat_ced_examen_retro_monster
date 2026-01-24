<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MonstersController;


Route::get('/', [PagesController::class, 'home'])->name('home');

Route::get('/monsters/{monster}/{slug?}', [MonstersController::class, 'show'])
    ->name('monster.show');

Route::get('/post/create', [MonstersController::class, 'create'])
    ->name('monster.create');

Route::get('/post/{monster}/edit', [MonstersController::class, 'edit'])
    ->name('monster.edit');

Route::patch('/post/{monster}', [MonstersController::class, 'update'])
    ->name('monster.update');

Route::delete('/post/{monster}', [MonstersController::class, 'destroy'])
    ->name('monster.destroy');

Route::post('/post', [MonstersController::class, 'store'])
    ->name('monster.store');
