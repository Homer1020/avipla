<?php

use App\Http\Controllers\AfiliadosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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
  Route::get('register', [AuthController::class, 'registerForm'])->name('auth.registerForm');
  Route::get('login', [AuthController::class, 'loginForm'])->name('auth.loginForm');
  Route::post('register', [AuthController::class, 'register'])->name('auth.register');
  Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::view('dashboard', 'dashboard.index')->name('dashboard');

/**
 * AFILIADOS ROUTES
 */
Route::resource('afiliados', AfiliadosController::class);
Route::resource('notificaciones', NotificationController::class)->names('notifications');