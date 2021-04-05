<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VoluntarioController;
use App\Http\Controllers\InstitucionController;
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

//Route::post('voluntario/destroy', [VoluntarioController::class, "destroy"]);

//Securitys

Route::get('security/logout', [LoginController::class, "logout"])->name('logout');

Route::post('security/authenticate', [LoginController::class, "authenticate"]);


Route::group(['middleware' =>['AuthCheck']], function(){
    Route::get('security/login', [LoginController::class, "login"])->name('login');
    //Index
    Route::get('admin/panel/index', [LoginController::class, "dashboard"]);

    //adminstrador
    Route::get('admin/panel', [AdminController::class, "panel"]);

    Route::get('admin/panel/show', [VoluntarioController::class, "show"]);

    Route::get('admin/panel/institutions', [InstitucionController::class, "show"])->name('tabla_insti');

    Route::get('admin/panel/voluntario/edit/{id_voluntario}', [VoluntarioController::class, "edit"])->name('editarVoluntarios');

    Route::patch('admin/panel/voluntario/update/{id_voluntario}', [VoluntarioController::class, "update"])->name('updateVoluntarios');

    Route::patch('admin/panel/voluntario/destroy/{id_voluntario}', [VoluntarioController::class, "destroy"])->name('destroyVoluntarios');

    Route::get('admin/panel/institutions/edit/{id}', [InstitucionController::class, "edit"])->name('editarInstituciones');

    Route::patch('admin/panel/institutions/update/{id_insti}', [InstitucionController::class, "update"])->name('updateInstitucion');

    Route::get('admin/panel/institutions/create', [InstitucionController::class, "create"])->name('createInstitucion');

    Route::post('admin/panel/institutions/', [InstitucionController::class, "store"])->name('storeInstitucion');

    Route::post('voluntario/update', [VoluntarioController::class, "update"]);


});
