<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('site.site_name') . ' | ' . __('site.site_slogan'))</title>
    <meta name="description" content="@yield('meta_description', __('site.hero.subtitle'))">
    <meta name="keywords" content="@yield('meta_keywords', 'طاقة شمسية في السعودية, ألواح شمسية السعودية, تركيب طاقة شمسية, بطاريات طاقة شمسية, واحة إنرجي, محولات شمسية, مشاريع طاقة متجددة, طاقة نظيفة, السعودية, الرياض, جدة, الدمام, Solar energy in Saudi Arabia, Solar panels KSA, Solar installation, Solar batteries, Wahat Energy, Solar inverters, Renewable energy projects, Clean energy, Saudi Arabia, Riyadh, Jeddah')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Wahat Energy Company">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', __('site.site_name'))">
    <meta property="og:description" content="@yield('meta_description', __('site.hero.subtitle'))">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ __('site.site_name') }}">
    <meta property="og:image" content="@yield('meta_image', asset('images/logo.png'))">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', __('site.site_name'))">
    <meta name="twitter:description" content="@yield('meta_description', __('site.hero.subtitle'))">
    <meta name="twitter:image" content="@yield('meta_image', asset('images/logo.png'))">

    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "LocalBusiness",
      "name": "{{ __('site.site_name') }}",
      "image": "{{ asset('images/logo.png') }}",
      "@@id": "{{ url('/') }}",
      "url": "{{ url('/') }}",
      "telephone": "{{ __('site.contact.phone') }}",
      "address": {
        "@@type": "PostalAddress",
        "addressLocality": "Sanaa / Aden / Riyadh",
        "addressCountry": "YE / SA"
      },
      "description": "{{ __('site.hero.subtitle') }}"
    }
    </script>

    <!-- Alternate Languages -->
    <link rel="alternate" hreflang="ar" href="{{ url('/') }}">
    <link rel="alternate" hreflang="en" href="{{ url('/') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        @yield('extra_css')
    </style>
    <link rel="stylesheet" href="{{ asset('css/website.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">
</head>
<body class="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

    @yield('content')

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Mobile Menu Script -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            if(menu) {
                menu.classList.toggle('active');
            }
        }
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if(navbar) {
                if(window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });
    </script>

    @yield('scripts')

    {{-- Chatbot --}}
    @include('website.partials.chatbot')
</body>
</html>
