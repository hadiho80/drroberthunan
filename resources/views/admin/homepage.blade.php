@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.admin', ['title' => 'Homepage & SEO'])

@section('content')
    <section class="admin-panel">
        <div class="admin-panel-heading">
            <div>
                <p class="section-badge">Konten Utama</p>
                <h1>Homepage & SEO</h1>
            </div>
            <p>Kelola seluruh konten halaman depan, CTA, kontak, dan metadata pencarian dari satu tempat.</p>
        </div>

        <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data" class="admin-form-grid">
            @csrf

            <label>
                <span>Nama situs</span>
                <input type="text" name="site_name" value="{{ old('site_name', $homepage->site_name) }}">
            </label>
            <label>
                <span>Tagline</span>
                <input type="text" name="site_tagline" value="{{ old('site_tagline', $homepage->site_tagline) }}">
            </label>
            <label>
                <span>Badge hero</span>
                <input type="text" name="hero_badge" value="{{ old('hero_badge', $homepage->hero_badge) }}">
            </label>
            <label>
                <span>Judul hero</span>
                <input type="text" name="hero_title" value="{{ old('hero_title', $homepage->hero_title) }}">
            </label>
            <label>
                <span>Highlight hero</span>
                <input type="text" name="hero_highlight" value="{{ old('hero_highlight', $homepage->hero_highlight) }}">
            </label>
            <label class="span-2">
                <span>Deskripsi hero</span>
                <textarea name="hero_description" rows="5">{{ old('hero_description', $homepage->hero_description) }}</textarea>
            </label>
            <label>
                <span>CTA utama</span>
                <input type="text" name="primary_cta_label" value="{{ old('primary_cta_label', $homepage->primary_cta_label) }}">
            </label>
            <label>
                <span>URL CTA utama</span>
                <input type="text" name="primary_cta_url" value="{{ old('primary_cta_url', $homepage->primary_cta_url) }}">
            </label>
            <label>
                <span>CTA kedua</span>
                <input type="text" name="secondary_cta_label" value="{{ old('secondary_cta_label', $homepage->secondary_cta_label) }}">
            </label>
            <label>
                <span>URL CTA kedua</span>
                <input type="text" name="secondary_cta_url" value="{{ old('secondary_cta_url', $homepage->secondary_cta_url) }}">
            </label>
            <label>
                <span>Label pengalaman</span>
                <input type="text" name="experience_label" value="{{ old('experience_label', $homepage->experience_label) }}">
            </label>
            <label>
                <span>Nilai pengalaman</span>
                <input type="text" name="experience_value" value="{{ old('experience_value', $homepage->experience_value) }}">
            </label>
            <label>
                <span>Label pasien</span>
                <input type="text" name="patients_label" value="{{ old('patients_label', $homepage->patients_label) }}">
            </label>
            <label>
                <span>Nilai pasien</span>
                <input type="text" name="patients_value" value="{{ old('patients_value', $homepage->patients_value) }}">
            </label>
            <label class="span-2">
                <span>Gambar hero</span>
                <input type="file" name="hero_image" accept="image/*">
            </label>

            <label>
                <span>Eyebrow tentang</span>
                <input type="text" name="about_eyebrow" value="{{ old('about_eyebrow', $homepage->about_eyebrow) }}">
            </label>
            <label>
                <span>Judul tentang</span>
                <input type="text" name="about_title" value="{{ old('about_title', $homepage->about_title) }}">
            </label>
            <label class="span-2">
                <span>Deskripsi tentang</span>
                <textarea name="about_description" rows="5">{{ old('about_description', $homepage->about_description) }}</textarea>
            </label>
            <label class="span-2">
                <span>Kutipan</span>
                <textarea name="quote_text" rows="4">{{ old('quote_text', $homepage->quote_text) }}</textarea>
            </label>
            <label>
                <span>Penulis kutipan</span>
                <input type="text" name="quote_author" value="{{ old('quote_author', $homepage->quote_author) }}">
            </label>
            <label>
                <span>Judul profil dokter</span>
                <input type="text" name="doctor_profile_title" value="{{ old('doctor_profile_title', $homepage->doctor_profile_title) }}">
            </label>
            <label class="span-2">
                <span>Intro profil dokter</span>
                <textarea name="doctor_profile_intro" rows="4">{{ old('doctor_profile_intro', $homepage->doctor_profile_intro) }}</textarea>
            </label>
            <label class="span-2">
                <span>Foto profil dokter</span>
                <input type="file" name="doctor_profile_image" accept="image/*">
                @if($homepage->doctor_profile_image)
                    <img class="admin-upload-preview" src="{{ Storage::url($homepage->doctor_profile_image) }}" alt="Preview foto profil dokter">
                @endif
            </label>
            <label>
                <span>Subjudul profil dokter</span>
                <input type="text" name="doctor_profile_subtitle" value="{{ old('doctor_profile_subtitle', $homepage->doctor_profile_subtitle) }}">
            </label>
            <label class="span-2">
                <span>Biografi dokter</span>
                <textarea name="doctor_profile_biography" rows="5">{{ old('doctor_profile_biography', $homepage->doctor_profile_biography) }}</textarea>
            </label>
            <label class="span-2">
                <span>Pengalaman klinis (1 baris = 1 poin)</span>
                <textarea name="doctor_profile_experience" rows="5">{{ old('doctor_profile_experience', $homepage->doctor_profile_experience) }}</textarea>
            </label>
            <label class="span-2">
                <span>Pendidikan (1 baris = 1 poin)</span>
                <textarea name="doctor_profile_education" rows="4">{{ old('doctor_profile_education', $homepage->doctor_profile_education) }}</textarea>
            </label>
            <label class="span-2">
                <span>Training experience (1 baris = 1 poin)</span>
                <textarea name="doctor_profile_training" rows="4">{{ old('doctor_profile_training', $homepage->doctor_profile_training) }}</textarea>
            </label>
            <label>
                <span>Telepon</span>
                <input type="text" name="contact_phone" value="{{ old('contact_phone', $homepage->contact_phone) }}">
            </label>
            <label>
                <span>Email</span>
                <input type="email" name="contact_email" value="{{ old('contact_email', $homepage->contact_email) }}">
            </label>
            <label>
                <span>Alamat</span>
                <input type="text" name="contact_address" value="{{ old('contact_address', $homepage->contact_address) }}">
            </label>
            <label>
                <span>Judul halaman kontak</span>
                <input type="text" name="contact_page_title" value="{{ old('contact_page_title', $homepage->contact_page_title) }}">
            </label>
            <label class="span-2">
                <span>Intro halaman kontak</span>
                <textarea name="contact_page_intro" rows="4">{{ old('contact_page_intro', $homepage->contact_page_intro) }}</textarea>
            </label>
            <label class="span-2">
                <span>Gambar fasilitas/bangunan</span>
                <input type="file" name="facility_image" accept="image/*">
            </label>

            <label>
                <span>SEO title</span>
                <input type="text" name="seo_title" value="{{ old('seo_title', $homepage->seo_title) }}">
            </label>
            <label class="span-2">
                <span>SEO description</span>
                <textarea name="seo_description" rows="4">{{ old('seo_description', $homepage->seo_description) }}</textarea>
            </label>
            <label class="span-2">
                <span>SEO keywords</span>
                <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $homepage->seo_keywords) }}">
            </label>
            <label class="span-2">
                <span>SEO image</span>
                <input type="file" name="seo_image" accept="image/*">
            </label>

            <div class="span-2 admin-form-actions">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
            </div>
        </form>
    </section>
@endsection
