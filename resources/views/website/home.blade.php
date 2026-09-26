@extends('website.layouts.app')

@section('title', __('site.site_name') . ' | ' . __('site.site_slogan'))

@section('content')

@include('website.partials.navbar')

{{-- ═══════════════════ HERO ═══════════════════ --}}
<section class="hero" id="hero">
    {{-- Background Image with Overlay --}}
    <div class="hero-bg-image" style="background-image: url('{{ asset('images/solar_company_hero.png') }}');"></div>
    <div class="hero-overlay"></div>

    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            {{-- Company Logo --}}
            <div class="hero-logo">
                <div class="gear-shape"></div>
                <svg viewBox="0 0 440 440" class="circular-text">
                    <path id="curve-top" d="M 45, 220 A 175,175 0 0,1 395,220" fill="transparent" />
                    <path id="curve-bottom" d="M 45, 220 A 175,175 0 0,0 395,220" fill="transparent" />
                    <text>
                        <textPath href="#curve-top" startOffset="50%" text-anchor="middle" fill="#ffffff" font-size="36" font-weight="800">
                            واحة إنرجي للطاقة الشمسية
                        </textPath>
                    </text>
                    <text>
                        <textPath href="#curve-bottom" startOffset="50%" text-anchor="middle" fill="#ffffff" font-size="28" font-weight="700" letter-spacing="3">
                            WAHAT ENERGY
                        </textPath>
                    </text>
                </svg>
                <div class="logo-inner">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ __('site.site_name') }} - شعار الشركة">
                </div>
            </div>

            {{-- Company Name --}}
            <h1 class="hero-company-name">شركة واحة إنرجي للطاقة الشمسية</h1>

            {{-- Subtitle --}}
            <p class="hero-subtitle">{{ __('site.hero.subtitle') }}</p>

            {{-- CTA Button --}}
            <div class="hero-buttons">
                <a href="{{ route('about') }}" class="btn-primary">
                    <span>تعرف علينا</span>
                </a>
                <a href="{{ route('calculator') }}" class="btn-outline">
                    <i class="fa-solid fa-calculator"></i>
                    <span>{{ __('site.hero.btn_calculator') }}</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════ ABOUT COMPANY (New Section) ═══════════════════ --}}
<section class="about-company-section" id="about-home">
    <div class="container">
        <div class="about-company-grid">
            
            {{-- Image Side (Right in RTL) --}}
            <div class="about-company-image" data-aos="zoom-in" data-aos-delay="200">
                <div class="image-wrapper">
                    <img src="{{ asset('images/solar_company_hero.png') }}" alt="{{ __('site.site_name') }}">
                    <div class="image-glow"></div>
                </div>
            </div>

            {{-- Text Side (Left in RTL) --}}
            <div class="about-company-content" data-aos="fade-up" data-aos-delay="100">
                <div class="section-title">
                    <h2>{{ __('site.about_company.title') }}</h2>
                    <h3 class="subtitle-highlight">{{ __('site.about_company.subtitle') }}</h3>
                </div>
                
                <ul class="about-points-list">
                    @foreach(__('site.about_company.points') as $point)
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ $point }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</section>


{{-- ═══════════════════ BRANDS MARQUEE ═══════════════════ --}}
<section class="brands-section">
    <div class="brands-track">
        @foreach($brands as $brand)
            <span class="brand-item"><i class="fa-solid fa-sun"></i> {{ $brand->name }}</span>
        @endforeach
        <span class="brand-item"><i class="fa-solid fa-solar-panel"></i> Trina Solar</span>
        <span class="brand-item"><i class="fa-solid fa-bolt"></i> Sungrow</span>
        <span class="brand-item"><i class="fa-solid fa-battery-full"></i> Huawei</span>
        <span class="brand-item"><i class="fa-solid fa-plug"></i> JA Solar</span>
        <span class="brand-item"><i class="fa-solid fa-sun"></i> Canadian Solar</span>
        {{-- Duplicate for seamless loop --}}
        @foreach($brands as $brand)
            <span class="brand-item"><i class="fa-solid fa-sun"></i> {{ $brand->name }}</span>
        @endforeach
        <span class="brand-item"><i class="fa-solid fa-solar-panel"></i> Trina Solar</span>
        <span class="brand-item"><i class="fa-solid fa-bolt"></i> Sungrow</span>
        <span class="brand-item"><i class="fa-solid fa-battery-full"></i> Huawei</span>
        <span class="brand-item"><i class="fa-solid fa-plug"></i> JA Solar</span>
        <span class="brand-item"><i class="fa-solid fa-sun"></i> Canadian Solar</span>
    </div>
