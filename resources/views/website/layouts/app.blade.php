<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('site.site_name') . ' | شركة طاقة شمسية في السعودية | حلول وأنظمة الطاقة المتجددة')</title>
    <meta name="description" content="@yield('meta_description', 'شركة واحة إنرجي - أفضل شركة طاقة شمسية ومقاول طاقة متجددة في السعودية والرياض. توريد وتركيب ألواح شمسية للمنازل والمصانع، أنظمة On-Grid و Off-Grid و Hybrid، بطاريات تخزين الطاقة BESS، وتوريد المحولات والانفرترات بأفضل الأسعار.')">
    <meta name="keywords" content="@yield('meta_keywords', 'شركة طاقة شمسية في السعودية, شركات الطاقة الشمسية في السعودية, أفضل شركة طاقة شمسية, شركة تركيب ألواح شمسية, شركة أنظمة الطاقة الشمسية, شركة طاقة متجددة, حلول الطاقة الشمسية, مقاول طاقة شمسية, تركيب طاقة شمسية للمنازل, أسعار أنظمة الطاقة الشمسية في السعودية, تكلفة تركيب الطاقة الشمسية, توريد وتركيب الألواح الشمسية, تنفيذ مشاريع الطاقة الشمسية, تركيب أنظمة الطاقة الشمسية للمصانع, شركة صيانة أنظمة الطاقة الشمسية, عروض أسعار الطاقة الشمسية, أنظمة الطاقة الشمسية On Grid, أنظمة الطاقة الشمسية Off Grid, أنظمة الطاقة الشمسية Hybrid, بطاريات تخزين الطاقة BESS, أنظمة تخزين الطاقة بالبطاريات, توريد وتركيب انفرترات الطاقة الشمسية, أنظمة ضخ المياه بالطاقة الشمسية, Solar PV System Installation, Solar EPC Contractor, Solar Pumping System, Solar Energy Company in Saudi Arabia, Solar Energy Company Riyadh, Solar EPC Contractor Saudi Arabia, Solar Panel Installation Saudi Arabia, Commercial Solar Power Systems, Industrial Solar Energy Solutions, On Grid Solar System, Hybrid Solar Power System, BESS Battery Energy Storage System, Solar Water Pumping System, Solar Inverter Supplier Saudi Arabia, Solar PV Design and Installation, Solar System Operation and Maintenance, Renewable Energy Company KSA, واحة إنرجي, الرياض')">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="author" content="Wahat Energy Company | شركة واحة إنرجي">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / WhatsApp / Facebook -->
    <meta property="og:locale" content="{{ app()->getLocale() == 'ar' ? 'ar_SA' : 'en_US' }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', __('site.site_name') . ' | شركة طاقة شمسية في السعودية')">
    <meta property="og:description" content="@yield('meta_description', 'شركة واحة إنرجي - أفضل شركة طاقة شمسية ومقاول طاقة متجددة في السعودية. حلول On-Grid و Off-Grid و Hybrid وبطاريات BESS.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ __('site.site_name') }}">
    <meta property="og:image" content="@yield('meta_image', asset('images/logo.png'))">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', __('site.site_name') . ' | شركة طاقة شمسية في السعودية')">
    <meta name="twitter:description" content="@yield('meta_description', 'شركة واحة إنرجي - أفضل شركة طاقة شمسية ومقاول طاقة متجددة في السعودية. حلول On-Grid و Off-Grid و Hybrid وبطاريات BESS.')">
    <meta name="twitter:image" content="@yield('meta_image', asset('images/logo.png'))">

    <!-- Schema.org Markup (LocalBusiness & Organization) -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": ["LocalBusiness", "SolarEnergyCompany", "Organization"],
      "name": "شركة واحة إنرجي للطاقة الشمسية",
      "alternateName": ["Wahat Energy Company", "واحة إنرجي"],
      "image": "{{ asset('images/logo.png') }}",
      "@@id": "{{ url('/') }}",
      "url": "{{ url('/') }}",
      "telephone": ["0509977409", "0559113515"],
      "priceRange": "$$",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "حي العقيق",
        "addressLocality": "الرياض",
        "addressRegion": "منطقة الرياض",
        "addressCountry": "SA"
      },
      "geo": {
        "@@type": "GeoCoordinates",
        "latitude": 24.774265,
        "longitude": 46.638567
      },
      "openingHoursSpecification": {
        "@@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday"],
        "opens": "08:00",
        "closes": "20:00"
      },
      "description": "شركة واحة إنرجي الرائدة في حلول وأنظمة الطاقة الشمسية في السعودية والرياض. مقاول طاقة شمسية EPC معتمد، توريد وتركيب أنظمة On-Grid و Off-Grid و Hybrid، بطاريات BESS، انفرترات، ومحطات الطاقة للمنازل والمصانع والمزارع.",
      "keywords": "شركة طاقة شمسية في السعودية, شركات الطاقة الشمسية في السعودية, أفضل شركة طاقة شمسية, شركة تركيب ألواح شمسية, مقاول طاقة شمسية, تركيب طاقة شمسية للمنازل, تركيب أنظمة الطاقة الشمسية للمصانع, Solar Energy Company in Saudi Arabia, Solar EPC Contractor Saudi Arabia, BESS Battery Energy Storage System",
      "areaServed": [
        {
          "@@type": "Country",
          "name": "Saudi Arabia"
        },
        {
          "@@type": "City",
          "name": "Riyadh"
        }
      ],
      "hasOfferCatalog": {
        "@@type": "OfferCatalog",
        "name": "حلول وخدمات الطاقة الشمسية",
        "itemListElement": [
          {
            "@@type": "Offer",
            "itemOffered": {
              "@@type": "Service",
              "name": "تركيب طاقة شمسية للمنازل والفلل السكنية"
            }
          },
          {
            "@@type": "Offer",
            "itemOffered": {
              "@@type": "Service",
              "name": "تركيب أنظمة الطاقة الشمسية للمصانع والمنشآت التجارية"
            }
          },
          {
            "@@type": "Offer",
            "itemOffered": {
              "@@type": "Service",
              "name": "أنظمة الطاقة الشمسية On-Grid و Off-Grid و Hybrid"
            }
          },
          {
            "@@type": "Offer",
            "itemOffered": {
              "@@type": "Service",
              "name": "بطاريات تخزين الطاقة BESS وأنظمة التخزين الذكية"
            }
          },
          {
            "@@type": "Offer",
            "itemOffered": {
              "@@type": "Service",
              "name": "أنظمة ضخ المياه بالطاقة الشمسية للمزارع (Solar Pumping Systems)"
            }
          },
          {
            "@@type": "Offer",
            "itemOffered": {
              "@@type": "Service",
              "name": "تشغيل وصيانة أنظمة الطاقة الشمسية (O&M)"
            }
          }
        ]
      }
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
    <link rel="stylesheet" href="{{ asset('css/website.css') }}?v={{ time() }}">
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
