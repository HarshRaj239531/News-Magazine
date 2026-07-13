<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes (Frontend Portal)
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/news/{slug}', [FrontendController::class, 'newsDetail'])->name('news.detail');
Route::get('/directories/{category}', [FrontendController::class, 'directory'])->name('directory.show');
Route::get('/online-payments', [FrontendController::class, 'payments'])->name('payments');
Route::get('/contact-us', [FrontendController::class, 'contact'])->name('contact');
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'hi'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Secure Admin Panel Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Articles / News Management
    Route::get('/articles', [AdminController::class, 'articleIndex'])->name('articles.index');
    Route::get('/articles/create', [AdminController::class, 'articleCreate'])->name('articles.create');
    Route::post('/articles/store', [AdminController::class, 'articleStore'])->name('articles.store');
    Route::get('/articles/{id}/edit', [AdminController::class, 'articleEdit'])->name('articles.edit');
    Route::post('/articles/{id}/update', [AdminController::class, 'articleUpdate'])->name('articles.update');
    Route::post('/articles/{id}/delete', [AdminController::class, 'articleDelete'])->name('articles.delete');

    // Directory Committees / Press Clubs Management
    Route::get('/members', [AdminController::class, 'memberIndex'])->name('members.index');
    Route::get('/members/create', [AdminController::class, 'memberCreate'])->name('members.create');
    Route::post('/members/store', [AdminController::class, 'memberStore'])->name('members.store');
    Route::get('/members/{id}/edit', [AdminController::class, 'memberEdit'])->name('members.edit');
    Route::post('/members/{id}/update', [AdminController::class, 'memberUpdate'])->name('members.update');
    Route::post('/members/{id}/delete', [AdminController::class, 'memberDelete'])->name('members.delete');
});
