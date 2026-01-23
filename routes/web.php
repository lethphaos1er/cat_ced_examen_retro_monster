<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MonstersController;

use Illuminate\Support\Facades\DB;
use App\Models\monster;

Route::get('/', [PagesController::class, 'home'])->name('home');

Route::get('/monsters/{monster}/{slug?}', [MonstersController::class, 'show'])
    ->name('monster.show');

Route::get('/post/create', [MonstersController::class, 'create'])
    ->name('monster.create');

Route::post('/post', [MonstersController::class, 'store'])
    ->name('monster.store');


Route::get('/db-test', function () {
    return DB::table('monsters')->count();
});

Route::get('/_debug/db', function () {
    return response()->json([
        'app_env' => env('APP_ENV'),
        'db_connection' => config('database.default'),
        'db_host' => config('database.connections.pgsql.host'),
        'db_database' => config('database.connections.pgsql.database'),
        'current_database' => DB::selectOne('select current_database() as db')->db ?? null,
        'current_schema' => DB::selectOne('select current_schema() as schema')->schema ?? null,
        'monsters_count' => monster::count(),
        'monster_types_count' => DB::table('monster_types')->count(),
        'rareties_count' => DB::table('rareties')->count(),
    ]);
});