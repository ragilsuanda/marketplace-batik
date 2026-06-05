<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentProofController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanicButtonController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// ── Frontend Publik ─────────────────────────────────────────
Route::get('/', function () {
    return view('frontend.home.index');
});

Route::resource('/home', HomeController::class);

// Katalog & detail produk (publik)
Route::get('/shop',           [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

// Autentikasi
Route::get('/login',    [AuthController::class, 'index'])->name('login');
Route::post('/login',   [AuthController::class, 'doLogin']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// ── Route khusus USER ───────────────────────────────────────
Route::middleware(['auth', 'user'])->group(function () {
    // Keranjang
    Route::get('/cart',                       [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}',        [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{productId}',   [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear',              [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout',         [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout',        [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    // Riwayat pesanan
    Route::get('/orders',         [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Upload bukti transfer
    Route::post('/orders/{order}/payment-proof', [PaymentProofController::class, 'upload'])->name('orders.payment-proof');
});

// ── Route khusus ADMIN ──────────────────────────────────────
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/user',      AdminUserController::class);
    Route::resource('/dashboard', AdminDashboardController::class);

    Route::get('/reports',                             [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{report}',                    [ReportController::class, 'show'])->name('reports.show');
    Route::patch('/reports/{report}/update-status',    [ReportController::class, 'updateStatus'])->name('reports.updateStatus');
    Route::delete('/reports/{report}',                 [ReportController::class, 'destroy'])->name('reports.destroy');

    Route::resource('categories', CategoryController::class);
    Route::resource('products',   ProductController::class);

    // Manajemen pesanan
    Route::get('/admin/orders',                   [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}',           [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/admin/orders/{order}/status',  [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // Laporan Penjualan
    Route::get('/admin/sales-report', [SalesReportController::class, 'index'])->name('admin.sales-report');
});
