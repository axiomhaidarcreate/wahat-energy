@extends('website.layouts.app')

@section('title', __('site.nav.calculator') . ' | ' . __('site.site_name'))

@section('content')

@include('website.partials.navbar')

{{-- ═══════════════════ PAGE HERO ═══════════════════ --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <div class="breadcrumb">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('site.common.home') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="current">{{ __('site.nav.calculator') }}</span>
            </div>
            <h1>{{ __('site.calculator.title') }}</h1>
            <p>{{ __('site.calculator.subtitle') }}</p>
        </div>
    </div>
</section>

{{-- ═══════════════════ SOLAR CALCULATOR SECTION ═══════════════════ --}}
<section class="calculator-section" x-data="solarCalculator()">
    <div class="container">
        <div class="calculator-container" data-aos="fade-up">
            {{-- System Type Selector --}}
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

            {{-- Form Inputs --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div class="calc-form-group">
                    <label>{{ __('site.calculator.monthly_bill') }}</label>
                    <input type="number" x-model.number="monthlyBill" placeholder="50000" min="0">
                </div>
                <div class="calc-form-group">
                    <label>{{ __('site.calculator.area') }}</label>
                    <input type="number" x-model.number="area" placeholder="50" min="0">
                </div>
            </div>

            <div style="text-align: center; margin: 24px 0 12px;">
                <button class="btn-primary" @click="calculate()" style="font-size: 1.05rem; padding: 14px 40px;">
                    <i class="fa-solid fa-calculator"></i> {{ __('site.calculator.calculate') }}
                </button>
            </div>

            {{-- Results Display --}}
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

            <div x-show="showResults" x-transition style="text-align: center; margin-top: 32px;">
                <a href="{{ route('contact') }}" class="btn-primary">
                    <i class="fa-solid fa-paper-plane"></i> {{ __('site.calculator.request_system') }}
                </a>
            </div>
        </div>
    </div>
</section>

@include('website.partials.footer')

@endsection

@section('scripts')
<script>
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

            const costPerKwh = { home: 80, business: 70, industrial: 60 };
            const sunHours = 5.5;
            const systemLoss = 0.2;

            const monthlyKwh = this.monthlyBill / costPerKwh[this.systemType];
            const dailyKwh = monthlyKwh / 30;
            const requiredCapacity = Math.ceil((dailyKwh / sunHours) / (1 - systemLoss) * 10) / 10;
            const batteryCapacity = Math.ceil(dailyKwh * 0.7 * 10) / 10;
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
</script>
@endsection
