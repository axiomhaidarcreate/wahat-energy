@extends('website.layouts.app')

@section('title', __('site.nav.contact') . ' | ' . __('site.site_name'))

@section('content')

@include('website.partials.navbar')

{{-- ═══════════════════ PAGE HERO ═══════════════════ --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <div class="breadcrumb">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('site.common.home') }}</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="current">{{ __('site.nav.contact') }}</span>
            </div>
            <h1>{{ __('site.contact.title') }}</h1>
            <p>{{ __('site.contact.subtitle') }}</p>
        </div>
    </div>
</section>

{{-- ═══════════════════ CONTACT GRID ═══════════════════ --}}
<section class="services-section" style="padding: 80px 0;">
    <div class="container">
        @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); color: var(--green); padding: 16px 24px; border-radius: var(--radius-md); margin-bottom: 32px; text-align: center; font-weight: 600;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif

        <div class="contact-grid">
            {{-- Contact Info Cards --}}
            <div class="contact-info-card" data-aos="fade-up">
                <h3 style="font-size: 1.4rem; color: var(--primary); margin-bottom: 8px;">معلومات التواصل</h3>
                <p style="color: var(--text-secondary); font-size: 0.95rem; margin-bottom: 16px;">يسعدنا تواصلك واستقبال استفساراتك على مدار الساعة.</p>

                <div class="contact-item-block">
                    <div class="contact-item-icon"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary);">أرقام الاتصال</div>
                        <div style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px; direction: ltr;">0509977409 | 0559113515 | 0509920744</div>
                    </div>
                </div>

                <div class="contact-item-block">
                    <div class="contact-item-icon" style="background: rgba(37, 211, 102, 0.1); color: #25d366;"><i class="fa-brands fa-whatsapp"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary);">واتساب</div>
                        <div style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px; direction: ltr;">0509977409 | 0559113515</div>
                    </div>
                </div>

                <div class="contact-item-block">
                    <div class="contact-item-icon" style="background: rgba(6, 182, 212, 0.1); color: var(--accent);"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary);">{{ __('site.contact.btn_email') }}</div>
                        <div style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px;">{{ __('site.contact.email') }}</div>
                    </div>
                </div>

                <div class="contact-item-block">
                    <div class="contact-item-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary);">الموقع</div>
                        <div style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px;">الرياض - العقيق</div>
                    </div>
                </div>

                <div class="contact-item-block">
                    <div class="contact-item-icon"><i class="fa-solid fa-id-card"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary);">رقم العضوية</div>
                        <div style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px;">1314253</div>
                    </div>
                </div>

                <div class="contact-item-block">
                    <div class="contact-item-icon"><i class="fa-solid fa-file-lines"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary);">السجل التجاري</div>
                        <div style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px;">7055105402</div>
                    </div>
                </div>

                <div class="contact-item-block">
                    <div class="contact-item-icon"><i class="fa-solid fa-clock"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary);">{{ __('site.common.working_hours') }}</div>
                        <div style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px;">{{ __('site.common.sat_thu') }}</div>
                    </div>
                </div>
            </div>

            {{-- Contact Form Card --}}
            <div class="contact-form-card" data-aos="fade-up" data-aos-delay="100">
                <h3 style="font-size: 1.4rem; color: var(--text-primary); margin-bottom: 24px;">أرسل لنا رسالة مباشرة</h3>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="form-group">
                            <label>{{ __('site.common.full_name') }} *</label>
                            <input type="text" name="name" required placeholder="محمد أحمد">
                        </div>

                        <div class="form-group">
                            <label>{{ __('site.common.phone_number') }} *</label>
                            <input type="text" name="phone" required placeholder="+967 770 000 000">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="form-group">
                            <label>{{ __('site.common.email_address') }}</label>
                            <input type="email" name="email" placeholder="example@mail.com">
                        </div>

                        <div class="form-group">
                            <label>{{ __('site.common.subject') }}</label>
                            <input type="text" name="subject" value="{{ request('service') ? 'طلب خدمة: ' . request('service') : (request('product') ? 'استفسار عن منتج: ' . request('product') : '') }}" placeholder="عنوان الرسالة">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ __('site.common.message') }} *</label>
                        <textarea name="message" rows="5" required placeholder="اكتب تفاصيل طلبك أو استفسارك هنا..."></textarea>
                    </div>

                    <div style="margin-top: 24px;">
                        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                            <i class="fa-solid fa-paper-plane"></i> {{ __('site.common.send_message') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@include('website.partials.footer')

@endsection
