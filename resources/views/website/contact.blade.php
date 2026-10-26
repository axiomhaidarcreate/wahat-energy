@extends('website.layouts.app')

@section('title', 'تواصل معنا | طلب عرض سعر واستشارة طاقة شمسية في السعودية | واحة إنرجي')
@section('meta_description', 'تواصل مع شركة واحة إنرجي في الرياض للحصول على استشارة مجانية وعروض أسعار لتركيب أنظمة الطاقة الشمسية للمنازل والمصانع والمزارع في كافة مناطق السعودية.')
@section('meta_keywords', 'عروض أسعار الطاقة الشمسية, شركة طاقة شمسية في السعودية, مقاول طاقة شمسية, أسعار أنظمة الطاقة الشمسية في السعودية, Solar Energy Company Riyadh, Solar Energy Company in Saudi Arabia')

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
                        <div style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px; direction: ltr;">
                            <a href="tel:0509977409" style="color: inherit; text-decoration: none;">0509977409</a> | 
                            <a href="tel:0559113515" style="color: inherit; text-decoration: none;">0559113515</a>
                        </div>
                    </div>
                </div>

                <div class="contact-item-block">
                    <div class="contact-item-icon" style="background: rgba(37, 211, 102, 0.1); color: #25d366;"><i class="fa-brands fa-whatsapp"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary);">واتساب</div>
                        <div style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px; direction: ltr;">
                            <a href="https://wa.me/966509977409" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none;">0509977409</a> | 
                            <a href="https://wa.me/966559113515" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none;">0559113515</a>
                        </div>
                    </div>
                </div>

                <div class="contact-item-block">
                    <div class="contact-item-icon" style="background: rgba(6, 182, 212, 0.1); color: var(--accent);"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary);">{{ __('site.contact.email_title') ?? 'البريد الإلكتروني' }}</div>
                        <div style="display: flex; flex-direction: column; gap: 6px; margin-top: 6px; direction: ltr; text-align: right;">
                            <a href="mailto:info@wahat-energy.com.sa" class="contact-email-link" style="color: var(--text-secondary); text-decoration: none; font-size: 0.92rem; display: inline-flex; align-items: center; gap: 8px;">
                                <i class="fa-regular fa-envelope" style="font-size: 0.85rem; color: var(--accent);"></i>
                                <span>info@wahat-energy.com.sa</span>
                            </a>
                            <a href="mailto:eng-alaa@wahat-energy.com.sa" class="contact-email-link" style="color: var(--text-secondary); text-decoration: none; font-size: 0.92rem; display: inline-flex; align-items: center; gap: 8px;">
                                <i class="fa-regular fa-envelope" style="font-size: 0.85rem; color: var(--accent);"></i>
                                <span>eng-alaa@wahat-energy.com.sa</span>
                            </a>
                        </div>
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
                    <div class="contact-item-icon"><i class="fa-solid fa-clock"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary);">{{ __('site.common.working_hours') }}</div>
                        <div style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px;">{{ __('site.common.sat_thu') }}</div>
                    </div>
                </div>

                {{-- Social Media Icons --}}
                <div class="contact-item-block" style="padding-top: 14px; border-top: 1px solid var(--border-light); margin-top: 4px;">
                    <div class="contact-item-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--primary);"><i class="fa-solid fa-share-nodes"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--text-primary); margin-bottom: 10px;">{{ __('site.contact.social_media') ?? 'تابعنا على مواقع التواصل' }}</div>
                        <div class="contact-social-icons">
                            <a href="https://www.tiktok.com/@wahatenergy" target="_blank" rel="noopener noreferrer" class="contact-social-btn tiktok" aria-label="TikTok" title="TikTok (@wahatenergy)">
                                <i class="fa-brands fa-tiktok"></i>
                            </a>
                            <a href="https://www.instagram.com/wahatenergy" target="_blank" rel="noopener noreferrer" class="contact-social-btn instagram" aria-label="Instagram" title="Instagram (@wahatenergy)">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
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
