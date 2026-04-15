<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Store\AiAccounts;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;


use App\Http\Controllers\SitemapController;

// Sitemap XML cho Google Bot
Route::get('sitemap.xml', [SitemapController::class, 'index']);

Route::get('/', Home::class)->name('home');

// Blog Routes
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// Tool Routes
Route::get('/tools/2fa', \App\Livewire\Tools\TwoFactorAuth::class)->name('tools.2fa');
Route::get('/chat', \App\Livewire\Chat\UserChat::class)->name('chat.show');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // User Management
    Route::resource('users', UserController::class)->names('admin.users');
    Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset_password');

    // Menu Management
    Route::resource('menus', MenuController::class)->names('admin.menus');
    Route::post('menus/reorder', [MenuController::class, 'reorder'])->name('admin.menus.reorder');

    // Post Management (Blog)
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class)->names('admin.posts');

    // Product Management (AI Store)
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->names('admin.products');

    // Order Management
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->names('admin.orders');

    // Live Support Chat
    Route::get('live-chat', \App\Livewire\Admin\SupportChatDashboard::class)->name('admin.support-chat');

    // System Settings (Management)
    Route::get('settings/interface', [\App\Http\Controllers\Admin\SettingController::class, 'interface'])->name('admin.settings.interface');
    Route::post('settings/interface/update', [\App\Http\Controllers\Admin\SettingController::class, 'updateInterface'])->name('admin.settings.update');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.password');
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

Route::get('/store/ai-accounts', AiAccounts::class)->name('store.ai');

// Product detail page
Route::get('/store/product/{slug}', [\App\Http\Controllers\ProductDetailController::class, 'show'])->name('store.product');

// Checkout
Route::get('/checkout/{slug}', App\Livewire\Store\Checkout::class)->name('store.checkout');
