@extends('backEnd.layouts.master')

@section('adminContent')
    <link rel="stylesheet" href="{{ asset('backAssets/css/siteContent.css') }}">

    <div class="content-wrap">

        {{-- ============ Brand Assets ============ --}}
        <form id="form-brand" class="site-settings-form" data-section="brand" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <section class="glass-card section-card" id="brand">
                <div class="section-header">
                    <div>
                        <h4 class="section-title">Brand Assets</h4>
                        <p class="section-desc">Update your visual identity and core brand identifiers.</p>
                    </div>
                    <button type="submit" class="btn-dark-c">Update Branding</button>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <div class="mb-4">
                            <label class="field-label">Brand Logo Text</label>
                            <input type="text" name="brand_logo_text" maxlength="100" required
                                class="field-underline fs-4 fw-semibold font-headline"
                                value="{{ $settings->brand_logo_text }}">
                            <div class="invalid-feedback" data-error-for="brand_logo_text"></div>
                        </div>
                        <div>
                            <label class="field-label">Tagline (Sub-brand)</label>
                            <input type="text" name="brand_tagline" maxlength="150"
                                class="field-underline text-on-surface-variant-c"
                                value="{{ $settings->brand_tagline }}">
                            <div class="invalid-feedback" data-error-for="brand_tagline"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="upload-box" style="cursor:pointer;">
                            <input type="file" name="brand_logo" accept=".svg,.png,.jpg,.jpeg,.webp" class="d-none">
                            <span class="material-symbols-outlined">cloud_upload</span>
                            <p class="font-headline fw-bold small mb-1 text-on-surface-variant-c">Replace Logo Symbol</p>
                            <p class="text-outline-c text-uppercase mb-0" style="font-size:10px; letter-spacing:.08em;">
                                SVG or PNG (Max 5MB)</p>
                            <p class="small mt-2 mb-0 file-chosen-name text-secondary-c"></p>
                        </label>
                        <div class="invalid-feedback" data-error-for="brand_logo"></div>
                    </div>
                </div>
            </section>
        </form>

        {{-- ============ Hero Section ============ --}}
        <form id="form-hero" class="site-settings-form" data-section="hero" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <section class="glass-card section-card" id="hero">
                <div class="glow"></div>
                <div class="section-header">
                    <div>
                        <h4 class="section-title">Hero Section</h4>
                        <p class="section-desc">Manage the main spotlight area of your home page.</p>
                    </div>
                    <button type="submit" class="btn-dark-c">Save Hero Settings</button>
                </div>

                <div class="row position-relative" style="z-index:1;">
                    <div class="col-12 col-md-6 mb-4">
                        <label class="field-label">Main Display Headline</label>
                        <textarea name="hero_headline" maxlength="200" required rows="3"
                            class="field-underline font-display fw-bold"
                            style="font-size: clamp(1.5rem, 4vw, 2.25rem); line-height:1.2;">{{ $settings->hero_headline }}</textarea>
                        <div class="invalid-feedback" data-error-for="hero_headline"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="upload-box" style="cursor:pointer;">
                            <input type="file" name="hero_image" accept=".svg,.png,.jpg,.jpeg,.webp" class="d-none">
                            <span class="material-symbols-outlined">cloud_upload</span>
                            <p class="font-headline fw-bold small mb-1 text-on-surface-variant-c">Replace Hero Image</p>
                            <p class="text-outline-c text-uppercase mb-0" style="font-size:10px; letter-spacing:.08em;">
                                SVG or PNG (Max 5MB)</p>
                            <p class="small mt-2 mb-0 file-chosen-name text-secondary-c"></p>
                        </label>
                        <div class="invalid-feedback" data-error-for="hero_image"></div>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="field-label">Supporting Subtext</label>
                        <textarea name="hero_subtext" maxlength="600" rows="3"
                            class="field-underline text-on-surface-variant-c"
                            style="font-size:1.125rem; line-height:1.7;">{{ $settings->hero_subtext }}</textarea>
                        <div class="invalid-feedback" data-error-for="hero_subtext"></div>
                    </div>
                </div>
            </section>
        </form>

        {{-- ============ Company Info ============ --}}
        <form id="form-info" class="site-settings-form" data-section="info">
            @csrf
            @method('PUT')
            <section class="glass-card section-card" id="info">
                <div class="section-header">
                    <div>
                        <h4 class="section-title">Company Info</h4>
                        <p class="section-desc">Location and operational details.</p>
                    </div>
                    <button type="submit" class="btn-dark-c">Update Info</button>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label class="field-label">Legal Entity Name</label>
                        <input type="text" name="legal_entity_name" maxlength="150" required
                            class="field-underline fw-semibold" value="{{ $settings->legal_entity_name }}">
                        <div class="invalid-feedback" data-error-for="legal_entity_name"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="field-label">Primary Studio Location</label>
                        <input type="text" name="studio_location" maxlength="150"
                            class="field-underline fw-semibold" value="{{ $settings->studio_location }}">
                        <div class="invalid-feedback" data-error-for="studio_location"></div>
                    </div>
                    <div class="col-12">
                        <label class="field-label">Map Embed Code</label>
                        <textarea name="map_embed_code" maxlength="2000" rows="2"
                            class="field-underline" placeholder="Paste a Google Maps <iframe> embed only">{{ $settings->map_embed_code }}</textarea>
                        <div class="invalid-feedback" data-error-for="map_embed_code"></div>
                        <p class="small text-outline-c mt-1 mb-0">Only a Google Maps &lt;iframe&gt; embed is accepted — any other HTML is rejected.</p>
                    </div>
                </div>
            </section>
        </form>

        {{-- ============ Services Section ============ --}}
        <form id="form-services" class="site-settings-form" data-section="services">
            @csrf
            @method('PUT')
            <section class="glass-card section-card" id="services">
                <div class="section-header">
                    <div>
                        <h4 class="section-title">Services Section</h4>
                        <p class="section-desc">Curate the offerings displayed to your clients.</p>
                    </div>
                    <button type="submit" class="btn-dark-c">Save Services</button>
                </div>
                <div class="row g-4">
                    <div class="mb-2">
                        <label class="field-label">Headline</label>
                        <textarea name="services_headline" maxlength="200" rows="2"
                            class="field-underline font-display">{{ $settings->services_headline }}</textarea>
                        <div class="invalid-feedback" data-error-for="services_headline"></div>
                    </div>
                    <div class="mb-2">
                        <label class="field-label">Supporting Subtext</label>
                        <textarea name="services_subtext" maxlength="600" rows="3"
                            class="field-underline text-on-surface-variant-c"
                            style="font-size:1rem; line-height:1.7;">{{ $settings->services_subtext }}</textarea>
                        <div class="invalid-feedback" data-error-for="services_subtext"></div>
                    </div>
                    <div class="mb-2">
                        <label class="field-label">Service Section Bullet Points</label>
                        <textarea name="services_bullets" maxlength="1000" rows="3"
                            class="field-underline text-on-surface-variant-c"
                            style="font-size:1rem; line-height:1.7;">{{ $settings->services_bullets }}</textarea>
                        <div class="invalid-feedback" data-error-for="services_bullets"></div>
                    </div>
                </div>
            </section>
        </form>

        {{-- ============ Shop Section ============ --}}
        <form id="form-shop" class="site-settings-form" data-section="shop">
            @csrf
            @method('PUT')
            <section class="glass-card section-card" id="shop">
                <div class="section-header">
                    <div>
                        <h4 class="section-title">Shop Section</h4>
                        <p class="section-desc">Manage your online store and product listings.</p>
                    </div>
                    <button type="submit" class="btn-dark-c">Save Shop Info</button>
                </div>
                <div class="row g-4">
                    <div class="mb-2">
                        <label class="field-label">Headline</label>
                        <textarea name="shop_headline" maxlength="200" rows="2"
                            class="field-underline font-display">{{ $settings->shop_headline }}</textarea>
                        <div class="invalid-feedback" data-error-for="shop_headline"></div>
                    </div>
                    <div class="mb-2">
                        <label class="field-label">Supporting Subtext</label>
                        <textarea name="shop_subtext" maxlength="600" rows="3"
                            class="field-underline text-on-surface-variant-c"
                            style="font-size:1rem; line-height:1.7;">{{ $settings->shop_subtext }}</textarea>
                        <div class="invalid-feedback" data-error-for="shop_subtext"></div>
                    </div>
                    <div class="mb-2">
                        <label class="field-label">Shop Section Bullet Points</label>
                        <textarea name="shop_bullets" maxlength="1000" rows="3"
                            class="field-underline text-on-surface-variant-c"
                            style="font-size:1rem; line-height:1.7;">{{ $settings->shop_bullets }}</textarea>
                        <div class="invalid-feedback" data-error-for="shop_bullets"></div>
                    </div>
                </div>
            </section>
        </form>

        {{-- ============ Contact Information ============ --}}
        <form id="form-contact" class="site-settings-form" data-section="contact">
            @csrf
            @method('PUT')
            <section class="glass-card section-card" id="contact">
                <div class="section-header">
                    <div>
                        <h4 class="section-title">Contact Information</h4>
                        <p class="section-desc">Manage your public contact details and availability.</p>
                    </div>
                    <button type="submit" class="btn-dark-c">Save Contact Info</button>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label class="field-label">Primary Email</label>
                        <input type="email" name="contact_email" maxlength="150" required
                            class="field-underline fw-semibold" value="{{ $settings->contact_email }}">
                        <div class="invalid-feedback" data-error-for="contact_email"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="field-label">Phone Number</label>
                        <input type="tel" name="contact_phone" maxlength="30"
                            class="field-underline fw-semibold" value="{{ $settings->contact_phone }}">
                        <div class="invalid-feedback" data-error-for="contact_phone"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="field-label">Business Hours</label>
                        <input type="text" name="business_hours" maxlength="150"
                            class="field-underline fw-semibold" value="{{ $settings->business_hours }}">
                        <div class="invalid-feedback" data-error-for="business_hours"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="field-label">Copy Right Notice</label>
                        <input type="text" name="copyright_notice" maxlength="150"
                            class="field-underline fw-semibold" value="{{ $settings->copyright_notice }}">
                        <div class="invalid-feedback" data-error-for="copyright_notice"></div>
                    </div>
                </div>
            </section>
        </form>

        {{-- ============ Social Media ============ --}}
        <form id="form-socials" class="site-settings-form" data-section="socials">
            @csrf
            @method('PUT')
            <section class="glass-card section-card" id="socials">
                <div class="section-header">
                    <div>
                        <h4 class="section-title">Social Media</h4>
                        <p class="section-desc">Connect your digital presence across platforms.</p>
                    </div>
                    <button type="submit" class="btn-dark-c">Update Socials</button>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label class="field-label">Instagram URL</label>
                        <input type="url" name="instagram_url" maxlength="255"
                            class="field-underline fw-semibold" value="{{ $settings->instagram_url }}">
                        <div class="invalid-feedback" data-error-for="instagram_url"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="field-label">Facebook URL</label>
                        <input type="url" name="facebook_url" maxlength="255"
                            class="field-underline fw-semibold" value="{{ $settings->facebook_url }}">
                        <div class="invalid-feedback" data-error-for="facebook_url"></div>
                    </div>
                    <div class="col-12">
                        <label class="field-label">Twitter/X URL</label>
                        <input type="url" name="twitter_url" maxlength="255"
                            class="field-underline fw-semibold" value="{{ $settings->twitter_url }}">
                        <div class="invalid-feedback" data-error-for="twitter_url"></div>
                    </div>
                </div>
            </section>
        </form>

    </div>
