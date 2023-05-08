<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('eventos', EventController::class);


// ********Pagina inicial********
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');

// Mostrar listado de eventos
Route::get('/app',[EventController::class,'indexFilter'])->name('eventsFilter');
// Mostrar informacion de un evento
Route::get('/app/event/{id}',[EventController::class,'show'])->name('events.show');


// ACCEDER CUENTA
Route::get('/inicioSesion',[UserController::class,'mostrarInicioSesion'])->name('login');
Route::get('/registro',[UserController::class,'mostrarRegistro'])->name('registro');

Route::post('/validar-registro',[UserController::class,'register'])->name('validar-registro');

Route::post('/inicia-sesion',[UserController::class,'login'])->name('inicia-sesion');

Route::get('/logout',[UserController::class,'logout'])->name('logout');

// Comprobar si tiene mas de un rol
Route::get('/acceso',[UserController::class,'acceso'])->name('acceso');
// Seleccionar el tipo, SI DISPONE VARIOS , si no, entra directamente a parte de VOLUNTARIO
Route::get('/accesoSelecting',[UserController::class,'selectingCuenta'])->name('selectingCuenta');


// ********Parte administrativa para el USUARIO VOLUNTARIO********
Route::get('/cuenta',[UserController::class,'general'])->middleware('auth')->name('cuenta');
Route::get('/cuenta/perfil/',[UserController::class,'show'])->middleware('auth')->name('cuenta.perfil');
Route::get('/cuenta/perfil/editar/',[UserController::class,'edit'])->middleware('auth')->name('cuenta.edit');
Route::patch('/cuenta/perfil/editars/',[UserController::class,'updateUserV'])->middleware('auth')->name('cuenta.update');

Route::get('/cuenta/perfil/cambiopassword/',[UserController::class,'cambiopassword'])->middleware('auth')->name('cuenta.pass.edit');
Route::patch('/cuenta/perfil/cambiopassword/',[UserController::class,'updatepassword'])->middleware('auth')->name('cuenta.pass.update');

Route::get('/cuenta/perfil/eventos',[UserController::class,'showEventos'])->middleware('auth')->name('cuenta.eventos');

// Eliminar la participacion al evento el usuario que este iniciado sesion
Route::delete('/cuenta/perfil/eliminarParticipante/{id}',[EventController::class,'destroyParticipante'])->middleware('auth')->name('event.destroyParticipante');

// PARTE DE ADMINISTRACION
// Route::get('/admin/perfil',[UserController::class,'show'])->middleware('auth')->parameter(Auth::user()->id)->name('perfil');
// ELIMINAR
// Route::get('/admin/perfil/',[AdminController::class,'show'])->middleware('auth')->name('perfil');
// Route::get('/admin/perfil/editar/',[AdminController::class,'edit'])->middleware('auth')->name('admin.user.edit');
// Route::patch('/admin/perfil/editars/',[AdminController::class,'updateUser'])->middleware('auth')->name('admin.user.update');
// END_ELIMINAR


// ********ADMINISTRACION DEL ONG********
    // ONG
Route::get('/admin/ong',[OrganisationController::class,'showModeAdmin'])->middleware('auth')->name('admin.ong');
Route::get('/admin/ong/edit',[OrganisationController::class,'showModeAdminEdit'])->middleware('auth')->name('admin.ong.edit');
Route::patch('/admin/ong/editar/',[OrganisationController::class,'ModeAdminONGUpdate'])->middleware('auth')->name('admin.ong.update');
// Route::patch('/admin/perfil/actualizar/',[UserController::class,'update'])->middleware('auth')->name('users.update');

    // Eventos
Route::get('/admin/ong/event',[EventController::class,'indexEventsONG'])->middleware('auth')->name('admin.ong.event.index');
        // Crear
Route::get('/admin/ong/event/new',[EventController::class,'create'])->middleware('auth')->name('admin.ong.event.create');
Route::post('/admin/ong/event/new',[EventController::class,'store'])->middleware('auth')->name('admin.ong.event.store');
        // Editar
Route::get('/admin/ong/event/edit/{id}',[EventController::class,'edit'])->middleware('auth')->name('admin.ong.event.edit');
Route::patch('/admin/ong/event/update/{id}',[EventController::class,'update'])->middleware('auth')->name('admin.ong.event.update');
        // Eliminar
Route::delete('/admin/ong/event/delete/{id}',[EventController::class,'destroy'])->middleware('auth')->name('admin.ong.event.destroy');

// ADMINISTRACION EVENTOS admin.ong.index
// Route::get('/admin/ong/events',[OrganisationController::class,'showModeAdminEdit'])->middleware('auth')->name('admin.ong.edit');
    //Asignacion Usuarios
// Route::get('/admin/ong/usersAssign',[OrganisationController::class,'ongUsers'])->middleware('auth')->name('NOMBREFALTA');



// ********SUPERADMIN.********
    // General
Route::get('/admin',AdminController::class)->middleware('auth')->name('Admin');
    // ONGs (index, crear, eliminar)
Route::get('/admin/ongs',[OrganisationController::class,'index'])->middleware('auth')->name('admin.ong.index');
Route::get('/admin/ongs/new',[OrganisationController::class,'create'])->middleware('auth')->name('admin.ong.create');
Route::post('/admin/ongs/new',[OrganisationController::class,'store'])->middleware('auth')->name('admin.ong.store');

Route::delete('/admin/ongs/delete/{id}',[OrganisationController::class,'destroy'])->middleware('auth')->name('admin.ong.destroy');
Route::get('/admin/ong/{id}',[OrganisationController::class,'show'])->middleware('auth')->name('admin.ong.show');
Route::get('/admin/ongs/edit/{id}',[OrganisationController::class,'edit'])->middleware('auth')->name('admin.ong.edit');

    // Usuarios (index, crear, eliminar)
Route::get('/admin/users',[UserController::class,'index'])->middleware('auth')->name('admin.users.index');




// Route::resource('ong',OrganisationController::class)->middleware('auth');