</section>

{{-- ═══════════════════ SERVICES ═══════════════════ --}}
<section class="services-section" id="services">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>{{ __('site.services.title') }}</h2>
            <p>{{ __('site.services.subtitle') }}</p>
        </div>
        <div class="services-grid">
            @foreach($services as $i => $service)
            <div class="service-card-bg" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}" style="background-image: url('{{ $service->image_path ? asset('storage/' . $service->image_path) : 'https://images.unsplash.com/photo-1509391366360-2e959784a276?q=80&w=800&auto=format&fit=crop' }}');">
                <div class="service-icon">
                    <i class="fa-solid {{ $service->icon }}"></i>
                </div>
                <h3>{{ $service->title }}</h3>
                <p style="margin-bottom: 20px;">{{ Str::limit($service->description, 100) }}</p>
                <a href="{{ route('services.show', $service->slug) }}" class="btn-sm primary" style="display: inline-flex; padding: 8px 16px;">
                    {{ __('site.common.details') }} <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════ PRODUCTS (Dynamic from MySQL) ═══════════════════ --}}
<section class="products-section" id="products">
    <div class="container" style="max-width: 1400px;">
        <div class="section-header" data-aos="fade-up">
            <h2>{{ __('site.products.title') }}</h2>
            <p>{{ __('site.products.subtitle') }}</p>
        </div>

        @foreach($categories as $category)
            @if($category->products->count() > 0)
            <div class="category-block" data-aos="fade-up">
                <h3 class="category-title">{{ $category->name }}</h3>
                
                <div class="products-3d-scroll-container">
                    <div class="products-3d-track">
                        @foreach($category->products as $product)
                        <a href="{{ route('products.show', $product->id) }}" class="product-3d-card">
                            <div class="card-inner">
                                <div class="card-image" style="background-color: #f8fafc; position: relative; overflow: hidden;">
                                    @if($product->images->count() > 0)
                                        @php
                                            $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
                                        @endphp
                                        <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="{{ $product->name }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <i class="fa-solid {{ 
                                            $category->slug == 'solar-panels' ? 'fa-solar-panel' : 
                                            ($category->slug == 'lithium-batteries' ? 'fa-battery-full' : 
                                            ($category->slug == 'inverters' ? 'fa-plug' : 'fa-box')) 
                                        }}"></i>
                                    @endif
                                </div>
                                <div class="card-content">
                                    @if($product->brand)
                                    <span class="brand-tag">{{ $product->brand->name }}</span>
                                    @endif
                                    <h4>{{ $product->name }}</h4>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        @endforeach

        <div class="section-footer" data-aos="fade-up" style="margin-top: 40px;">
            <a href="{{ route('products') }}" class="btn-outline">{{ __('site.products.view_all') }} <i class="fa-solid fa-arrow-left"></i></a>
        </div>
    </div>
</section>


