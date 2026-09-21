@extends('website.layouts.app')

@section('title', __('site.nav.products') . ' | ' . __('site.site_name'))

@section('content')

@include('website.partials.navbar')

{{-- ═══════════════════ PAGE HERO ═══════════════════ --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <div class="breadcrumb">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('site.common.home') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="current">{{ __('site.nav.products') }}</span>
            </div>
            <h1>{{ __('site.products.title') }}</h1>
            <p>{{ __('site.products.subtitle') }}</p>
        </div>
    </div>
</section>

{{-- ═══════════════════ CATALOG & FILTERS ═══════════════════ --}}
<section class="products-section">
    <div class="container">
        {{-- Filter Bar --}}
        <div class="filter-bar" data-aos="fade-up">
            <form action="{{ route('products') }}" method="GET" style="display: flex; width: 100%; flex-wrap: wrap; justify-content: space-between; gap: 20px; align-items: center;">
                <div class="filter-group">
                    <a href="{{ route('products') }}" class="filter-pill {{ !request('category') && !request('brand') ? 'active' : '' }}">
                        {{ __('site.common.all') }}
                    </a>
                    @foreach($categories as $cat)
                    <a href="{{ route('products', ['category' => $cat->id]) }}" class="filter-pill {{ request('category') == $cat->id ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('site.common.search_placeholder') }}">
                </div>
            </form>
        </div>

        {{-- Products Grid --}}
        <div class="products-grid">
            @forelse($products as $product)
            <div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                <div class="product-image" style="position: relative; height: 250px; display: flex; align-items: center; justify-content: center; overflow: hidden; background-color: #f8fafc;">
                    @if($product->brand)
                    <span class="product-brand-badge" style="z-index: 2;">{{ $product->brand->name }}</span>
                    @endif
                    <span class="product-badge {{ $product->stock_quantity > 0 ? 'badge-in-stock' : 'badge-out-of-stock' }}" style="z-index: 2;">
                        {{ $product->stock_quantity > 0 ? __('site.products.in_stock') : __('site.products.out_of_stock') }}
                    </span>
                    @if($product->images->count() > 0)
                        @php
                            $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
                        @endphp
                        <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
                    @else
                        <i class="fa-solid fa-solar-panel" style="font-size: 4.5rem; color: rgba(245,158,11,0.12); position: relative; z-index: 1;"></i>
                    @endif
                </div>
                <div class="product-info">
                    @if($product->category)
                    <div class="product-category">{{ $product->category->name }}</div>
                    @endif
                    <h3>{{ $product->name }}</h3>
                    <div class="product-price">
                        {{ number_format($product->price, 0) }} <span class="currency">{{ __('site.products.currency') }}</span>
                    </div>
                    <div class="product-actions">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-sm primary">{{ __('site.products.view_details') }}</a>
                        <a href="{{ route('contact') }}?product={{ urlencode($product->name) }}" class="btn-sm outline">{{ __('site.products.request_quote') }}</a>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: var(--text-secondary);">
                <i class="fa-solid fa-box-open" style="font-size: 3rem; margin-bottom: 16px; color: var(--text-muted);"></i>
                <h3>لا توجد منتجات مطابقة للبحث</h3>
                <p style="margin-top: 8px;">جرّب التفتيش بكلمات أخرى أو اختر فئة مختلفة.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination links --}}
        <div style="margin-top: 48px; display: flex; justify-content: center;">
            {{ $products->links() }}
        </div>
    </div>
</section>

@include('website.partials.footer')

@endsection