@endsection

@push('scripts')
<script>
$(function () {
    // Base URL for the section update route, e.g. /admin/site-content/__SECTION__
    const baseUrl = "{{ url('/admin/site-content') }}";

    // Show the chosen filename inside the upload box for quick feedback.
    $('.site-settings-form input[type="file"]').on('change', function () {
        const name = this.files.length ? this.files[0].name : '';
        $(this).closest('.upload-box').find('.file-chosen-name').text(name);
    });

    $('.site-settings-form').on('submit', function (e) {
        e.preventDefault();

        const $form    = $(this);
        const section  = $form.data('section');
        const $button  = $form.find('button[type="submit"]');
        const originalBtnText = $button.text();

        // Clear previous inline errors on this form only.
        $form.find('.invalid-feedback').text('').removeClass('d-block');
        $form.find('.field-underline').removeClass('is-invalid');

        $button.prop('disabled', true).text('Saving...');

        const formData = new FormData(this); // includes CSRF token + _method=PUT + files

        $.ajax({
            url: baseUrl + '/' + section,
            method: 'POST', // Laravel reads _method=PUT from the form data
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                toastr.success(response.message || 'Saved successfully.');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors || {};
                    let firstMessage = null;

                    $.each(errors, function (field, messages) {
                        const $errorBox = $form.find('[data-error-for="' + field + '"]');
                        $errorBox.text(messages[0]).addClass('d-block');
                        $form.find('[name="' + field + '"]').addClass('is-invalid');
                        if (!firstMessage) firstMessage = messages[0];
                    });

                    toastr.error(firstMessage || 'Please check the highlighted fields.');
                } else if (xhr.status === 404) {
                    toastr.error('Settings section not found.');
                } else {
                    toastr.error('Something went wrong. Please try again.');
                }
            },
            complete: function () {
                $button.prop('disabled', false).text(originalBtnText);
            }
        });
    });
});
</script>
@endpush
