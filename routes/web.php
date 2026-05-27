<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\MidtransController;
use App\Livewire\Pos;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Products;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Tables;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Reports;
use App\Livewire\Admin\Orders;
use App\Livewire\Admin\UserActivityLog;

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Midtrans Notification (no auth required - webhook from Midtrans)
Route::post('/midtrans/notification', [MidtransController::class, 'notification']);

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // POS
    Route::get('/', Pos::class)->name('pos');
    Route::get('/pos', Pos::class)->name('pos');

    // Receipt
    Route::get('/receipt/{orderId}/download', [ReceiptController::class, 'download'])->name('receipt.download');
    Route::get('/receipt/{orderId}/print', [ReceiptController::class, 'print'])->name('receipt.print');
});

// Admin Routes - requires admin role
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/products', Products::class)->name('products');
    Route::get('/categories', Categories::class)->name('categories');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/users', Users::class)->name('users');
    Route::get('/orders', Orders::class)->name('orders');
    Route::get('/activity-log', UserActivityLog::class)->name('activity-log');
    Route::get('/reports', Reports::class)->name('reports');
    Route::get('/reports/export/excel', [\App\Http\Controllers\ReportExportController::class, 'exportExcel'])->name('reports.export.excel');
    Route::get('/reports/export/pdf', [\App\Http\Controllers\ReportExportController::class, 'exportPdf'])->name('reports.export.pdf');
});