{{-- ═══════════════════ SOLAR CALCULATOR ═══════════════════ --}}
<section class="calculator-section" id="calculator" x-data="solarCalculator()">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>{{ __('site.calculator.title') }}</h2>
            <p>{{ __('site.calculator.subtitle') }}</p>
        </div>
        <div class="calculator-container" data-aos="fade-up">
            {{-- System Type --}}
            <div class="calc-type-selector">
                <button class="calc-type-btn" :class="{ active: systemType === 'home' }" @click="systemType = 'home'">
                    <i class="fa-solid fa-house"></i> {{ __('site.calculator.type_home') }}
                </button>
                <button class="calc-type-btn" :class="{ active: systemType === 'business' }" @click="systemType = 'business'">
                    <i class="fa-solid fa-building"></i> {{ __('site.calculator.type_business') }}
                </button>
                <button class="calc-type-btn" :class="{ active: systemType === 'industrial' }" @click="systemType = 'industrial'">
                    <i class="fa-solid fa-industry"></i> {{ __('site.calculator.type_industrial') }}
                </button>
            </div>

            {{-- Form --}}
            <div class="calc-form-row">
                <div class="calc-form-group">
                    <label>{{ __('site.calculator.monthly_bill') }}</label>
                    <input type="number" x-model.number="monthlyBill" placeholder="50000" min="0">
                </div>
                <div class="calc-form-group">
                    <label>{{ __('site.calculator.area') }}</label>
                    <input type="number" x-model.number="area" placeholder="50" min="0">
                </div>
            </div>

            <div style="text-align: center; margin: 16px 0;">
                <button class="btn-primary" @click="calculate()" style="font-size: 1.05rem;">
                    <i class="fa-solid fa-calculator"></i> {{ __('site.calculator.calculate') }}
                </button>
            </div>

            {{-- Results --}}
            <div x-show="showResults" x-transition class="calc-results">
                <div class="calc-result-card">
                    <div class="result-value" x-text="results.dailyConsumption + ' {{ __("site.calculator.kwh") }}'"></div>
                    <div class="result-label">{{ __('site.calculator.daily_consumption') }}</div>
                </div>
                <div class="calc-result-card">
                    <div class="result-value" x-text="results.solarCapacity + ' {{ __("site.calculator.kwp") }}'"></div>
                    <div class="result-label">{{ __('site.calculator.solar_capacity') }}</div>
                </div>
                <div class="calc-result-card">
                    <div class="result-value" x-text="results.batteryCapacity + ' {{ __("site.calculator.kwh") }}'"></div>
                    <div class="result-label">{{ __('site.calculator.battery_capacity') }}</div>
                </div>
                <div class="calc-result-card">
                    <div class="result-value" x-text="results.inverterCapacity + ' {{ __("site.calculator.kw") }}'"></div>
                    <div class="result-label">{{ __('site.calculator.inverter_capacity') }}</div>
                </div>
                <div class="calc-result-card">
                    <div class="result-value" x-text="results.estimatedProduction + ' {{ __("site.calculator.kwh") }}'"></div>
                    <div class="result-label">{{ __('site.calculator.estimated_production') }}</div>
                </div>
                <div class="calc-result-card">
                    <div class="result-value" x-text="results.estimatedCost + ' {{ __("site.products.currency") }}'"></div>
                    <div class="result-label">{{ __('site.calculator.estimated_cost') }}</div>
                </div>
            </div>

            <div x-show="showResults" x-transition style="text-align: center; margin-top: 24px;">
                <a href="#contact" class="btn-primary">
                    <i class="fa-solid fa-paper-plane"></i> {{ __('site.calculator.request_system') }}
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════ STATISTICS ═══════════════════ --}}
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up">
                <div class="stat-icon"><i class="fa-solid fa-diagram-project"></i></div>
                <div class="stat-value" x-data="counter({{ max($stats['projects'], 150) }})" x-text="count">0</div>
                <div class="stat-label">{{ __('site.stats.projects_completed') }}</div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon"><i class="fa-solid fa-solar-panel"></i></div>
                <div class="stat-value" x-data="counter(5000)" x-text="count">0</div>
                <div class="stat-label">{{ __('site.stats.panels_installed') }}</div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon"><i class="fa-solid fa-face-smile"></i></div>
                <div class="stat-value" x-data="counter({{ max($stats['customers'], 200) }})" x-text="count">0</div>
                <div class="stat-label">{{ __('site.stats.happy_customers') }}</div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon"><i class="fa-solid fa-bolt"></i></div>
                <div class="stat-value" x-data="counter(850)" x-text="count">0</div>
                <div class="stat-label">{{ __('site.stats.mw_generated') }}</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════ PROJECTS (Dynamic from MySQL) ═══════════════════ --}}
