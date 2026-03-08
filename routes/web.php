<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Tools\TwoFactor;
use App\Livewire\Store\AiAccounts;
use App\Livewire\Movies;
use App\Livewire\MovieDetail;
use App\Livewire\Placeholders\Feature;
use App\Livewire\Blog;
use App\Livewire\Courses;
use App\Livewire\CourseDetail;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;

Route::get('/', Home::class)->name('home');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // User Management
    Route::resource('users', UserController::class)->names('admin.users');
    Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset_password');

    // Menu Management
    Route::resource('menus', MenuController::class)->names('admin.menus');
    Route::post('menus/reorder', [MenuController::class, 'reorder'])->name('admin.menus.reorder');

    // Post Management
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class)->names('admin.posts');

    // Utility / Tool Management
    Route::resource('utilities', \App\Http\Controllers\Admin\UtilityController::class)->names('admin.utilities');

    // Product Management (AI Store)
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->names('admin.products');

    // Order Management
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->names('admin.orders');
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

// Tools & Routes
Route::get('/tools/2fa', TwoFactor::class)->name('tools.2fa');
Route::get('/store/ai-accounts', AiAccounts::class)->name('store.ai');
Route::get('/movies', Movies::class)->name('movies.index');
Route::get('/movies/thien-than-ho-menh', MovieDetail::class)->name('movies.show');
Route::get('/blog', Blog::class)->name('blog.index');
// Courses
Route::get('/courses', Courses::class)->name('courses.index');
Route::get('/courses/javascript-mastery', CourseDetail::class)->name('courses.show');

Route::get('/placeholder/{type}', Feature::class)->name('placeholder');

// Post detail
Route::get('/bai-viet/{slug}', App\Livewire\PostDetail::class)->name('post.show');

// Checkout
Route::get('/checkout/{slug}', App\Livewire\Store\Checkout::class)->name('store.checkout');

