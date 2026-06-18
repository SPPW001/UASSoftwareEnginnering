<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventPromoController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\MerchandiseController;
use App\Http\Controllers\Admin\PartnershipController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReportExportController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UpsellPackageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/membership', [HomeController::class, 'membership'])->name('membership.public');
Route::get('/merchandise', [HomeController::class, 'merchandise'])->name('merchandise.public');
Route::get('/event-promo', [HomeController::class, 'events'])->name('events.public');
Route::get('/partnership', [HomeController::class, 'partnership'])->name('partnership.public');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{transaksi}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth.simple', 'role:admin,manager'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tickets', TicketController::class)->except(['show']);
    Route::resource('merchandise', MerchandiseController::class)->except(['show']);
    Route::resource('events', EventPromoController::class)->except(['show']);
    Route::resource('upsells', UpsellPackageController::class)->except(['show']);
    Route::get('memberships', [MembershipController::class, 'index'])->name('memberships.index');
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export/excel', [ReportExportController::class, 'excel'])->name('reports.export.excel');

    Route::resource('partnerships', PartnershipController::class)->middleware('role:manager')->except(['show']);
});