<section class="projects-section" id="projects">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>{{ __('site.projects.title') }}</h2>
            <p>{{ __('site.projects.subtitle') }}</p>
        </div>
        <div class="projects-grid">
            @forelse($projects as $project)
            <div class="project-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="project-image" style="{{ $project->image_path ? 'background-image: url(' . asset('storage/' . $project->image_path) . '); background-size: cover; background-position: center;' : '' }}">
                    @if(!$project->image_path)
                        <i class="fa-solid fa-solar-panel"></i>
                    @endif
                </div>
                <div class="project-overlay">
                    <div class="project-meta">
                        <span>{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span>
                        @if($project->start_date)
                        <span>{{ $project->start_date->format('Y') }}</span>
                        @endif
                    </div>
                    <h3>{{ $project->name }}</h3>
                    @if($project->description)
                        <p style="font-size: 0.9rem; line-height: 1.5; margin-bottom: 12px; color: rgba(255,255,255,0.85);">{{ Str::limit($project->description, 100) }}</p>
                    @else
                        <p>{{ $project->customer->name ?? '' }} — {{ $project->project_code }}</p>
                    @endif
                </div>
            </div>
            @empty
            {{-- Sample projects when DB is empty --}}
            @for($i = 1; $i <= 3; $i++)
            <div class="project-card" data-aos="fade-up" data-aos-delay="{{ ($i - 1) * 100 }}">
                <div class="project-image">
                    <i class="fa-solid fa-solar-panel"></i>
                </div>
                <div class="project-overlay">
                    <div class="project-meta">
                        <span>{{ ['Residential', 'Commercial', 'Industrial'][$i - 1] }}</span>
                        <span>2026</span>
                    </div>
                    <h3>{{ ['Villa Solar System 10KW', 'Office Building 50KW', 'Factory Solar Farm 200KW'][$i - 1] }}</h3>
                    <p>Wahat Energy — PRJ-2026-00{{ $i }}</p>
                </div>
            </div>
            @endfor
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════ HOW IT WORKS ═══════════════════ --}}
<section class="how-section" id="how">
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

{{-- ═══════════════════ WHY CHOOSE US ═══════════════════ --}}
<section class="why-section" id="why">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>{{ __('site.why_us.title') }}</h2>
            <p>{{ __('site.why_us.subtitle') }}</p>
        </div>
        <div class="why-grid">
            @foreach(__('site.why_us.items') as $i => $item)
            <div class="why-card" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="why-icon"><i class="fa-solid {{ $item['icon'] }}"></i></div>
                <h3>{{ $item['title'] }}</h3>
                <p>{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════ TESTIMONIALS ═══════════════════ --}}
