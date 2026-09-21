@extends('website.layouts.app')

@section('title', $product->name . ' | ' . __('site.site_name'))
@section('meta_description', Str::limit(strip_tags($product->description ?? __('site.hero.subtitle')), 150))
@section('meta_keywords', $product->name . ', ' . ($product->category->name ?? '') . ', ' . ($product->brand->name ?? '') . ', طاقة شمسية في السعودية, ألواح شمسية السعودية')
@if($product->images->count() > 0)
    @php
        $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
    @endphp
    @section('meta_image', asset('storage/' . $primaryImage->image_path))
@endif

@section('content')

@include('website.partials.navbar')

{{-- ═══════════════════ PAGE HERO ═══════════════════ --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <div class="breadcrumb">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('site.common.home') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <a href="{{ route('products') }}">{{ __('site.nav.products') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="current">{{ $product->name }}</span>
            </div>
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->category->name ?? '' }} {{ $product->brand ? '— ' . $product->brand->name : '' }}</p>
        </div>
    </div>
</section>

{{-- ═══════════════════ PRODUCT DETAIL LAYOUT ═══════════════════ --}}
<section class="products-section" style="padding: 80px 0;">
    <div class="container">
        <div class="detail-layout">
            <div class="detail-image-box" data-aos="fade-up" style="position: relative; min-height: 300px; display: flex; flex-direction: column; align-items: center; justify-content: center; overflow: hidden; background-color: #f8fafc; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                @if($product->images->count() > 0)
                    @php
                        $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
                    @endphp
                    <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: contain; position: absolute; top: 0; left: 0;">
                @else
                    <i class="fa-solid fa-solar-panel" style="font-size: 8rem; color: var(--primary); opacity: 0.8; z-index: 1;"></i>
                @endif
                <div style="position: absolute; bottom: 16px; z-index: 2;">
                    <span class="product-badge {{ $product->stock_quantity > 0 ? 'badge-in-stock' : 'badge-out-of-stock' }}" style="position: relative; top: auto; right: auto;">
                        {{ $product->stock_quantity > 0 ? __('site.products.in_stock') : __('site.products.out_of_stock') }}
                    </span>
                </div>
            </div>

            <div class="detail-card" data-aos="fade-up" data-aos-delay="100">
                @if($product->category)
                <div style="color: var(--accent); font-weight: 600; font-size: 0.85rem; margin-bottom: 8px;">
                    {{ $product->category->name }}
                </div>
                @endif

                <h2 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 16px;">{{ $product->name }}</h2>

                <div style="font-size: 2rem; font-weight: 900; color: var(--primary); margin-bottom: 20px;">
                    {{ number_format($product->price, 0) }} <span style="font-size: 1rem; color: var(--text-muted);">{{ __('site.products.currency') }}</span>
                </div>

                <div style="color: var(--text-primary); font-size: 1.05rem; line-height: 1.8; margin-bottom: 28px; padding-left: 20px;">
                    {!! $product->description ?? 'منتج عالي الجودة معتمد ومصنع وفق أعلى المعايير التقنية العالمية لمواصفات الطاقة الشمسية.' !!}
                </div>

                {{-- Specs table --}}
                <div style="margin-bottom: 32px;">
                    <h4 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 12px; color: var(--text-primary);">{{ __('site.common.specifications') }}</h4>
                    <table class="spec-table">
                        <tr>
                            <td class="spec-name">{{ __('site.common.sku') }}</td>
                            <td class="spec-value">{{ $product->sku ?? 'SPE-' . $product->id }}</td>
                        </tr>
                        @if($product->brand)
                        <tr>
                            <td class="spec-name">{{ __('site.common.brand') }}</td>
                            <td class="spec-value">{{ $product->brand->name }}</td>
                        </tr>
                        @endif
                        @if($product->category)
                        <tr>
                            <td class="spec-name">{{ __('site.common.category') }}</td>
                            <td class="spec-value">{{ $product->category->name }}</td>
                        </tr>
                        @endif
                        @foreach($product->specifications as $spec)
                        <tr>
                            <td class="spec-name">{{ $spec->key }}</td>
                            <td class="spec-value">{{ $spec->value }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                {{-- Actions --}}
                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    <a href="{{ route('contact') }}?product={{ urlencode($product->name) }}" class="btn-primary">
                        <i class="fa-solid fa-paper-plane"></i> {{ __('site.products.request_quote') }}
                    </a>
                    <a href="https://wa.me/967777000000?text={{ urlencode('طلب شراء ' . $product->name) }}" target="_blank" class="btn-whatsapp">
                        <i class="fa-brands fa-whatsapp"></i> {{ __('site.contact.btn_whatsapp') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->count() > 0)
        <div style="margin-top: 80px;">
            <div class="section-header" data-aos="fade-up">
                <h2>{{ __('site.common.related_products') }}</h2>
            </div>
            <div class="products-grid">
                @foreach($relatedProducts as $rel)
                <div class="product-card">
                    <div class="product-image" style="position: relative; overflow: hidden; background-color: #f8fafc; display: flex; align-items: center; justify-content: center; height: 200px;">
                        @if($rel->images && $rel->images->count() > 0)
                            @php
                                $relPrimary = $rel->images->where('is_primary', true)->first() ?? $rel->images->first();
                            @endphp
                            <img src="{{ asset('storage/' . $relPrimary->image_path) }}" alt="{{ $rel->name }}" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
                        @else
                            <i class="fa-solid fa-solar-panel" style="font-size: 3.5rem; color: rgba(245,158,11,0.15); z-index: 1;"></i>
                        @endif
                    </div>
                    <div class="product-info">
                        <h3>{{ $rel->name }}</h3>
                        <div class="product-price">
                            {{ number_format($rel->price, 0) }} <span class="currency">{{ __('site.products.currency') }}</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ route('products.show', $rel->id) }}" class="btn-sm primary">{{ __('site.products.view_details') }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@include('website.partials.footer')

@endsection
