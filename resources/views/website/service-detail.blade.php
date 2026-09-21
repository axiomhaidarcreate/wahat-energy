@extends('website.layouts.app')

@section('title', $service->title . ' | ' . __('site.site_name'))
@section('meta_description', Str::limit(strip_tags($service->description ?? $service->content ?? __('site.hero.subtitle')), 150))
@section('meta_keywords', $service->title . ', خدمات طاقة شمسية, طاقة متجددة, تركيب أنظمة شمسية السعودية')

@section('content')

@include('website.partials.navbar')

{{-- ═══════════════════ PAGE HERO ═══════════════════ --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <div class="breadcrumb">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('site.common.home') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <a href="{{ route('services') }}">{{ __('site.nav.services') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="current">{{ $service->title }}</span>
            </div>
            <h1>{{ $service->title }}</h1>
            <p>{{ $service->description }}</p>
        </div>
    </div>
</section>

{{-- ═══════════════════ SERVICE DETAILS ═══════════════════ --}}
<section class="services-section" style="padding: 80px 0;">
    <div class="container">
        <div class="detail-layout">
            <div class="detail-image-box" data-aos="fade-up">
                <div style="text-align: center;">
                    <div class="service-icon" style="width: 100px; height: 100px; font-size: 3rem; margin: 0 auto 24px; background: rgba(245, 158, 11, 0.15);">
                        <i class="fa-solid {{ $service->icon }}"></i>
                    </div>
                    <h2 style="font-size: 1.8rem; margin-bottom: 12px; color: var(--text-primary);">{{ $service->title }}</h2>
                    <p style="color: var(--primary); font-size: 1rem; font-weight: 600;">{{ __('site.site_name') }} — {{ __('site.site_slogan') }}</p>
                </div>
            </div>

            <div class="detail-card" data-aos="fade-up" data-aos-delay="100">
                <h3 style="font-size: 1.4rem; margin-bottom: 20px; color: var(--primary);">{{ __('site.common.details') }}</h3>
                <div class="service-content prose" style="font-size: 1.05rem; line-height: 1.9; color: var(--text-secondary); margin-bottom: 30px;">
                    {!! $service->content !!}
                </div>

                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    <a href="{{ route('contact') }}?service={{ urlencode($service->title) }}" class="btn-primary">
                        <i class="fa-solid fa-paper-plane"></i> {{ __('site.products.request_quote') }}
                    </a>
                    <a href="https://wa.me/967777000000?text={{ urlencode('استفسار عن ' . $service->title) }}" target="_blank" class="btn-whatsapp">
                        <i class="fa-brands fa-whatsapp"></i> {{ __('site.contact.btn_whatsapp') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('website.partials.footer')

@endsection
