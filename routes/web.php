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
use App\Livewire\GeminiBusinessFree;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\GeminiTrickController;

use App\Http\Controllers\SitemapController;

// Sitemap XML cho Google Bot
Route::get('sitemap.xml', [SitemapController::class, 'index']);

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

    // Gemini Tricks (Separate)
    Route::resource('gemini-tricks', GeminiTrickController::class)->names('admin.gemini-tricks');

    // Utility / Tool Management
    Route::post('utilities/cleanup', [\App\Http\Controllers\Admin\UtilityController::class, 'cleanupTempFiles'])->name('admin.utilities.cleanup');
    Route::resource('utilities', \App\Http\Controllers\Admin\UtilityController::class)->names('admin.utilities');

    // Product Management (AI Store)
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->names('admin.products');

    // Order Management
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->names('admin.orders');

    // Social Buff Management
    Route::resource('social-services', \App\Http\Controllers\Admin\SocialServiceController::class)->names('admin.social-services');
    Route::resource('social-servers', \App\Http\Controllers\Admin\SocialServerController::class)->names('admin.social-servers');
    Route::resource('social-orders', \App\Http\Controllers\Admin\SocialOrderController::class)->names('admin.social-orders');

    // Course Management
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class)->names('admin.courses');
    Route::resource('lessons', \App\Http\Controllers\Admin\LessonController::class)->names('admin.lessons');

    // Movie Review Management
    Route::resource('movies', \App\Http\Controllers\Admin\MovieController::class)->names('admin.movies');

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

// Tools & Routes
Route::get('/tools/2fa', TwoFactor::class)->name('tools.2fa');
Route::get('/2fa', TwoFactor::class)->name('2fa');
Route::get('/tools/remove-gemini-logo', \App\Livewire\Tools\RemoveGeminiLogo::class)->name('tools.remove-gemini');
Route::get('/gemini-business-free/{slug?}', GeminiBusinessFree::class)->name('gemini.business');
Route::get('/store/ai-accounts', AiAccounts::class)->name('store.ai');
Route::get('/social-service/{slug}', \App\Livewire\SocialBuff::class)->name('social.buff');

// New AI Tools
Route::get('/tools/youtube-summary', \App\Livewire\Tools\YoutubeSummary::class)->name('tools.yt-summary');
Route::get('/tools/content-writer', \App\Livewire\Tools\ContentWriter::class)->name('tools.content-writer');
Route::get('/tools/remove-bg', \App\Livewire\Tools\RemoveBg::class)->name('tools.remove-bg');


// Course Routes
Route::get('/hoc-ngon-ngu', \App\Livewire\Courses\CourseList::class)->name('course.index');
Route::get('/hoc-ngon-ngu/{slug}/{lesson_slug?}', \App\Livewire\Courses\CourseDetail::class)->name('course.detail');

Route::get('/movies', Movies::class)->name('movies.index');
Route::get('/movies/{slug}', MovieDetail::class)->name('movies.show');
Route::get('/blog', Blog::class)->name('blog.index');

Route::get('/placeholder/{type}', Feature::class)->name('placeholder');

// Post detail
Route::get('/bai-viet/{slug}', App\Livewire\PostDetail::class)->name('post.show');

// Checkout
Route::get('/checkout/{slug}', App\Livewire\Store\Checkout::class)->name('store.checkout');

