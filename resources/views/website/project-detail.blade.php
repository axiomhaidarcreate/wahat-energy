@extends('website.layouts.app')

@section('title', $project->name . ' | ' . __('site.site_name'))
@section('meta_description', Str::limit(strip_tags($project->content ?? __('site.hero.subtitle')), 150))
@section('meta_keywords', $project->name . ', مشاريع طاقة متجددة, طاقة شمسية في السعودية, تركيب ألواح شمسية')
@if($project->image_path)
    @section('meta_image', asset('storage/' . $project->image_path))
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
                <a href="{{ route('projects') }}">{{ __('site.nav.projects') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="current">{{ $project->name }}</span>
            </div>
            <h1>{{ $project->name }}</h1>
            <p>{{ $project->project_code }} — {{ ucfirst(str_replace('_', ' ', $project->status)) }}</p>
        </div>
    </div>
</section>

{{-- ═══════════════════ PROJECT DETAIL LAYOUT ═══════════════════ --}}
<section class="projects-section" style="padding: 80px 0;">
    <div class="container">
        <div class="detail-layout">
            <div class="detail-image-box" data-aos="fade-up" style="{{ $project->image_path ? 'background-image: url(' . asset('storage/' . $project->image_path) . '); background-size: cover; background-position: center; min-height: 400px; position: relative;' : '' }}">
                @if(!$project->image_path)
                <div style="text-align: center;">
                    <i class="fa-solid fa-diagram-project" style="font-size: 7rem; color: var(--primary); opacity: 0.8; margin-bottom: 20px;"></i>
                    <h3 style="font-size: 1.5rem; color: var(--text-primary);">{{ $project->name }}</h3>
                    <p style="color: var(--accent); margin-top: 6px;">{{ $project->customer->name ?? 'العميل' }}</p>
                </div>
                @else
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 40px 20px 20px;">
                    <h3 style="font-size: 1.8rem; color: white; margin-bottom: 8px;">{{ $project->name }}</h3>
                    <p style="color: rgba(255,255,255,0.9);">{{ $project->customer->name ?? 'العميل' }}</p>
                </div>
                @endif
            </div>

            <div class="detail-card" data-aos="fade-up" data-aos-delay="100">
                <h3 style="font-size: 1.4rem; color: var(--primary); margin-bottom: 20px;">تفاصيل وتنفيذ المشروع</h3>
                <div class="prose" style="font-size: 1.05rem; line-height: 1.8; color: var(--text-secondary); margin-bottom: 28px;">
                    @if($project->content)
                        {!! $project->content !!}
                    @else
                        <p>تم تنفيذ مشروع {{ $project->name }} بوساطة الكادر الهندسي لشركة واحة إنرجي بأفضل المعايير الفنية والجودة الشاملة لضمان كفاءة التوليد وتحقيق أقصى توفير للطاقة.</p>
                    @endif
                </div>

                <table class="spec-table" style="margin-bottom: 32px;">
                    <tr>
                        <td class="spec-name">كود المشروع</td>
                        <td class="spec-value">{{ $project->project_code }}</td>
                    </tr>
                    <tr>
                        <td class="spec-name">حالة المشروع</td>
                        <td class="spec-value" style="color: var(--green);">{{ ucfirst(str_replace('_', ' ', $project->status)) }}</td>
                    </tr>
                    @if($project->start_date)
                    <tr>
                        <td class="spec-name">تاريخ البدء</td>
                        <td class="spec-value">{{ $project->start_date->format('Y-m-d') }}</td>
                    </tr>
                    @endif
                    @if($project->end_date)
                    <tr>
                        <td class="spec-name">تاريخ الانتهاء</td>
                        <td class="spec-value">{{ $project->end_date->format('Y-m-d') }}</td>
                    </tr>
                    @endif
                </table>

                <div style="display: flex; gap: 16px;">
                    <a href="{{ route('contact') }}?project={{ urlencode($project->name) }}" class="btn-primary">
                        <i class="fa-solid fa-paper-plane"></i> طلب مشروع مماثل
                    </a>
                    <a href="{{ route('projects') }}" class="btn-outline">
                        <i class="fa-solid fa-arrow-right"></i> {{ __('site.common.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('website.partials.footer')

@endsection
