<?php

use App\Http\Controllers\AfiliadosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvisoCobroController;
use App\Http\Controllers\BoletineController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CategoriaBoletineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\JuntaDirectivaController;
use App\Http\Controllers\JuntaDirectivaPeriodo;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganismoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocialNetworkController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
/**
 * WEB ROUTES
 */
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('quienes-somos', [HomeController::class, 'aboutus'])->name('about');
Route::get('servicios', [HomeController::class, 'services'])->name('services');
Route::get('afiliacion', [HomeController::class, 'affiliation'])->name('affiliation');
Route::get('contacto', [HomeController::class, 'contact'])->name('contact');
Route::get('directorio', [HomeController::class, 'directory'])->name('directory');
Route::get('categoria/{category}', [HomeController::class, 'category'])->name('category.show');
Route::get('etiquetas/{tag}/noticias', [HomeController::class, 'tag'])->name('tags.show');
Route::get('contacto', [HomeController::class, 'contact'])->name('contact');
Route::post('contacto', [HomeController::class, 'sendContactMail'])->name('sendContactMail');
Route::get('noticias-avipla', [HomeController::class, 'news'])->name('news');
Route::get('noticias-avipla/{noticia}', [HomeController::class, 'newsItem'])->name('news.item');

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

Route::get('dashboard', [DashboardController::class, 'index'])
  ->name('dashboard')
  ->middleware('auth');

Route::middleware('auth')->group(function() {
  Route::resource('solicitudes', SolicitudController::class)
    ->parameters(['solicitudes' => 'solicitud']);
  Route::post('afiliados/solicitud/{solicitud}/recordatorio', [SolicitudController::class, 'reminder'])
    ->name('solicitudes.reminder');
  
  Route::resource('afiliados', AfiliadosController::class)
    ->except(['create', 'store']);
});

Route::resource('usuarios', UserController::class)
  ->middleware('auth')
  ->parameters(['usuarios' => 'user'])
  ->names('users');

Route::middleware('auth')->group(function() {
  Route::get('perfil', [ProfileController::class, 'show'])->name('profile.show');
  Route::put('perfil', [ProfileController::class, 'update'])->name('profile.update');

  Route::get('perfil/presidente', [ProfileController::class, 'showPresidente'])->name('profile.showPresidente');
  Route::get('perfil/director', [ProfileController::class, 'showDirector'])->name('profile.showDirector');
  Route::post('perfil/presidente', [ProfileController::class, 'storePresidente'])->name('profile.storePresidente');
  Route::post('perfil/director', [ProfileController::class, 'storeDirector'])->name('profile.storeDirector');
});

Route::get('mi-empresa', [ProfileController::class, 'businessShow'])->name('business.show');
Route::put('mi-empresa', [ProfileController::class, 'update'])->name('business.update');

Route::resource('roles', RoleController::class)
  ->middleware(['auth', 'is_admin']);

Route::resource('boletines', BoletineController::class);
Route::resource('categorias-boletines', CategoriaBoletineController::class)
  ->parameters(['categorias-boletines' => 'category'])
  ->except(['show']);

Route::get('notificaciones', [NotificationController::class, 'index'])
  ->name('notifications.index')
  ->middleware('auth');
Route::post('notificaciones', [NotificationController::class, 'markAllAsRead'])
  ->name('notifications.markAllAsRead');

Route::resource('avisos-de-cobro', AvisoCobroController::class)
  ->names('avisos-cobro')
  ->parameters(['avisos-de-cobro' => 'aviso_cobro'])
  ->middleware('auth');

/**
 * Investigar cual seria el mejor nombre para estas rutas
 */
Route::get('pagos/{avisoCobro}/pagar', [AvisoCobroController::class, 'payCollectionNotice'])
  ->name('avisos-cobro.payCollectionNotice')
  ->middleware('auth');
Route::get('pagos/{avisoCobro}/detalle', [AvisoCobroController::class, 'avisoCobroDetails'])

  ->name('pagos.invoice');
/**
 * NEWS ROUTES
 */
Route::resource('noticias', NoticiaController::class)
  ->except(['show'])
  ->middleware('auth');

/**
 * INVOICES ROUTES
 */
Route::resource('facturas', InvoiceController::class)
  ->parameters(['facturas', 'invoice'])
  ->names('invoices');
Route::post('factura/pagar', [InvoiceController::class, 'formStore'])->name('invoices.formStore');

Route::resource('categorias', CategoryController::class)
  ->names('categories')
  ->parameters(['categorias' => 'category'])
  ->except(['show'])
  ->middleware('auth');

Route::resource('etiquetas', TagController::class)
  ->names('tags')
  ->parameters(['etiquetas' => 'tag'])
  ->except(['show'])
  ->middleware('auth');

/**
 * PAYMENTS ROUTES
 */
Route::resource('pagos', PagoController::class)
  ->middleware('auth');

/**
 * MANAGE FILES
 */
Route::get('uploads/{dir}/{path}', [FileController::class, 'getFile'])
  ->middleware('auth')
  ->name('files.getFile');

Route::get('/mailable', function () {
    $solicitud = App\Models\SolicitudAfiliado::find(1);
    return new App\Mail\VerifyAfiliadoEmail($solicitud);
});

/**
 * WEBSITE
 */
  
Route::middleware(['auth', 'is_admin'])->group(function() {
  Route::get('sitio-web', [WebsiteController::class, 'index'])
  ->name('website.index');

  Route::apiResource('carousel', CarouselController::class)
    ->except([
      'show',
      'index'
    ]);

  Route::apiResource('social-networks', SocialNetworkController::class)
    ->only(['store']);

  Route::apiResource('organismos', OrganismoController::class)
    ->only(['store', 'destroy', 'update']);

  Route::apiResource('junta-directiva', JuntaDirectivaController::class)
    ->only(['store', 'destroy', 'update']);

  Route::apiResource('junta-directiva-periodo', JuntaDirectivaPeriodo::class)
    ->only(['store']);
});