<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

use App\Http\Controllers\SitemapController;

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Language switch
Route::get('/locale/{locale}', [WebsiteController::class, 'setLocale'])->name('locale.switch');

// Website routes
Route::middleware([\App\Http\Middleware\SetLocale::class])->group(function () {
    Route::get('/', [WebsiteController::class, 'home'])->name('home');
    Route::get('/about', [WebsiteController::class, 'about'])->name('about');
    
    // Services
    Route::get('/services', [WebsiteController::class, 'services'])->name('services');
    Route::get('/services/{slug}', [WebsiteController::class, 'serviceDetail'])->name('services.show');
    
    // Products
    Route::get('/products', [WebsiteController::class, 'products'])->name('products');
    Route::get('/products/{id}', [WebsiteController::class, 'productDetail'])->name('products.show');
    
    // Projects
    Route::get('/projects', [WebsiteController::class, 'projects'])->name('projects');
    Route::get('/projects/{id}', [WebsiteController::class, 'projectDetail'])->name('projects.show');
    
    // Gallery
    Route::get('/gallery', [WebsiteController::class, 'gallery'])->name('gallery');
    
    // Calculator
    Route::get('/calculator', [WebsiteController::class, 'calculator'])->name('calculator');
    
    // Contact
    Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
    Route::post('/contact', [WebsiteController::class, 'submitContact'])->name('contact.submit');
});

