@php $siteSettings = \App\Models\SiteSetting::current(); @endphp
<!-- Footer -->
<footer class="app-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <div class="brand-title">{{ $siteSettings->brand_logo_text }}</div>
            <p>{{ $siteSettings->brand_tagline }}</p>
        </div>
        <div class="footer-links-col">
            <h5 class="footer-heading">Navigation</h5>
            <ul>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
            </ul>
        </div>
        <div class="footer-links-col">
            <h5 class="footer-heading">Services</h5>
            <ul>
                <li><a href="{{ route('services') }}">Grooming</a></li>
                <li><a href="{{ route('shop') }}">Nutrition</a></li>
            </ul>
        </div>
        <div class="footer-links-col">
            <h5 class="footer-heading">Contact</h5>
            <ul>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li>
                    <span class="material-symbols-outlined">mail</span> {{ $siteSettings->contact_email }}
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom container border-t">
        <p>{{ $siteSettings->copyright_notice }}</p>
        <div class="social-icons">
            <span class="material-symbols-outlined">public</span>
            <span class="material-symbols-outlined">mood</span>
            <span class="material-symbols-outlined">favorite</span>
        </div>
    </div>
</footer>
