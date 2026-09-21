<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\GalleryCategory;
use Illuminate\Support\Str;

class ServiceAndGallerySeeder extends Seeder
{
    public function run(): void
    {
        // Seed Services
        $services = __('site.services.items');
        foreach ($services as $service) {
            Service::firstOrCreate([
                'title' => $service['title'],
            ], [
                'slug' => Str::slug($service['title']),
                'icon' => $service['icon'],
                'description' => $service['desc'],
                'content' => '<p>' . $service['desc'] . ' نقدم هذه الخدمة بأعلى المقاييس الهندسية والفنية المعتمدة مع توفير فريق متكامل من الاستشاريين والفنيين المتخصصين لضمان تنفيذ مشروعك بكفاءة عالية.</p><ul><li>تنفيذ دقيق مطابق للمواصفات العالمية</li><li>استشارات ودراسات جدوى مجانية</li><li>ضمان حقيقي ودعم فني متواصل</li></ul>',
                'is_active' => true,
            ]);
        }

        // Seed Gallery Categories
        $galleryCategories = __('site.gallery.categories');
        $sortOrder = 1;
        foreach ($galleryCategories as $category) {
            GalleryCategory::firstOrCreate([
                'title' => $category['title'],
            ], [
                'subtitle' => $category['subtitle'],
                'desc' => $category['desc'],
                'icon' => $category['icon'],
                'color' => $category['color'],
                'videos' => $category['videos'],
                'sort_order' => $sortOrder++,
                'is_active' => true,
            ]);
        }
    }
}
