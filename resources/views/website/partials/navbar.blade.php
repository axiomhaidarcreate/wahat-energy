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
            <a href="{{ route('locale.switch', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="lang-switch hide-mobile">
                <i class="fa-solid fa-globe"></i> {{ __('site.nav.language') }}
            </a>
            <a href="{{ url('/admin') }}" class="btn-secondary hide-mobile nav-btn-staff">
                <i class="fa-solid fa-user-lock"></i> {{ __('site.nav.staff_login') }}
            </a>
            <a href="{{ route('contact') }}" class="btn-primary hide-mobile nav-btn-quote">
                {{ __('site.nav.request_quote') }}
            </a>
            <button class="navbar-toggle" onclick="toggleMobileMenu()" aria-label="Toggle menu">
                <i class="fa-solid fa-bars"></i>
                <span class="toggle-text">القائمة</span>
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
    
    <div style="width: 100%; height: 1px; background: rgba(255,255,255,0.1); margin: 15px 0;"></div>
    
    <a href="{{ route('contact') }}" onclick="toggleMobileMenu()" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #0f172a; border-radius: 50px;">
        {{ __('site.nav.request_quote') }}
    </a>
    
    <a href="{{ url('/admin') }}" onclick="toggleMobileMenu()" style="color: #f59e0b; font-size: 1.05rem;"><i class="fa-solid fa-user-lock"></i> {{ __('site.nav.staff_login') }}</a>
    <a href="{{ route('locale.switch', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="lang-switch" style="margin-top: 5px; font-size: 1.05rem;">
        <i class="fa-solid fa-globe"></i> {{ __('site.nav.language') }}
    </a>
</div>
