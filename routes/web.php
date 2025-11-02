<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserAdminController as AdminUserController;
use App\Http\Controllers\Admin\TransferAdminController;
use App\Http\Controllers\Admin\ApprovalController;

// app-level controllers
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransferController;

// Landing: just send people to dashboard
Route::get('/', fn () => redirect()->route('dashboard'));

// All authenticated routes
Route::middleware('auth')->group(function () {

    // Common
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (Breeze)
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // Reports - accessible to all authenticated users (including Viewers)
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/reorder', [ReportController::class, 'reorder'])->name('reorder');
        Route::get('/stock', [ReportController::class, 'stock'])->name('stock');
        Route::get('/movements', [ReportController::class, 'movements'])->name('movements');
        
        // Export routes
        Route::get('/export/{which}', [ReportController::class, 'export'])->name('export');
        Route::get('/export/pdf/{which}', [ReportController::class, 'exportPdf'])->name('export.pdf');
        
        // Email route
        Route::post('/email/lowstock', [ReportController::class, 'emailLowStock'])->name('email.lowstock');
    });
    
    // Legacy reorder route (for backward compatibility)
    Route::get('/reorder', [ReportController::class, 'reorder'])->name('reorder.index');

    // Viewer-specific read-only routes
    Route::middleware('role:Viewer')->prefix('viewer')->name('viewer.')->group(function () {
        // Read-only - only index pages
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/warehouses', [WarehouseController::class, 'index'])->name('warehouses.index');
        Route::get('/movements', [MovementController::class, 'index'])->name('movements.index');
        
        // Viewer reports
        Route::get('/reports/stock', [ReportController::class, 'stock'])->name('reports.stock');
        Route::get('/reports/movements', [ReportController::class, 'movements'])->name('reports.movements');
    });

    // Admin + Inventory Manager
    Route::middleware('role:Admin|Inventory Manager')->group(function () {
        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('warehouses', WarehouseController::class)->except(['show']);
        Route::resource('suppliers', SupplierController::class)->except(['show']);
        
        // Pending Transfers (Admin/Manager)
        Route::prefix('admin/transfers')->name('admin.transfers.')->group(function () {
            Route::get('/', [TransferAdminController::class, 'index'])->name('index');
            Route::post('/{id}/approve', [TransferAdminController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [TransferAdminController::class, 'reject'])->name('reject');
        });
        
        // Approvals
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
            Route::post('/approvals/{id}/approve', [ApprovalController::class, 'approve'])->name('approvals.approve');
            Route::post('/approvals/{id}/reject', [ApprovalController::class, 'reject'])->name('approvals.reject');
        });
    });

    // Clerk + Inventory Manager + Admin
    Route::middleware('role:Clerk|Inventory Manager|Admin')->group(function () {
        Route::get('/movements', [MovementController::class, 'index'])->name('movements.index');
        Route::get('/movements/create', [MovementController::class, 'create'])->name('movements.create');
        Route::post('/movements', [MovementController::class, 'store'])->name('movements.store');
        
        // Purchase Orders
        Route::get('/pos', [PurchaseOrderController::class, 'index'])->name('pos.index');
        Route::get('/pos/create', [PurchaseOrderController::class, 'create'])->name('pos.create');
        Route::post('/pos', [PurchaseOrderController::class, 'store'])->name('pos.store');
        Route::post('/pos/{id}/approve', [PurchaseOrderController::class, 'approve'])->name('pos.approve');
        Route::post('/pos/{id}/send', [PurchaseOrderController::class, 'send'])->name('pos.send');
        Route::post('/pos/{id}/cancel', [PurchaseOrderController::class, 'cancel'])->name('pos.cancel');
        
        // PO Item receiving
        Route::get('/pos/item/{itemId}/receive', [PurchaseOrderController::class, 'receiveForm'])->name('pos.item.receive.form');
        Route::post('/pos/item/{itemId}/receive', [PurchaseOrderController::class, 'receiveStore'])->name('pos.item.receive.store');
        
        // Transfers
        Route::get('/transfers/create', [TransferController::class, 'create'])->name('transfers.create');
        Route::post('/transfers', [TransferController::class, 'store'])->name('transfers.store');
        Route::get('/transfers/my', [TransferController::class, 'my'])->name('transfers.my');
    });

    // Admin only
    Route::middleware('role:Admin')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
            Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
            Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
            Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        });
    });
});

require __DIR__.'/auth.php';