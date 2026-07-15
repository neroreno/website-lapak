<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublicController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// ===== PUBLIC ROUTES =====
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/menu/{id}/reviews', [PublicController::class, 'getReviews']);
Route::post('/checkout', [PublicController::class, 'checkout']);
Route::post('/payment/process', [PublicController::class, 'processPayment']);
Route::get('/receipt/{order}', [PublicController::class, 'receipt']);
Route::post('/review', [PublicController::class, 'submitReview']);
Route::post('/feedback', [PublicController::class, 'submitFeedback']);

// ===== AUTH ROUTES =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== MEMBER ROUTES (Auth Required) =====
Route::middleware('auth')->prefix('member')->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('member.dashboard');
    Route::get('/orders', [MemberController::class, 'orders']);
    Route::post('/checkout', [MemberController::class, 'checkout']);
    Route::post('/review', [MemberController::class, 'submitReview']);
    Route::get('/chat', [MemberController::class, 'getChat']);
    Route::post('/chat', [MemberController::class, 'sendChat']);
    Route::put('/profile', [MemberController::class, 'updateProfile']);
    Route::post('/vouchers/exchange', [MemberController::class, 'exchangeVoucher']);
    Route::post('/vouchers/activate', [MemberController::class, 'activateVoucher']);
});

// ===== ADMIN ROUTES (Auth + Admin Required) =====
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus']);
    Route::get('/sales', [AdminController::class, 'salesReport']);
    Route::get('/sales/export', [AdminController::class, 'exportSales']);
    Route::post('/feedbacks/{id}/respond', [AdminController::class, 'respondFeedback']);
    Route::post('/menus', [AdminController::class, 'storeMenu']);
    Route::put('/menus/{id}', [AdminController::class, 'updateMenu']);
    Route::delete('/menus/{id}', [AdminController::class, 'deleteMenu']);
    Route::post('/chat/announce', [AdminController::class, 'sendAnnouncement']);
});
