@extends('layouts.admin', ['title' => 'Site Settings'])

@section('content')
    <section class="admin-panel">
        <div class="admin-panel-heading">
            <div>
                <p class="section-badge">Fondasi CMS</p>
                <h1>Site Settings</h1>
            </div>
            <p>Pengaturan identitas situs, SEO global, dan metadata yang dipakai lintas halaman.</p>
        </div>

        <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data" class="admin-form-grid">
            @csrf
            <label>
                <span>Nama situs</span>
                <input type="text" name="site_name" value="{{ old('site_name', $settings->site_name) }}">
            </label>
            <label>
                <span>Nama dokter</span>
                <input type="text" name="doctor_name" value="{{ old('doctor_name', $settings->doctor_name) }}">
            </label>
            <label>
                <span>Subtitle dokter</span>
                <input type="text" name="doctor_subtitle" value="{{ old('doctor_subtitle', $settings->doctor_subtitle) }}">
            </label>
            <label>
                <span>Nama klinik</span>
                <input type="text" name="clinic_name" value="{{ old('clinic_name', $settings->clinic_name) }}">
            </label>
            <label>
                <span>Departemen klinik</span>
                <input type="text" name="clinic_department" value="{{ old('clinic_department', $settings->clinic_department) }}">
            </label>
            <label>
                <span>Contact phone</span>
                <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}">
            </label>
            <label>
                <span>Contact email</span>
                <input type="email" name="contact_email" value="{{ old('contact_email', $settings->contact_email) }}">
            </label>
            <label class="span-2">
                <span>Contact address</span>
                <input type="text" name="contact_address" value="{{ old('contact_address', $settings->contact_address) }}">
            </label>
            <label>
                <span>Contact city</span>
                <input type="text" name="contact_city" value="{{ old('contact_city', $settings->contact_city) }}">
            </label>
            <label>
                <span>Contact region</span>
                <input type="text" name="contact_region" value="{{ old('contact_region', $settings->contact_region) }}">
            </label>
            <label>
                <span>Postal code</span>
                <input type="text" name="contact_postal_code" value="{{ old('contact_postal_code', $settings->contact_postal_code) }}">
            </label>
            <label>
                <span>Country code</span>
                <input type="text" name="contact_country" value="{{ old('contact_country', $settings->contact_country) }}">
            </label>
            <label>
                <span>Bahasa SEO</span>
                <input type="text" name="seo_lang" value="{{ old('seo_lang', $settings->seo_lang) }}">
            </label>
            <label>
                <span>OG locale</span>
                <input type="text" name="seo_og_locale" value="{{ old('seo_og_locale', $settings->seo_og_locale) }}">
            </label>
            <label class="span-2">
                <span>SEO title default</span>
                <input type="text" name="seo_title_default" value="{{ old('seo_title_default', $settings->seo_title_default) }}">
            </label>
            <label class="span-2">
                <span>SEO description default</span>
                <textarea name="seo_description_default" rows="4">{{ old('seo_description_default', $settings->seo_description_default) }}</textarea>
            </label>
            <label class="span-2">
                <span>SEO keywords</span>
                <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $settings->seo_keywords) }}">
            </label>
            <label class="span-2">
                <span>SEO image</span>
                <input type="file" name="seo_image" accept="image/*">
            </label>
            <label class="span-2">
                <span>WhatsApp link</span>
                <input type="url" name="whatsapp_link" value="{{ old('whatsapp_link', $settings->whatsapp_link) }}">
            </label>
            <label class="span-2">
                <span>Insurance link</span>
                <input type="url" name="insurance_link" value="{{ old('insurance_link', $settings->insurance_link) }}">
            </label>
            <label class="span-2">
                <span>Google Maps link</span>
                <input type="url" name="google_maps_link" value="{{ old('google_maps_link', $settings->google_maps_link) }}">
            </label>
            <label>
                <span>Instagram link</span>
                <input type="url" name="instagram_link" value="{{ old('instagram_link', $settings->instagram_link) }}">
            </label>
            <label>
                <span>Facebook link</span>
                <input type="url" name="facebook_link" value="{{ old('facebook_link', $settings->facebook_link) }}">
            </label>

            <div class="span-2 admin-form-actions">
                <button type="submit" class="button-primary">Simpan Site Settings</button>
            </div>
        </form>
    </section>
@endsection
