<?php

use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\ServiceController;
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

Route::prefix('admin')->group(function () {
    Route::get('/', [HomePageController::class, 'index'])->name('admin.homepage.index');
    Route::post('/homepage', [HomePageController::class, 'update'])->name('admin.homepage.update');
    Route::resource('/services', ServiceController::class)->names('admin.services')->except(['show']);
});
