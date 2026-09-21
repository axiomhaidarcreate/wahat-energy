{{-- ═══════════════════ NAVBAR PARTIAL ═══════════════════ --}}
<nav class="navbar {{ request()->routeIs('home') ? 'navbar-home' : '' }}" id="mainNavbar">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="{{ __('site.site_name') }}" class="nav-logo">
            {{ __('site.site_name') }}
        </a>

        <div class="navbar-links" id="navbarLinks">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                {{ __('site.nav.home') }}
            </a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                {{ __('site.nav.about') }}
            </a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services*') ? 'active' : '' }}">
                {{ __('site.nav.services') }}
            </a>
            <a href="{{ route('products') }}" class="{{ request()->routeIs('products*') ? 'active' : '' }}">
                {{ __('site.nav.products') }}
            </a>
            <a href="{{ route('projects') }}" class="{{ request()->routeIs('projects*') ? 'active' : '' }}">
                {{ __('site.nav.projects') }}
            </a>
            <a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">
                {{ __('site.nav.gallery') }}
            </a>
            <a href="{{ route('calculator') }}" class="{{ request()->routeIs('calculator') ? 'active' : '' }}">
                {{ __('site.nav.calculator') }}
            </a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                {{ __('site.nav.contact') }}
            </a>
        </div>

        <div class="navbar-actions">
            <a href="{{ route('locale.switch', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="lang-switch">
                <i class="fa-solid fa-globe"></i> {{ __('site.nav.language') }}
            </a>
            <a href="{{ url('/admin') }}" class="btn-secondary" style="padding: 10px 24px; font-size: 0.85rem; margin-inline-end: 10px; border: 1px solid #f59e0b; color: #f59e0b; border-radius: 8px; background: transparent; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: all 0.3s ease;">
                <i class="fa-solid fa-user-lock"></i> {{ __('site.nav.staff_login') }}
            </a>
            <a href="{{ route('contact') }}" class="btn-primary" style="padding: 10px 24px; font-size: 0.85rem;">
                {{ __('site.nav.request_quote') }}
            </a>
            <button class="navbar-toggle" onclick="toggleMobileMenu()" aria-label="Toggle menu">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Menu --}}
<div class="mobile-menu" id="mobileMenu">
    <button class="mobile-close" onclick="toggleMobileMenu()"><i class="fa-solid fa-xmark"></i></button>
    <a href="{{ route('home') }}" onclick="toggleMobileMenu()">{{ __('site.nav.home') }}</a>
    <a href="{{ route('about') }}" onclick="toggleMobileMenu()">{{ __('site.nav.about') }}</a>
    <a href="{{ route('services') }}" onclick="toggleMobileMenu()">{{ __('site.nav.services') }}</a>
    <a href="{{ route('products') }}" onclick="toggleMobileMenu()">{{ __('site.nav.products') }}</a>
    <a href="{{ route('projects') }}" onclick="toggleMobileMenu()">{{ __('site.nav.projects') }}</a>
    <a href="{{ route('gallery') }}" onclick="toggleMobileMenu()">{{ __('site.nav.gallery') }}</a>
    <a href="{{ route('calculator') }}" onclick="toggleMobileMenu()">{{ __('site.nav.calculator') }}</a>
    <a href="{{ route('contact') }}" onclick="toggleMobileMenu()">{{ __('site.nav.contact') }}</a>
    <a href="{{ url('/admin') }}" onclick="toggleMobileMenu()" style="color: #f59e0b;"><i class="fa-solid fa-user-lock"></i> {{ __('site.nav.staff_login') }}</a>
    <a href="{{ route('locale.switch', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="lang-switch" style="margin-top: 16px;">
        <i class="fa-solid fa-globe"></i> {{ __('site.nav.language') }}
    </a>
</div>
