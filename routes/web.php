<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

use App\Http\Controllers\SitemapController;

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// YouTube Thumbnail Proxy — يجيب الصورة الحقيقية للفيديو من الخادم
Route::get('/yt-thumb/{videoId}', function ($videoId) {
    // تحقق من صحة الـ ID
    if (!preg_match('/^[\w-]{11}$/', $videoId)) {
        abort(400);
    }

    $cacheKey = 'yt_thumb_' . $videoId;

    // نستخدم cache لمدة 24 ساعة لتسريع الطلبات
    $redirectUrl = cache()->remember($cacheKey, 86400, function () use ($videoId) {
        // الجودات مرتبة من الأعلى للأدنى
        $qualities = ['maxresdefault', 'sddefault', 'hqdefault', 'mqdefault', '0'];

        foreach ($qualities as $quality) {
            $url = "https://img.youtube.com/vi/{$videoId}/{$quality}.jpg";
            $context = stream_context_create(['http' => ['timeout' => 5]]);
            $data = @file_get_contents($url, false, $context);

            if ($data) {
                $info = @getimagesizefromstring($data);
                // الصورة الرمادية الفارغة دائماً 120×90 — تجاوزها
                if ($info && $info[0] > 120) {
                    return $url;
                }
            }
        }

        // آخر احتياطي: الصورة المرقمة دائماً تحتوي فريم حقيقي من الفيديو
        return "https://img.youtube.com/vi/{$videoId}/0.jpg";
    });

    return redirect($redirectUrl);
})->name('yt.thumb');

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


// Secret Cache Clear Route
Route::get('/system/clear-cache-now', function() {
    Artisan::call('optimize:clear');
    return 'Cache Cleared Successfully!';
});

Route::get('/debug-log', function() {
    if (request('key') !== 'wahat2026') return abort(403);
    
    $logFile = storage_path('logs/laravel.log');
    if (!file_exists($logFile)) return 'No log file';
    
    $lines = file($logFile);
    $errors = array_filter($lines, function($line) {
        return str_contains($line, 'production.ERROR') || str_contains($line, 'local.ERROR');
    });
    
    $lastErrors = array_slice($errors, -5);
    
    return response('<pre dir="ltr" style="background:#222;color:#fff;padding:20px;white-space:pre-wrap;">' . implode("\n\n", $lastErrors) . '</pre>', 200)
        ->header('Content-Type', 'text/html; charset=utf-8');
});

