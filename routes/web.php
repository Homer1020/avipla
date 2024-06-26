<?php

use App\Http\Controllers\AfiliadosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoletinesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * WEB ROUTES
 */
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::view('quienes-somos', [HomeController::class, 'aboutus'])->name('about');
Route::view('servicios', [HomeController::class, 'services'])->name('services');
Route::view('afiliacion', [HomeController::class, 'affiliation'])->name('affiliation');
Route::view('contacto', [HomeController::class, 'contact'])->name('contact');

/**
 * AUTH ROUTES
 */
Route::middleware('guest')->group(function() {
  Route::get('login', [AuthController::class, 'loginForm'])->name('auth.loginForm');
  Route::post('login', [AuthController::class, 'login'])->name('auth.login');
  Route::get('registro/{confirmation_code?}', [AuthController::class, 'registerForm'])->name('auth.registerForm');
  Route::post('register', [AuthController::class, 'register'])->name('auth.register');
  
  Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
  Route::post('/forgot-password', [AuthController::class, 'sendPasswordEmail'])->name('password.email');
  Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
  Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::view('dashboard', 'dashboard.index')
  ->name('dashboard')
  ->middleware(['auth']);

Route::middleware(['auth'])->group(function() {
  Route::get('afiliados/solicitar', [SolicitudController::class, 'requestForm'])
    ->name('afiliados.requestForm');
  Route::post('afiliados/solicitar', [SolicitudController::class, 'request'])
    ->name('afiliados.request');
  Route::post('afiliados/solicitud/{solicitud}/recordatorio', [SolicitudController::class, 'reminder'])
    ->name('afiliados.reminder');
  Route::resource('afiliados', AfiliadosController::class)
    ->except(['create', 'store']);
});

Route::resource('usuarios', UserController::class)
  ->middleware(['auth', 'is_admin'])
  ->parameters(['usuarios' => 'user'])
  ->names('users');

Route::get('perfil', [ProfileController::class, 'show'])->name('profile.show');
Route::put('perfil', [ProfileController::class, 'update'])->name('profile.update');

Route::get('mi-empresa', [ProfileController::class, 'businessShow'])->name('business.show');
Route::put('mi-empresa', [ProfileController::class, 'update'])->name('business.update');

Route::resource('roles', RoleController::class)
  ->middleware(['auth', 'is_admin']);

Route::resource('boletines', BoletinesController::class);

Route::get('notificaciones', [NotificationController::class, 'index'])
  ->name('notifications.index')
  ->middleware(['auth']);
Route::post('notificaciones', [NotificationController::class, 'markAllAsRead'])
  ->name('notifications.markAllAsRead');

Route::resource('facturas', InvoiceController::class)
  ->names('invoices')
  ->parameters(['facturas' => 'invoice'])
  ->middleware('auth');

/**
 * NEWS ROUTES
 */
Route::resource('noticias', NoticiaController::class)
  ->except(['show'])
  ->middleware(['auth', 'is_admin']);
Route::get('noticias-avipla', [HomeController::class, 'news'])->name('news');
Route::get('noticias/{noticia}', [HomeController::class, 'newsItem'])->name('news.item');

Route::resource('categorias', CategoryController::class)
  ->names('categories')
  ->parameters(['categorias' => 'category'])
  ->except(['show'])
  ->middleware(['auth', 'is_admin']);

/**
 * PAYMENTS ROUTES
 */
Route::get('pagos/{invoice}/detalle', [PagoController::class, 'invoiceDetails'])
  ->name('pagos.invoice');
Route::get('pagos/{invoice}/pagar', [PagoController::class, 'payInvoice'])
  ->name('pagos.pay_invoice');
Route::get('pagos/{invoice}/modificar', [PagoController::class, 'updatePay'])
  ->name('pagos.update_pay');
Route::resource('pagos', PagoController::class)
  ->middleware(['auth']);


/**
 * MANAGE FILES
 */
Route::get('uploads/{dir}/{path}', [FileController::class, 'getFile'])
  ->middleware(['auth'])
  ->name('files.getFile');
