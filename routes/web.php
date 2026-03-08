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

Route::get('/', Home::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

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
