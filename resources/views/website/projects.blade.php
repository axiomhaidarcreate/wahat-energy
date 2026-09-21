@extends('website.layouts.app')

@section('title', __('site.nav.projects') . ' | ' . __('site.site_name'))

@section('content')

@include('website.partials.navbar')

{{-- ═══════════════════ PAGE HERO ═══════════════════ --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <div class="breadcrumb">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('site.common.home') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="current">{{ __('site.nav.projects') }}</span>
            </div>
            <h1>{{ __('site.projects.title') }}</h1>
            <p>{{ __('site.projects.subtitle') }}</p>
        </div>
    </div>
</section>

{{-- ═══════════════════ DISTINCTIVE STYLES ═══════════════════ --}}
<style>
    /* Core Specializations Styles */
    .specializations-section {
        padding: 100px 0;
        background: var(--bg-surface);
        position: relative;
        overflow: hidden;
    }
    html[dir="rtl"] .specializations-section {
        /* RTL support */
    }
    
    .spec-header {
        text-align: center;
        margin-bottom: 60px;
    }
    .spec-header h2 {
        font-size: 2.5rem;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
    }
    
    .spec-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        position: relative;
        z-index: 2;
    }
    
    .spec-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 24px;
        padding: 40px 30px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }
    
    .spec-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    html[dir="rtl"] .spec-card::before {
        transform-origin: right;
    }
    
    .spec-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px -10px rgba(16, 185, 129, 0.15);
        border-color: rgba(16, 185, 129, 0.3);
    }
    
    .spec-card:hover::before {
        transform: scaleX(1);
    }
    
    .spec-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(6, 182, 212, 0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 25px;
        box-shadow: inset 0 0 0 1px rgba(16, 185, 129, 0.2);
    }
    
    .spec-card h3 {
        font-size: 1.4rem;
        margin-bottom: 20px;
        color: var(--text-main);
        font-weight: 700;
        line-height: 1.4;
    }
    
    .spec-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .spec-list li {
        position: relative;
        padding-inline-start: 25px;
        margin-bottom: 12px;
        color: var(--text-secondary);
        font-size: 1.05rem;
        line-height: 1.6;
    }
    
    .spec-list li::before {
        content: '\f058';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        inset-inline-start: 0;
        top: 2px;
        color: var(--accent);
        font-size: 1rem;
    }
    
    /* Departments Styles */
    .departments-section {
        padding: 100px 0;
        background: #0f172a; /* Deep modern dark */
        position: relative;
        color: white;
    }
    
    .dep-header {
        text-align: center;
        margin-bottom: 70px;
    }
    
    .dep-header h2 {
        font-size: 2.5rem;
        color: #ffffff;
        margin-bottom: 15px;
    }
    
    .dep-timeline {
        position: relative;
        max-width: 1000px;
        margin: 0 auto;
    }
    
    .dep-timeline::after {
        content: '';
        position: absolute;
        width: 2px;
        background: rgba(255, 255, 255, 0.1);
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -1px;
    }
    
    .dep-item {
        padding: 10px 40px;
        position: relative;
        background: inherit;
        width: 50%;
        box-sizing: border-box;
        margin-bottom: 40px;
    }
    
    .dep-item:nth-child(odd) {
        left: 0;
    }
    
    .dep-item:nth-child(even) {
        left: 50%;
    }
    
    html[dir="rtl"] .dep-timeline::after {
        right: 50%;
        left: auto;
        margin-right: -1px;
        margin-left: 0;
    }
    html[dir="rtl"] .dep-item:nth-child(odd) {
        right: 0;
        left: auto;
    }
    html[dir="rtl"] .dep-item:nth-child(even) {
        right: 50%;
        left: auto;
    }
    
    .dep-item::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        right: -10px;
        background: var(--bg-surface);
        border: 4px solid var(--accent);
        top: 20px;
        border-radius: 50%;
        z-index: 1;
        box-shadow: 0 0 15px rgba(6, 182, 212, 0.5);
    }
    
    .dep-item:nth-child(even)::after {
        left: -10px;
        right: auto;
    }
    html[dir="rtl"] .dep-item::after {
        left: -10px;
        right: auto;
    }
    html[dir="rtl"] .dep-item:nth-child(even)::after {
        right: -10px;
        left: auto;
    }
    
    .dep-content {
        padding: 30px;
        background: rgba(30, 41, 59, 0.7);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        position: relative;
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease, background 0.3s ease;
    }
    
    .dep-content:hover {
        transform: translateY(-5px) scale(1.02);
        background: rgba(30, 41, 59, 0.9);
        border-color: rgba(6, 182, 212, 0.3);
    }
    
    .dep-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        margin-bottom: 20px;
        box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.4);
    }
    
    .dep-content h3 {
        font-size: 1.3rem;
        color: #f8fafc;
        margin-bottom: 15px;
        font-weight: 700;
        line-height: 1.4;
    }
    
    .dep-content p {
        color: #94a3b8;
        font-size: 1.05rem;
        line-height: 1.7;
    }
    
    @media (max-width: 768px) {
        .dep-timeline::after {
            left: 31px;
        }
        html[dir="rtl"] .dep-timeline::after {
            right: 31px;
            left: auto;
        }
        
        .dep-item {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
        }
        html[dir="rtl"] .dep-item {
            padding-right: 70px;
            padding-left: 25px;
        }
        
        .dep-item:nth-child(even) {
            left: 0;
        }
        html[dir="rtl"] .dep-item:nth-child(even) {
            right: 0;
        }
        
        .dep-item::after, .dep-item:nth-child(even)::after {
            left: 21px;
        }
        html[dir="rtl"] .dep-item::after, html[dir="rtl"] .dep-item:nth-child(even)::after {
            right: 21px;
            left: auto;
        }
    }
