<?php

use App\Http\Controllers\AfiliadosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

/**
 * WEB ROUTES
 */
Route::view('/', [HomeController::class, 'home'])->name('home');
Route::view('quienes-somos', [HomeController::class, 'aboutus'])->name('about');
Route::view('servicios', [HomeController::class, 'services'])->name('services');
Route::view('afiliacion', [HomeController::class, 'affiliation'])->name('affiliation');
Route::view('noticias', [HomeController::class, 'news'])->name('news');
Route::view('contacto', [HomeController::class, 'contact'])->name('contact');

/**
 * AUTH ROUTES
 */
Route::middleware('guest')->group(function() {
  Route::get('login', [AuthController::class, 'loginForm'])->name('auth.loginForm');
  Route::post('login', [AuthController::class, 'login'])->name('auth.login');
  Route::get('registro/{confirmation_code?}', [AuthController::class, 'registerForm'])->name('auth.registerForm');
  Route::post('register', [AuthController::class, 'register'])->name('auth.register');
});
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::view('dashboard', 'dashboard.index')
  ->name('dashboard')
  ->middleware('auth');

Route::get('afiliados/solicitar', [AfiliadosController::class, 'requestForm'])->name('afiliados.requestForm');
Route::post('afiliados/solicitar', [AfiliadosController::class, 'request'])->name('afiliados.request');
Route::resource('afiliados', AfiliadosController::class);
Route::post('correo_afiliado/{afiliado}', [AfiliadosController::class, 'sendConfirmationEmail'])->name('afiliados.sendConfirmationEmail');

Route::resource('notificaciones', NotificationController::class)->names('notifications');
Route::resource('facturas', InvoiceController::class)
  ->names('invoices')
  ->parameters([ 'facturas' => 'invoice' ]);
Route::resource('noticias', NoticiaController::class);

Route::resource('categorias', CategoryController::class)
  ->names('categories');

/**
 * MANAGE FILES
 */
Route::get('uploads/{dir}/{path}', [FileController::class, 'getFile'])
  ->middleware('auth')
  ->name('files.getFile');
