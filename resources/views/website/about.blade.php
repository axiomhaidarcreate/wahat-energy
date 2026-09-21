@extends('website.layouts.app')

@section('title', __('site.nav.about') . ' | ' . __('site.site_name'))

@section('content')

@include('website.partials.navbar')

{{-- ═══════════════════ PAGE HERO ═══════════════════ --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <div class="breadcrumb">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('site.common.home') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="current">{{ __('site.nav.about') }}</span>
            </div>
            <h1>{{ __('site.about_page.title') }}</h1>
            <p>{{ __('site.about_page.subtitle') }}</p>
        </div>
    </div>
</section>

{{-- ═══════════════════ VISION & MISSION ═══════════════════ --}}
<section class="services-section" style="padding: 80px 0;">
    <div class="container">
        <div class="services-grid" style="grid-template-columns: repeat(2, 1fr);">
            <div class="service-card" data-aos="fade-up">
                <div class="service-icon" style="background: rgba(245, 158, 11, 0.15);">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h3>{{ __('site.about_page.vision_title') }}</h3>
                <p style="font-size: 1.05rem; line-height: 1.8;">{{ __('site.about_page.vision_text') }}</p>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="service-icon" style="background: rgba(6, 182, 212, 0.15); color: var(--accent);">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3>{{ __('site.about_page.mission_title') }}</h3>
                <p style="font-size: 1.05rem; line-height: 1.8;">{{ __('site.about_page.mission_text') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════ CORE VALUES ═══════════════════ --}}
<section class="why-section" style="background: var(--bg-surface-2);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>{{ __('site.about_page.values_title') }}</h2>
        </div>
        <div class="why-grid" style="grid-template-columns: repeat(3, 1fr);">
            <div class="why-card" data-aos="fade-up">
                <div class="why-icon"><i class="fa-solid fa-medal"></i></div>
                <h3>{{ __('site.about_page.val_1_title') }}</h3>
                <p>{{ __('site.about_page.val_1_desc') }}</p>
            </div>
            <div class="why-card" data-aos="fade-up" data-aos-delay="100">
                <div class="why-icon"><i class="fa-solid fa-handshake-angle"></i></div>
                <h3>{{ __('site.about_page.val_2_title') }}</h3>
                <p>{{ __('site.about_page.val_2_desc') }}</p>
            </div>
            <div class="why-card" data-aos="fade-up" data-aos-delay="200">
                <div class="why-icon"><i class="fa-solid fa-leaf"></i></div>
                <h3>{{ __('site.about_page.val_3_title') }}</h3>
                <p>{{ __('site.about_page.val_3_desc') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════ BRANDS ═══════════════════ --}}
<section class="brands-section">
    <div class="container" style="text-align: center; margin-bottom: 32px;">
        <h3 style="color: var(--primary); font-size: 1.4rem; font-weight: 700; letter-spacing: 0.02em;">{{ __('site.brands.title') }}</h3>
    </div>
    <div class="brands-track">
        {{-- First set --}}
        @foreach($brands as $brand)
            <span class="brand-item"><i class="fa-solid fa-sun"></i> {{ $brand->name }}</span>
        @endforeach
        <span class="brand-item"><i class="fa-solid fa-solar-panel"></i> Trina Solar</span>
        <span class="brand-item"><i class="fa-solid fa-bolt"></i> Sungrow</span>
        <span class="brand-item"><i class="fa-solid fa-battery-full"></i> Huawei</span>
        <span class="brand-item"><i class="fa-solid fa-plug"></i> JA Solar</span>
        <span class="brand-item"><i class="fa-solid fa-car-battery"></i> Pylontech</span>
        <span class="brand-item"><i class="fa-solid fa-microchip"></i> Growatt</span>
        {{-- Duplicate for seamless loop --}}
        @foreach($brands as $brand)
            <span class="brand-item"><i class="fa-solid fa-sun"></i> {{ $brand->name }}</span>
        @endforeach
        <span class="brand-item"><i class="fa-solid fa-solar-panel"></i> Trina Solar</span>
        <span class="brand-item"><i class="fa-solid fa-bolt"></i> Sungrow</span>
        <span class="brand-item"><i class="fa-solid fa-battery-full"></i> Huawei</span>
        <span class="brand-item"><i class="fa-solid fa-plug"></i> JA Solar</span>
        <span class="brand-item"><i class="fa-solid fa-car-battery"></i> Pylontech</span>
        <span class="brand-item"><i class="fa-solid fa-microchip"></i> Growatt</span>
    </div>
</section>

@include('website.partials.footer')

@endsection