</style>

{{-- ═══════════════════ CORE SPECIALIZATIONS ═══════════════════ --}}
<section class="specializations-section">
    <div class="container">
        <div class="spec-header" data-aos="fade-up">
            <h2>{{ __('site.projects_specializations.title') }}</h2>
            <p style="color: var(--text-secondary); max-width: 600px; margin: 0 auto; font-size: 1.1rem;">
                نجمع بين الخبرة الهندسية المتقدمة والتطوير المبتكر لنقدم مشاريع متخصصة بفضل تقنيات الطاقة الذكية.
            </p>
        </div>
        
        <div class="spec-grid">
            @foreach(__('site.projects_specializations.items') as $index => $spec)
            <div class="spec-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="spec-icon">
                    <i class="fa-solid {{ $spec['icon'] }}"></i>
                </div>
                <h3>{{ $spec['title'] }}</h3>
                <ul class="spec-list">
                    @foreach($spec['points'] as $point)
                    <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════ CORPORATE DEPARTMENTS ═══════════════════ --}}
<section class="departments-section">
    <div class="container">
        <div class="dep-header" data-aos="fade-up">
            <h2>{{ __('site.projects_departments.title') }}</h2>
            <p style="color: #94a3b8; max-width: 600px; margin: 0 auto; font-size: 1.1rem;">
                منظومة متكاملة من الحلول الهندسية وإدارة المشاريع عبر أقسامنا المتخصصة لضمان الكفاءة والجودة.
            </p>
        </div>
        
        <div class="dep-timeline">
            @foreach(__('site.projects_departments.items') as $index => $dept)
            <div class="dep-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="dep-content">
                    <div class="dep-icon">
                        <i class="fa-solid {{ $dept['icon'] }}"></i>
                    </div>
                    <h3>{{ $dept['title'] }}</h3>
                    <p>{{ $dept['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════ PROJECTS GALLERY ═══════════════════ --}}
<section class="projects-section">
    <div class="container">
        {{-- Status Filter --}}
        <div class="filter-bar" data-aos="fade-up" style="justify-content: center;">
            <div class="filter-group">
                <a href="{{ route('projects') }}" class="filter-pill {{ !request('status') ? 'active' : '' }}">
                    {{ __('site.common.all') }}
                </a>
                <a href="{{ route('projects', ['status' => 'completed']) }}" class="filter-pill {{ request('status') == 'completed' ? 'active' : '' }}">
                    مكتملة
                </a>
                <a href="{{ route('projects', ['status' => 'commissioning']) }}" class="filter-pill {{ request('status') == 'commissioning' ? 'active' : '' }}">
                    قيد التشغيل
                </a>
                <a href="{{ route('projects', ['status' => 'testing']) }}" class="filter-pill {{ request('status') == 'testing' ? 'active' : '' }}">
                    قيد الاختيار والتقييم
                </a>
            </div>
        </div>

        <div class="projects-grid">
            @forelse($projects as $project)
            <div class="project-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
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
                    <div style="margin-top: 14px;">
                        <a href="{{ route('projects.show', $project->id) }}" class="btn-sm primary" style="display: inline-block; padding: 8px 16px;">
                            {{ __('site.projects.view_project') }} <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            {{-- Default sample showcase --}}
            @for($i = 1; $i <= 6; $i++)
            <div class="project-card" data-aos="fade-up" data-aos-delay="{{ ($i - 1) * 80 }}">
                <div class="project-image">
                    <i class="fa-solid fa-solar-panel"></i>
                </div>
                <div class="project-overlay">
                    <div class="project-meta">
                        <span>{{ ['Residential', 'Commercial', 'Industrial', 'Agricultural', 'Institutional', 'Hybrid'][$i - 1] }}</span>
                        <span>2026</span>
                    </div>
                    <h3>{{ ['مشروع فيلا سكنية 10KW', 'مشروع مجمع تجاري 50KW', 'مشروع مصنع صناعي 200KW', 'مشروع مضخة زراعية 30KW', 'مشروع مستشفى 100KW', 'مشروع مزرعة دواجن 45KW'][$i - 1] }}</h3>
                    <p>واحة إنرجي — PRJ-2026-00{{ $i }}</p>
                </div>
            </div>
            @endfor
            @endforelse
        </div>

        @if($projects->hasPages())
        <div style="margin-top: 48px; display: flex; justify-content: center;">
            {{ $projects->links() }}
        </div>
        @endif
    </div>
</section>

@include('website.partials.footer')

@endsection
