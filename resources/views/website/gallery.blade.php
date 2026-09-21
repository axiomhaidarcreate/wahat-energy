@extends('website.layouts.app')

@section('title', __('site.nav.gallery') . ' | ' . __('site.site_name'))

@section('content')

@include('website.partials.navbar')

{{-- ═══════════════════ PAGE HERO ═══════════════════ --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <div class="breadcrumb">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('site.common.home') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="current">{{ __('site.nav.gallery') }}</span>
            </div>
            <h1>{{ __('site.gallery.title') }}</h1>
            <p>{{ __('site.gallery.subtitle') }}</p>
        </div>
    </div>
</section>

{{-- ═══════════════════ GALLERY SECTION ═══════════════════ --}}
<section class="gallery-section" style="padding: 80px 0; background: var(--bg-main);">
    <div class="container">
        @foreach($categories as $index => $category)
            <div class="gallery-category" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" style="margin-bottom: 64px;">
                
                {{-- Category Header --}}
                <div class="section-title" style="text-align: right; margin-bottom: 32px;">
                    <div class="subtitle" style="color: {{ $category->color }}"><i class="fa-solid {{ $category->icon }}"></i> {{ $category->subtitle }}</div>
                    <h2>{{ $category->title }}</h2>
                    <p style="color: var(--text-light); max-width: 800px;">{{ $category->desc }}</p>
                </div>

                {{-- Videos Grid --}}
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                    @foreach($category->videos ?? [] as $video)
                        <div class="video-card" style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); overflow: hidden; transition: all 0.3s ease;">
                            
                            {{-- Video Thumbnail Area --}}
                            <div class="video-thumbnail" style="position: relative; aspect-ratio: 16/9; background: #000; display: flex; align-items: center; justify-content: center;">
                                {{-- Placeholder for video, in real app could be a youtube embed or image --}}
                                <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?q=80&w=800&auto=format&fit=crop" alt="{{ $video['title'] }}" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.6; transition: all 0.5s ease;">
                                
                                <div class="play-btn-overlay" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 64px; height: 64px; border-radius: 50%; background: {{ $category->color }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; box-shadow: 0 0 20px {{ $category->color }}66; cursor: pointer; transition: all 0.3s ease; z-index: 2;">
                                    <i class="fa-solid fa-play" style="margin-left: 4px;"></i>
                                </div>
                            </div>
                            
                            {{-- Video Info --}}
                            <div class="video-info" style="padding: 20px;">
                                <h3 style="font-size: 1.1rem; color: var(--text-dark); margin-bottom: 12px; line-height: 1.5; font-weight: 700;">{{ $video['title'] }}</h3>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <a href="{{ $video['url'] }}" class="btn-sm" style="color: {{ $category->color }}; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                                        <i class="fa-solid fa-circle-play"></i> {{ __('site.gallery.play_video') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- Add some hover CSS specifically for gallery --}}
<style>
    html[dir="ltr"] .video-info { text-align: left; }
    html[dir="rtl"] .video-info { text-align: right; }
    
    html[dir="ltr"] .section-title { text-align: left !important; }
    html[dir="rtl"] .section-title { text-align: right !important; }

    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    }
    .video-card:hover .video-thumbnail img {
        transform: scale(1.05);
        opacity: 0.8;
    }
    .video-card:hover .play-btn-overlay {
        transform: translate(-50%, -50%) scale(1.1);
        box-shadow: 0 0 30px rgba(255,255,255,0.4);
    }
</style>

@include('website.partials.footer')

@endsection
