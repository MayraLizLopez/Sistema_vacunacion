<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VoluntarioController;
use App\Http\Controllers\InstitucionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VaccinationDayController;
use App\Http\Controllers\SedeController;

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

//voluntarios puúlico
Route::get('voluntario/index', [VoluntarioController::class, "index"]);

Route::get('voluntario/create', [VoluntarioController::class, "create"]);

Route::post('voluntario/store', [VoluntarioController::class, "store"]);

Route::get('voluntario/aviso', [VoluntarioController::class, "aviso"])->name('aviso');

//Securitys
Route::get('security/logout', [LoginController::class, "logout"])->name('logout');

Route::post('security/authenticate', [LoginController::class, "authenticate"]);

//Respuesta emails
Route::get('emailVoluntario/{id}', [VoluntarioController::class, "emailConfirmacion"]);

Route::get('emailRechazar/{uuid}', [VaccinationDayController::class, "rechazarJornada"]);

Route::get('emailAceptar/{uuid}', [VaccinationDayController::class, "aceptarJornada"]);

Route::get('emailAceptar/guardar/{uuid}/{turno}', [VaccinationDayController::class, "guardarTurno"])->name('guardarTurno');

Route::get('security/password', [LoginController::class, "password"])->name('password');

Route::get('security/sendPassword/{email}/{pass}', [LoginController::class, "restartPassword"])->name('sendPassword');

