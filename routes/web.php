<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CompatibilityController;
use App\Http\Controllers\PortabilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RechargeController;
use App\Http\Controllers\SalesController;

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

Route::get('/', function () {
    return view('adminhtml.auth.login');
});

Route::middleware('auth')->group(function () {
    /** Session */
    Route::post('/logout', [
        AuthenticatedSessionController::class,
        'destroy'
    ])->name('logout');
    Route::get('/verify-email', [
        EmailVerificationPromptController::class,
        '__invoke'
    ])->name('verification.notice');
    Route::get('/confirm-password', [
        ConfirmablePasswordController::class,
        'show'
    ])->name('password.confirm');
    Route::post('/confirm-password', [
        ConfirmablePasswordController::class,
        'store'
    ])->middleware('auth');

    /** Dashboard */

    Route::get('/dashboard', [DashboardController::class, 'index'])->name(
        'dashboard'
    );

    /** Contratación */
    Route::get('/purchase', [PurchaseController::class, 'index'])->name(
        'purchase.index'
    );
    Route::post('/purchase', [PurchaseController::class, 'store'])->name(
        'purchase.store'
    );
    Route::get('/purchase/{offering}/create', [
        PurchaseController::class,
        'create'
    ])->name('purchase.create');
    Route::get('/purchase/{order}/payment', [
        PurchaseController::class,
        'payment'
    ])->name('purchase.payment');
    Route::put('/purchase/{order}/confirm', [
        PurchaseController::class,
        'confirm'
    ])->name('purchase.confirm');

    Route::patch('/purchase/{order}', [
        PurchaseController::class,
        'update'
    ])->name('purchase.update');

    Route::put('/purchase/{order}/conekta', [
        PurchaseController::class,
        'conektaOrder'
    ])->name('purchase.conekta');

    /** Recargas */
    Route::get('/recharges', [RechargeController::class, 'index'])->name(
        'recharges.index'
    );

    Route::post('/recharges/offerings', [
        RechargeController::class,
        'create'
    ])->name('recharges.offerings');

    Route::post('/recharges/store', [RechargeController::class, 'store'])->name(
        'recharges.store'
    );

    Route::get('/recharges/{order}/payment', [
        RechargeController::class,
        'payment'
    ])->name('recharges.payment');

    Route::patch('/recharges/{order}', [
        RechargeController::class,
        'update'
    ])->name('recharges.update');

    Route::put('/recharges/{order}/confirm', [
        RechargeController::class,
        'confirm'
    ])->name('recharges.confirm');

    Route::put('/recharges/{order}/conekta', [
        RechargeController::class,
        'conektaOrder'
    ])->name('recharges.conekta');

    /** Users */
    Route::get('/users', function () {
        return view('adminhtml.users.index');
    })->name('users');

    /** Resources */
    Route::resource('orders', OrderController::class)->only([
        'index',
        'store',
        'show'
    ]);
    Route::resource('balances', BalanceController::class)
        ->only(['index', 'create', 'store'])
        ->middleware('can:admin');
    Route::resource(
        'configurations',
        ConfigurationController::class
    )->middleware('can:super');
    Route::resources([
        'accounts' => AccountController::class,
        'users' => UserController::class,
        'offerings' => OfferingController::class,
        'brands' => BrandController::class,
        'tools/portability' => PortabilityController::class
    ]);

    Route::get('/profile/{user}', [UserController::class, 'profile'])->name(
        'profile'
    );
    Route::patch('/profile/{user}', [
        UserController::class,
        'profileUpdate'
    ])->name('profile.update');

    /** Tools */
    Route::get('/tools/compatibility', [
        CompatibilityController::class,
        'index'
    ])->name('compatibility.index');
    Route::post('/tools/compatibility/check', [
        CompatibilityController::class,
        'check'
    ])->name('compatibility.check');
    Route::view('/tools/coverage', 'adminhtml.tools.coverage.index')->name(
        'coverage.index'
    );

    /**  sales  / ventas   */

    Route::get('/sales', [
        SalesController::class,
        'index'
    ])->name('sales.index');

    Route::get('/sales/orders/{order?}', [
        SalesController::class,
        'show'
    ])->name('sales.show');

    Route::get('/sales/orders/{order}/export', [
        SalesController::class,
        'export'
    ])->name('sales.export');
});

/** Auth Routes */
Route::middleware('guest')->group(function () {
    Route::get('/login', [
        AuthenticatedSessionController::class,
        'create'
    ])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/forgot-password', [
        PasswordResetLinkController::class,
        'create'
    ])->name('password.request');
    Route::post('/forgot-password', [
        PasswordResetLinkController::class,
        'store'
    ])->name('password.email');
    Route::get('/reset-password/{token}', [
        NewPasswordController::class,
        'create'
    ])->name('password.reset');
    Route::post('/reset-password', [
        NewPasswordController::class,
        'store'
    ])->name('password.update');
});

Route::get('/verify-email/{id}/{hash}', [
    VerifyEmailController::class,
    '__invoke'
])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [
    EmailVerificationNotificationController::class,
    'store'
])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
