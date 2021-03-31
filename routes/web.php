<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::get('/', HomeController::class)->name('home');

//voluntarios
Route::get('voluntario/index', [VoluntarioController::class, "index"]);

Route::get('voluntario/create', [VoluntarioController::class, "create"]);

Route::post('voluntario/store', [VoluntarioController::class, "store"]);

Route::get('admin/panel/show', [VoluntarioController::class, "show"]);

//adminstrador
Route::get('admin/panel', [AdminController::class, "panel"]);

Route::get('admin/panel/index', [AdminController::class, "index"]);

Route::get('admin/panel/voluntaries', [AdminController::class, "voluntaries"]);

//Security
Route::get('security/login', [LoginController::class, "login"])->name('login');

Route::post('security/authenticate', [LoginController::class, "authenticate"]);