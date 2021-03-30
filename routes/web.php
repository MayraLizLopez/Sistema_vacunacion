<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoluntarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class);

Route::get('voluntarios/index', [VoluntarioController::class, "index"]);

Route::get('voluntarios/create', [VoluntarioController::class, "create"]);

Route::post('voluntarios/store', [VoluntarioController::class, "store"]);

