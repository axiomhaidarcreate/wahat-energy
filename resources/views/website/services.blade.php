@extends('website.layouts.app')

@section('title', __('site.nav.services') . ' | ' . __('site.site_name'))

@section('content')

@include('website.partials.navbar')

{{-- ═══════════════════ PAGE HERO ═══════════════════ --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <div class="breadcrumb">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('site.common.home') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="current">{{ __('site.nav.services') }}</span>
            </div>
            <h1>{{ __('site.services.title') }}</h1>
            <p>{{ __('site.services.subtitle') }}</p>
        </div>
    </div>
</section>

{{-- ═══════════════════ SERVICES GRID ═══════════════════ --}}
<section class="services-section">
    <div class="container">
        <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
            @foreach($services as $i => $service)
            <div class="service-card-bg" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}" style="background-image: url('{{ $service->image_path ? asset('storage/' . $service->image_path) : 'https://images.unsplash.com/photo-1509391366360-2e959784a276?q=80&w=800&auto=format&fit=crop' }}');">
                <div class="service-icon">
                    <i class="fa-solid {{ $service->icon }}"></i>
                </div>
                <h3>{{ $service->title }}</h3>
                <p style="margin-bottom: 24px;">{{ $service->description }}</p>
                
                <div style="display: flex; gap: 12px; flex-wrap: wrap; justify-content: center;">
                    <a href="{{ route('services.show', $service->slug) }}" class="btn-primary" style="padding: 10px 20px; font-size: 0.85rem; border-radius: 6px;">
                        <i class="fa-solid fa-arrow-left"></i> {{ __('site.common.details') }}
                    </a>
                    <a href="{{ route('contact') }}?service={{ urlencode($service->title) }}" class="btn-outline" style="padding: 10px 20px; font-size: 0.85rem; border-radius: 6px;">
                        {{ __('site.products.request_quote') }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════ HOW WE WORK ═══════════════════ --}}
<section class="how-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>{{ __('site.how_it_works.title') }}</h2>
            <p>{{ __('site.how_it_works.subtitle') }}</p>
        </div>
        <div class="how-steps">
            @foreach(__('site.how_it_works.steps') as $i => $step)
            <div class="how-step" data-aos="fade-up" data-aos-delay="{{ $i * 150 }}">
                <div class="step-number">{{ $i + 1 }}</div>
                <h3>{{ $step['title'] }}</h3>
                <p>{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@include('website.partials.footer')

@endsection
