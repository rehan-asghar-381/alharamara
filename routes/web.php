<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DailyExpenseController;
use App\Http\Controllers\Admin\ExpenseTypeController;
use App\Http\Controllers\Admin\LaborCostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\WoodTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin area
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('purchases', PurchaseController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('sales', SaleController::class)->except(['show']);
        Route::resource('wood-types', WoodTypeController::class)->except(['show']);
        Route::resource('vendors', VendorController::class)->except(['show']);
        Route::resource('labor-costs', LaborCostController::class)->except(['show']);
        Route::resource('expense-types', ExpenseTypeController::class)->except(['show']);
        Route::resource('daily-expenses', DailyExpenseController::class)->except(['show']);
        Route::get('stock/available', [SaleController::class, 'availableStock'])->name('stock.available');
    });