//seguridad
Route::group(['middleware' =>['AuthCheck']], function(){
    //login
    Route::get('security/login', [LoginController::class, "login"])->name('login');
    //Index
    Route::get('admin/panel/index', [LoginController::class, "dashboard"]);

    //adminstrador
    Route::get('admin/panel', [AdminController::class, "panel"]);

    //Voluntarios
    Route::get('admin/panel/show', [VoluntarioController::class, "show"])->name('tabla_volu');

    Route::get('admin/panel/voluntario/searchByVoluntaryName/{name}', [VoluntarioController::class, "searchByVoluntaryName"])->name('searchByVoluntaryName');

    Route::get('admin/panel/voluntario/searchByTown/{id}', [VoluntarioController::class, "searchByTown"])->name('searchByTown');

    Route::get('admin/panel/voluntario/searchByCURP/{id}', [VoluntarioController::class, "searchByCURP"])->name('searchByCURP');

    Route::get('admin/panel/voluntario/searchByInstitution/{id}', [VoluntarioController::class, "searchByInstitution"])->name('searchByInstitution');

    Route::get('admin/panel/voluntario/searchByDates/{fecha_inicio}/{fecha_fin}', [VoluntarioController::class, "searchByDates"])->name('searchByDates');

    Route::get('admin/panel/voluntario/searchBySedes/{id}', [VoluntarioController::class, "searchBySedes"])->name('searchByHours');

    Route::get('admin/panel/voluntario/searchByHours/{horas}', [VoluntarioController::class, "searchByHours"])->name('searchBySedes');

    Route::get('admin/panel/voluntario/getAllTowns', [VoluntarioController::class, "getAllTowns"])->name('getAllTowns');

    Route::get('admin/panel/voluntario/getAllInstitutions', [VoluntarioController::class, "getAllInstitutions"])->name('getAllInstitutions');

    Route::get('admin/panel/voluntario/getAllSedes', [VoluntarioController::class, "getAllSedes"])->name('getAllSedes');

    Route::get('admin/panel/voluntario/edit/{id_voluntario}', [VoluntarioController::class, "edit"])->name('editarVoluntarios');

    Route::patch('admin/panel/voluntario/update/{id_voluntario}', [VoluntarioController::class, "update"])->name('updateVoluntarios');

    Route::post('admin/panel/voluntario/destroy/{id_voluntario}', [VoluntarioController::class, "destroy"])->name('destroyVoluntarios');
    
    Route::get('admin/panel/voluntario/create', [VoluntarioController::class, "createAdmin"])->name('crearVoluntario');

    Route::post('voluntario/update', [VoluntarioController::class, "update"]);

    Route::get('admin/panel/voluntario/detalles/{id_voluntario}', [VoluntarioController::class, "getDetalleVoluntario"])->name('getDetalleVoluntario');

    Route::get('admin/panel/voluntario/editarHoras/{id_voluntaro}/{horas}', [VoluntarioController::class, "editarHoras"])->name('editarHoras');

    //Instituciones
    Route::get('admin/panel/institutions', [InstitucionController::class, "show"])->name('tabla_insti');

    Route::get('admin/panel/institutions/edit/{id}', [InstitucionController::class, "edit"])->name('editarInstituciones');

    Route::patch('admin/panel/institutions/update/{id_insti}', [InstitucionController::class, "update"])->name('updateInstitucion');

    Route::post('admin/panel/institutions/destroy/{id_voluntario}', [InstitucionController::class, "destroy"])->name('destroyInstitucion');

    Route::get('admin/panel/institutions/create', [InstitucionController::class, "create"])->name('createInstitucion');

    Route::post('admin/panel/institutions/', [InstitucionController::class, "store"])->name('storeInstitucion');


    //jornada de vacunacion
    Route::get('admin/panel/vaccinationDay', [VaccinationDayController::class, "index"])->name('index');

    Route::post('admin/panel/vaccinationDay/getVoluntariesByInstitution', [VaccinationDayController::class, "getVoluntariesByInstitution"])->name('getVoluntariesByInstitution');

    Route::get('admin/panel/vaccinationDay/getJornadaDetailForEmails/{id_jornada}', [VaccinationDayController::class, "getJornadaDetailForEmails"])->name('getJornadaDetailForEmails');

    Route::get('admin/panel/vaccinationDay/getJornadaDetailForEmails/{id_jornada}', [VaccinationDayController::class, "getJornadaDetailForEmails"])->name('getJornadaDetailForEmails');

    Route::get('admin/panel/vaccinationDay/getAllInstitutions/', [VaccinationDayController::class, "getAllInstitutions"])->name('getAllInstitutions');

    Route::get('admin/panel/vaccinationDay/getAllTowns/', [VaccinationDayController::class, "getAllTowns"])->name('getAllTowns');

    Route::post('admin/panel/vaccinationDay/store/', [VaccinationDayController::class, "store"])->name('store');

    Route::post('admin/panel/vaccinationDay/storeFiles/', [VaccinationDayController::class, "storeFiles"])->name('storeFiles');

    Route::post('admin/panel/vaccinationDay/update/', [VaccinationDayController::class, "update"])->name('update');

    Route::post('admin/panel/vaccinationDay/updateFiles/', [VaccinationDayController::class, "updateFiles"])->name('updateFiles');

    Route::get('admin/panel/vaccinationDay/show/', [VaccinationDayController::class, "show"])->name('show');

    Route::get('admin/panel/vaccinationDay/getAllVolunteersAccepted/{folio}', [VaccinationDayController::class, "getAllVolunteersAccepted"])->name('getAllVolunteersAccepted');

    Route::post('admin/panel/vaccinationDay/destroy/', [VaccinationDayController::class, "destroy"])->name('destroy');

    Route::get('admin/panel/vaccinationDay/getLastJornada/', [VaccinationDayController::class, "getLastJornada"])->name('getLastJornada');

    Route::get('admin/panel/vaccinationDay/getJornada/{id_jornada}', [VaccinationDayController::class, "getJornada"])->name('getJornada');

    Route::get('admin/panel/vaccinationDay/getFilesJornada/{id_jornada}', [VaccinationDayController::class, "getFilesJornada"])->name('getFilesJornada');

    Route::get('admin/panel/vaccinationDay/getJornadaForVoluntaries/{id_jornada}', [VaccinationDayController::class, "getJornadaForVoluntaries"])->name('getJornadaForVoluntaries');

    Route::get('admin/panel/vaccinationDay/getJornadaForSedes/{id_jornada}', [VaccinationDayController::class, "getJornadaForSedes"])->name('getJornadaForSedes');

    Route::get('admin/panel/vaccinationDay/getAllSedesByIdTown/{id_municipio}', [VaccinationDayController::class, "getAllSedesByIdTown"])->name('getAllSedesByIdTown');

    Route::get('admin/panel/vaccinationDay/downloadFiles/', [VaccinationDayController::class, "downloadFiles"])->name('downloadFiles');

    Route::post('admin/panel/vaccinationDay/sendemail/', [VaccinationDayController::class, "enviarCorreoJornada"])->name('enviarCorreo');

    Route::post('admin/panel/vaccinationDay/sendrejectemail/', [VaccinationDayController::class, "enviarCorreoCancelacionJornada"])->name('enviarCorreoCancelacion');

    Route::post('admin/panel/vaccinationDay/agregarQuitarHoras/', [VaccinationDayController::class, "agregarQuitarHoras"])->name('agregarQuitarHoras');
    
    //Perfil
    Route::get('admin/panel/profile', [UsuarioController::class, "show"])->name('perfil');

    Route::get('admin/panel/profile/savePassword/{pass}', [UsuarioController::class, "savePassword"])->name('savePassword');

    //Sedes
    Route::get('admin/panel/sedes/index', [SedeController::class, "show"])->name('tabla_sedes');

    Route::get('admin/panel/sedes/crear', [SedeController::class, "create"])->name('createSede');

    Route::post('admin/panel/sedes/', [SedeController::class, "store"])->name('storeSede');

    Route::get('admin/panel/sedes/editar/{id_sede}', [SedeController::class, "edit"])->name('editarSedes');

    Route::patch('admin/panel/sedes/actualizar/{id_sede}', [SedeController::class, "update"])->name('updateSede');

    Route::post('admin/panel/sedes/eliminar/{id}', [SedeController::class, "destroy"])->name('destroySede');

    Route::get('admin/panel/sedes/detalles/{id_sede}', [SedeController::class, "getDetalleSede"])->name('getDetalleSede');

    Route::post('admin/panel/sedes/coordenadas/', [SedeController::class, "saveCoordenadas"])->name('saveCoordenadas');


    //Usuarios
    Route::get('admin/panel/users/index', [UsuarioController::class, "index"])->name('indexUsers');

    Route::get('admin/panel/users/getAllActiveUsers', [UsuarioController::class, "getAllActiveUsers"])->name('getAllActiveUsers');

    Route::get('admin/panel/users/getAllInactiveUsers', [UsuarioController::class, "getAllInactiveUsers"])->name('getAllInactiveUsers');

    Route::get('admin/panel/users/getAllInstitutions', [UsuarioController::class, "getAllInstitutions"])->name('getAllInstitutions');

    Route::get('admin/panel/users/searchByUser/{name}', [UsuarioController::class, "searchByUser"])->name('searchByUser');

    Route::get('admin/panel/users/searchByRol/{name}', [UsuarioController::class, "searchByRol"])->name('searchByRol');

    Route::get('admin/panel/users/searchByInstitution/{id_institution}', [UsuarioController::class, "searchByInstitution"])->name('searchByInstitution');

    Route::get('admin/panel/users/destroy/{id_user}', [UsuarioController::class, "destroy"])->name('destroy');

    Route::get('admin/panel/users/build/{id_user}', [UsuarioController::class, "build"])->name('build');

    Route::post('admin/panel/users/store/', [UsuarioController::class, "store"])->name('storeUser');

    Route::patch('admin/panel/users/update/{id_user}', [UsuarioController::class, "update"])->name('updateUser');

    Route::get('admin/panel/users/create', [UsuarioController::class, "createAdmin"])->name('createUser');

    Route::get('admin/panel/users/edit/{id_user}', [UsuarioController::class, "edit"])->name('editarUser');

    Route::get('admin/panel/aceptarAviso/{id_user}', [UsuarioController::class, "aceptarAviso"])->name('aceptarAviso');
});