<section class="testimonials-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>{{ __('site.testimonials.title') }}</h2>
            <p>{{ __('site.testimonials.subtitle') }}</p>
        </div>
        <div class="testimonials-grid">
            @php
            $testimonials = [
                ['name' => app()->getLocale() == 'ar' ? 'أحمد محمد' : 'Ahmed Mohammed', 'role' => app()->getLocale() == 'ar' ? 'صاحب منزل' : 'Homeowner', 'text' => app()->getLocale() == 'ar' ? 'تجربة ممتازة من البداية للنهاية. فريق محترف وتركيب سريع ونظيف. توفر فاتورة الكهرباء بشكل ملحوظ.' : 'Excellent experience from start to finish. Professional team, fast and clean installation. Noticeable savings on electricity bills.', 'initials' => 'أ'],
                ['name' => app()->getLocale() == 'ar' ? 'سارة العمري' : 'Sara Al-Omari', 'role' => app()->getLocale() == 'ar' ? 'صاحبة مشروع تجاري' : 'Business Owner', 'text' => app()->getLocale() == 'ar' ? 'قمت بتركيب نظام شمسي لمحلي التجاري والنتائج فاقت توقعاتي. شكراً واحة إنرجي على الاحترافية.' : 'Installed a solar system for my shop and the results exceeded expectations. Thank you Wahat Energy for the professionalism.', 'initials' => 'س'],
                ['name' => app()->getLocale() == 'ar' ? 'خالد الحسيني' : 'Khalid Al-Husseini', 'role' => app()->getLocale() == 'ar' ? 'مدير مصنع' : 'Factory Manager', 'text' => app()->getLocale() == 'ar' ? 'نظام طاقة شمسية صناعي بقدرة 200 كيلو واط. التوفير كبير جداً والدعم الفني ممتاز ومستمر.' : 'A 200 kW industrial solar system. The savings are significant and the technical support is excellent and ongoing.', 'initials' => 'خ'],
            ];
            @endphp
            @foreach($testimonials as $i => $t)
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="testimonial-stars">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-text">"{{ $t['text'] }}"</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">{{ $t['initials'] }}</div>
                    <div>
                        <div class="testimonial-name">{{ $t['name'] }}</div>
                        <div class="testimonial-role">{{ $t['role'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════ FAQ ═══════════════════ --}}
<section class="faq-section" id="faq">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>{{ __('site.faq.title') }}</h2>
            <p>{{ __('site.faq.subtitle') }}</p>
        </div>
        <div class="faq-list" data-aos="fade-up">
            @foreach(__('site.faq.items') as $i => $faq)
            <div class="faq-item" x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }">
                <button class="faq-question" :class="{ open: open }" @click="open = !open">
                    <span>{{ $faq['q'] }}</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer" :class="{ open: open }">
                    {{ $faq['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════ CONTACT CTA ═══════════════════ --}}
<section class="cta-section" id="contact">
    <div class="container">
        <div class="cta-content" data-aos="fade-up">
            <h2>{{ __('site.contact.title') }}</h2>
            <p>{{ __('site.contact.subtitle') }}</p>

            {{-- Contact Numbers --}}
            <div class="cta-contact-numbers">
                <a href="tel:0509977409" class="cta-phone-card">
                    <div class="phone-icon-circle">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <span class="phone-number">0509977409</span>
                    <a href="https://wa.me/966509977409" target="_blank" class="wa-mini-btn">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </a>
                <a href="tel:0559113515" class="cta-phone-card">
                    <div class="phone-icon-circle">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <span class="phone-number">0559113515</span>
                    <a href="https://wa.me/966559113515" target="_blank" class="wa-mini-btn">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </a>
                <a href="tel:0509920744" class="cta-phone-card">
                    <div class="phone-icon-circle">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <span class="phone-number">0509920744</span>
                    <a href="https://wa.me/966509920744" target="_blank" class="wa-mini-btn">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </a>
            </div>

            {{-- Company Info --}}
            <div class="cta-company-info">
                <div class="cta-info-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>الرياض - العقيق</span>
                </div>
                <div class="cta-info-item">
                    <i class="fa-solid fa-id-card"></i>
                    <span>رقم العضوية: 1314253</span>
                </div>
                <div class="cta-info-item">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>س.ت: 7055105402</span>
                </div>
            </div>

            <div class="cta-buttons">
                <a href="mailto:{{ __('site.contact.email') }}" class="btn-outline">
                    <i class="fa-solid fa-envelope"></i> {{ __('site.contact.btn_email') }}
                </a>
            </div>
        </div>
    </div>
</section>

@include('website.partials.footer')


@endsection

@section('scripts')
<script>
// ──── Navbar scroll effect ────
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('mainNavbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// ──── Mobile Menu ────
function toggleMobileMenu() {
    document.getElementById('mobileMenu').classList.toggle('active');
}

// ──── Solar Calculator (Alpine.js) ────
function solarCalculator() {
    return {
        systemType: 'home',
        monthlyBill: 0,
        area: 0,
        showResults: false,
        results: {
            dailyConsumption: 0,
            solarCapacity: 0,
            batteryCapacity: 0,
            inverterCapacity: 0,
            estimatedProduction: 0,
            estimatedCost: 0
        },
        calculate() {
            if (this.monthlyBill <= 0) return;

            // Cost per kWh varies by type
            const costPerKwh = { home: 80, business: 70, industrial: 60 };
            const sunHours = 5.5; // Average sun hours
            const systemLoss = 0.2; // 20% system losses

            const monthlyKwh = this.monthlyBill / costPerKwh[this.systemType];
            const dailyKwh = monthlyKwh / 30;
            const requiredCapacity = Math.ceil((dailyKwh / sunHours) / (1 - systemLoss) * 10) / 10;
            const batteryCapacity = Math.ceil(dailyKwh * 0.7 * 10) / 10; // 70% backup
            const inverterCapacity = Math.ceil(requiredCapacity * 1.25 * 10) / 10;
            const annualProduction = Math.round(requiredCapacity * sunHours * 365 * (1 - systemLoss));
            const pricePerKw = { home: 800000, business: 700000, industrial: 600000 };
            const estimatedCost = Math.round(requiredCapacity * pricePerKw[this.systemType]);

            this.results = {
                dailyConsumption: Math.round(dailyKwh * 10) / 10,
                solarCapacity: requiredCapacity,
                batteryCapacity: batteryCapacity,
                inverterCapacity: inverterCapacity,
                estimatedProduction: annualProduction,
                estimatedCost: estimatedCost.toLocaleString()
            };

            this.showResults = true;
        }
    };
}

// ──── Counter Animation (Alpine.js) ────
function counter(target) {
    return {
        count: 0,
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.animateCounter(target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            observer.observe(this.$el);
        },
        animateCounter(target) {
            const duration = 2000;
            const start = performance.now();
            const step = (timestamp) => {
                const progress = Math.min((timestamp - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                this.count = Math.round(eased * target);
                if (progress < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        }
    };
}
</script>
@endsection
