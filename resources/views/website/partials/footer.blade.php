{{-- ═══════════════════ FOOTER PARTIAL ═══════════════════ --}}
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            {{-- About --}}
            <div class="footer-col">
                <h4>
                    <span style="color: var(--primary);"><i class="fa-solid fa-sun"></i></span>
                    {{ __('site.footer.about_title') }}
                </h4>
                <p>{{ __('site.footer.about_text') }}</p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="footer-col">
                <h4>{{ __('site.footer.links_title') }}</h4>
                <div class="footer-links">
                    <a href="{{ route('home') }}">{{ __('site.nav.home') }}</a>
                    <a href="{{ route('about') }}">{{ __('site.nav.about') }}</a>
                    <a href="{{ route('services') }}">{{ __('site.nav.services') }}</a>
                    <a href="{{ route('products') }}">{{ __('site.nav.products') }}</a>
                    <a href="{{ route('projects') }}">{{ __('site.nav.projects') }}</a>
                    <a href="{{ route('calculator') }}">{{ __('site.nav.calculator') }}</a>
                    <a href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a>
                </div>
            </div>

            {{-- Services --}}
            <div class="footer-col">
                <h4>{{ __('site.footer.services_title') }}</h4>
                <div class="footer-links">
                    @foreach(array_slice(__('site.services.items'), 0, 5) as $i => $service)
                    <a href="{{ route('services.show', $i) }}">{{ $service['title'] }}</a>
                    @endforeach
                </div>
            </div>

            {{-- Contact --}}
            <div class="footer-col">
                <h4>{{ __('site.footer.contact_title') }}</h4>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-phone"></i>
                    <span style="direction: ltr;">0509977409 | 0559113515 | 0509920744</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span>{{ __('site.contact.email') }}</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>الرياض - العقيق</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-id-card"></i>
                    <span>رقم العضوية: 1314253</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>س.ت: 7055105402</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ __('site.footer.company') }}. {{ __('site.footer.rights') }}.</p>
        </div>
    </div>
</footer>
