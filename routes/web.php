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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');

Route::resource('eventos', \App\Http\Controllers\EventController::class);

Route::get('/app',[App\Http\Controllers\EventController::class,'indexFilter'])->name('eventsFilter');
Route::get('/app/event/{id}',[App\Http\Controllers\EventController::class,'show'])->name('events.show'); //Falta por hacer!!!

// Route::get('/app/create-event',)

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ACCEDER CUENTA
Route::get('/inicioSesion',[UserController::class,'mostrarInicioSesion'])->name('login');
Route::get('/registro',[UserController::class,'mostrarRegistro'])->name('registro');

Route::post('/validar-registro',[UserController::class,'register'])->name('validar-registro');

Route::post('/inicia-sesion',[UserController::class,'login'])->name('inicia-sesion');

Route::get('/logout',[UserController::class,'logout'])->name('logout');

// PARTE DE ADMINISTRACION
// Route::get('/admin/perfil',[UserController::class,'show'])->middleware('auth')->parameter(Auth::user()->id)->name('perfil');

Route::get('/admin',AdminController::class)->middleware('auth')->name('Admin');
Route::get('/admin/perfil/',[AdminController::class,'show'])->middleware('auth')->name('perfil');
Route::get('/admin/perfil/editar/',[AdminController::class,'edit'])->middleware('auth')->name('admin.user.edit');
Route::patch('/admin/perfil/editars/',[AdminController::class,'updateUser'])->middleware('auth')->name('admin.user.update');
Route::delete('/admin/perfil/eliminarParticipante/{id}',[EventController::class,'destroyParticipante'])->middleware('auth')->name('event.destroyParticipante');


// ADMINISTRACION ONG
// Route::get('/admin/ong',[OrganisationController::class,'showModeAdmin'])->middleware('auth')->name('admin.ong');
Route::get('/admin/ong/edit',[OrganisationController::class,'showModeAdminEdit'])->middleware('auth')->name('admin.ong.edit');
Route::patch('/admin/ong/editar/',[OrganisationController::class,'ModeAdminONGUpdate'])->middleware('auth')->name('admin.ong.update');
// Route::patch('/admin/perfil/actualizar/',[UserController::class,'update'])->middleware('auth')->name('users.update');

// ADMINISTRACION EVENTOS admin.ong.index
// Route::get('/admin/ong/events',[OrganisationController::class,'showModeAdminEdit'])->middleware('auth')->name('admin.ong.edit');

// SUPERADMIN
Route::get('/admin/ongs',[OrganisationController::class,'index'])->middleware('auth')->name('admin.ong.index');
Route::get('/admin/ongs/new',[OrganisationController::class,'create'])->middleware('auth')->name('admin.ong.create');
Route::delete('/admin/ongs/delete/{id}',[OrganisationController::class,'destroy'])->middleware('auth')->name('admin.ong.destroy');
Route::get('/admin/ong/{id}',[OrganisationController::class,'show'])->middleware('auth')->name('admin.ong.show');
Route::get('/admin/ongs/edit/{id}',[OrganisationController::class,'edit'])->middleware('auth')->name('admin.ong.edit');


Route::post('/admin/ongs/new',[OrganisationController::class,'store'])->middleware('auth')->name('admin.ong.store');

// Route::get('/admin/ong/usersAssign',[OrganisationController::class,'ongUsers'])->middleware('auth')->name('NOMBREFALTA');


// Route::resource('ong',OrganisationController::class)->middleware('auth');
