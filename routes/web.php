<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\EnrollmentController as AdminEnrollmentController;

// Публичные страницы
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/news', [PublicController::class, 'news'])->name('news');
Route::get('/news/{id}', [PublicController::class, 'newsShow'])->name('news.show');

// Авторизация
Auth::routes(['verify' => false]);
Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/enroll', [EnrollmentController::class, 'create'])->name('enroll.create');
    Route::post('/enroll', [EnrollmentController::class, 'store'])->name('enroll.store');
    Route::get('/my-enrollments', [EnrollmentController::class, 'index'])->name('enroll.index');
});

// Админ панель
Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    Route::patch('enrollments/{enrollment}/toggle', [AdminEnrollmentController::class, 'toggle'])->name('enrollments.toggle');
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('enrollments', [AdminEnrollmentController::class, 'index'])->name('enrollments.index');
    Route::resource('news', NewsController::class)->except(['show']);
    Route::delete('news-media/{media}', [NewsController::class, 'destroyMedia'])->name('news.media.destroy');
});
