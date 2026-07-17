<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\NavigationMenuController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DignitaryController;

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
Route::get('/pages/{slug}', [FrontendController::class, 'showPage'])->name('pages.show');
Route::get('/view-pdf', [FrontendController::class, 'viewPdf'])->name('pdf.viewer');
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

    // Slider Items Management
    Route::get('/slides', [SlideController::class, 'index'])->name('slides.index');
    Route::get('/slides/create', [SlideController::class, 'create'])->name('slides.create');
    Route::post('/slides/store', [SlideController::class, 'store'])->name('slides.store');
    Route::get('/slides/{id}/edit', [SlideController::class, 'edit'])->name('slides.edit');
    Route::post('/slides/{id}/update', [SlideController::class, 'update'])->name('slides.update');
    Route::post('/slides/{id}/delete', [SlideController::class, 'destroy'])->name('slides.delete');

    // Announcements / What's New Management
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements/store', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/announcements/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::post('/announcements/{id}/update', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::post('/announcements/{id}/delete', [AnnouncementController::class, 'destroy'])->name('announcements.delete');

    // Navigation Menu Management
    Route::get('/navigation', [NavigationMenuController::class, 'index'])->name('navigation.index');
    Route::get('/navigation/create', [NavigationMenuController::class, 'create'])->name('navigation.create');
    Route::post('/navigation/store', [NavigationMenuController::class, 'store'])->name('navigation.store');
    Route::get('/navigation/{id}/edit', [NavigationMenuController::class, 'edit'])->name('navigation.edit');
    Route::post('/navigation/{id}/update', [NavigationMenuController::class, 'update'])->name('navigation.update');
    Route::post('/navigation/{id}/delete', [NavigationMenuController::class, 'destroy'])->name('navigation.delete');

    // Site Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

    // Dignitaries Section Management
    Route::get('/dignitaries', [DignitaryController::class, 'index'])->name('dignitaries.index');
    Route::post('/dignitaries/update', [DignitaryController::class, 'update'])->name('dignitaries.update');
});
