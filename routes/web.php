<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\DoctorProfileController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('/doctor-profile', [SiteController::class, 'profile'])->name('site.profile');
Route::get('/services', [SiteController::class, 'services'])->name('site.services');
Route::get('/services/{slug}', [SiteController::class, 'service'])->name('site.service.show');
Route::get('/contact-us', [SiteController::class, 'contact'])->name('site.contact');
Route::post('/enquiry', [SiteController::class, 'submitEnquiry'])->name('site.enquiry.submit');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::prefix('monro')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'create'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'store'])->name('admin.login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'destroy'])->name('admin.logout');
        Route::redirect('/', '/monro/site-settings');
        Route::get('/site-settings', [SiteSettingsController::class, 'index'])->name('admin.site-settings.index');
        Route::post('/site-settings', [SiteSettingsController::class, 'update'])->name('admin.site-settings.update');
        Route::get('/homepage', [HomePageController::class, 'index'])->name('admin.homepage.index');
        Route::post('/homepage', [HomePageController::class, 'update'])->name('admin.homepage.update');
        Route::get('/doctor-profile', [DoctorProfileController::class, 'index'])->name('admin.doctor-profile.index');
        Route::post('/doctor-profile', [DoctorProfileController::class, 'update'])->name('admin.doctor-profile.update');
        Route::get('/contact-info', [ContactInfoController::class, 'index'])->name('admin.contact-info.index');
        Route::post('/contact-info', [ContactInfoController::class, 'update'])->name('admin.contact-info.update');
        Route::resource('/services', ServiceController::class)->names('admin.services')->except(['show']);
    });
});
