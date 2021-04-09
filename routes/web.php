<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VoluntarioController;
use App\Http\Controllers\InstitucionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VaccinationDayController;

use App\Mail\SaveVoluntario;
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

//Securitys
Route::get('security/logout', [LoginController::class, "logout"])->name('logout');

Route::post('security/authenticate', [LoginController::class, "authenticate"]);

Route::get('emailVoluntario/{id}', [VoluntarioController::class, "emailConfirmacion"]);

Route::group(['middleware' =>['AuthCheck']], function(){
    Route::get('security/login', [LoginController::class, "login"])->name('login');
    //Index
    Route::get('admin/panel/index', [LoginController::class, "dashboard"]);

    //adminstrador
    Route::get('admin/panel', [AdminController::class, "panel"]);

    Route::get('admin/panel/show', [VoluntarioController::class, "show"])->name('tabla_volu');

    Route::get('admin/panel/institutions', [InstitucionController::class, "show"])->name('tabla_insti');

    Route::get('admin/panel/voluntario/searchByVoluntaryName/{name}', [VoluntarioController::class, "searchByVoluntaryName"])->name('searchByVoluntaryName');

    Route::get('admin/panel/voluntario/searchByTown/{id}', [VoluntarioController::class, "searchByTown"])->name('searchByTown');

    Route::get('admin/panel/voluntario/searchByInstitution/{id}', [VoluntarioController::class, "searchByInstitution"])->name('searchByInstitution');

    Route::get('admin/panel/voluntario/getAllTowns', [VoluntarioController::class, "getAllTowns"])->name('getAllTowns');

    Route::get('admin/panel/voluntario/getAllInstitutions', [VoluntarioController::class, "getAllInstitutions"])->name('getAllInstitutions');

    Route::get('admin/panel/voluntario/edit/{id_voluntario}', [VoluntarioController::class, "edit"])->name('editarVoluntarios');

    Route::patch('admin/panel/voluntario/update/{id_voluntario}', [VoluntarioController::class, "update"])->name('updateVoluntarios');

    Route::post('admin/panel/voluntario/destroy/{id_voluntario}', [VoluntarioController::class, "destroy"])->name('destroyVoluntarios');
    
    Route::get('admin/panel/voluntario/create', [VoluntarioController::class, "createAdmin"])->name('crearVoluntario');

    Route::post('voluntario/update', [VoluntarioController::class, "update"]);

    Route::get('admin/panel/institutions/edit/{id}', [InstitucionController::class, "edit"])->name('editarInstituciones');

    Route::patch('admin/panel/institutions/update/{id_insti}', [InstitucionController::class, "update"])->name('updateInstitucion');

    Route::post('admin/panel/institutions/destroy/{id_voluntario}', [InstitucionController::class, "destroy"])->name('destroyInstitucion');

    Route::get('admin/panel/institutions/create', [InstitucionController::class, "create"])->name('createInstitucion');

    Route::post('admin/panel/institutions/', [InstitucionController::class, "store"])->name('storeInstitucion');


    //jornada de vacunacion
    Route::get('admin/panel/vaccinationDay', [VaccinationDayController::class, "index"])->name('index');

    Route::get('admin/panel/vaccinationDay/getAllVoluntantiesByActive/{id_institution}', [VaccinationDayController::class, "getAllVoluntantiesByActive"])->name('getAllVoluntantiesByActive');

    Route::get('admin/panel/vaccinationDay/getJornadaDetail/{id_jornada}', [VaccinationDayController::class, "getJornadaDetail"])->name('getJornadaDetail');

    Route::get('admin/panel/vaccinationDay/getAllInstitutions/', [VaccinationDayController::class, "getAllInstitutions"])->name('getAllInstitutions');

    Route::post('admin/panel/vaccinationDay/store/', [VaccinationDayController::class, "store"])->name('store');

    Route::post('admin/panel/vaccinationDay/update/', [VaccinationDayController::class, "update"])->name('update');

    Route::get('admin/panel/vaccinationDay/show/', [VaccinationDayController::class, "show"])->name('show');

    Route::post('admin/panel/vaccinationDay/destroy/', [VaccinationDayController::class, "destroy"])->name('destroy');

    Route::get('admin/panel/vaccinationDay/getLastJornada/', [VaccinationDayController::class, "getLastJornada"])->name('getLastJornada');

    Route::get('admin/panel/vaccinationDay/getJornada/{id_jornada}', [VaccinationDayController::class, "getJornada"])->name('getJornada');

    Route::post('admin/panel/vaccinationDay/sendemail/', [VaccinationDayController::class, "enviarCorreoJornada"])->name('enviarCorreo');

    Route::post('admin/panel/vaccinationDay/email/rechazar', [VaccinationDayController::class, "rechazarJornada"])->name('rechazarJornada');

    Route::post('admin/panel/vaccinationDay/email/aceptar', [VaccinationDayController::class, "aceptarJornada"])->name('aceptarJornada');
    
    //Perfil
    Route::get('admin/panel/profile', [UsuarioController::class, "show"])->name('perfil');

    Route::post('admin/panel/profile/savePassword', [UsuarioController::class, "savePassword"])->name('savePassword');

});
