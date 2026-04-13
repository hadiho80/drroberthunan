@extends('layouts.admin', ['title' => 'Homepage'])

@section('content')
    <section class="admin-panel">
        <div class="admin-panel-heading">
            <div>
                <p class="section-badge">Homepage</p>
                <h1>Homepage Content</h1>
            </div>
            <p>Konten yang memang khusus untuk halaman depan, tidak lagi bercampur dengan profile atau contact.</p>
        </div>

        <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data" class="admin-form-grid">
            @csrf
            <label class="span-2">
                <span>Hero title</span>
                <input type="text" name="hero_title" value="{{ old('hero_title', $homepage->hero_title) }}">
            </label>
            <label class="span-2">
                <span>Hero description</span>
                <textarea name="hero_description" rows="4">{{ old('hero_description', $homepage->hero_description) }}</textarea>
            </label>
            <label>
                <span>Label CTA hero</span>
                <input type="text" name="hero_primary_cta_label" value="{{ old('hero_primary_cta_label', $homepage->hero_primary_cta_label) }}">
            </label>
            <label>
                <span>URL CTA hero</span>
                <input type="text" name="hero_primary_cta_url" value="{{ old('hero_primary_cta_url', $homepage->hero_primary_cta_url) }}">
            </label>
            <label class="span-2">
                <span>Hero image</span>
                <input type="file" name="hero_image" accept="image/*">
            </label>

            <label class="span-2">
                <span>Judul intro dokter</span>
                <input type="text" name="doctor_intro_title" value="{{ old('doctor_intro_title', $homepage->doctor_intro_title) }}">
            </label>
            <label class="span-2">
                <span>Body intro dokter</span>
                <textarea name="doctor_intro_body" rows="4">{{ old('doctor_intro_body', $homepage->doctor_intro_body) }}</textarea>
            </label>
            <label>
                <span>Stat intro dokter</span>
                <input type="text" name="doctor_intro_stat" value="{{ old('doctor_intro_stat', $homepage->doctor_intro_stat) }}">
            </label>
            <label>
                <span>Label CTA intro dokter</span>
                <input type="text" name="doctor_intro_cta_label" value="{{ old('doctor_intro_cta_label', $homepage->doctor_intro_cta_label) }}">
            </label>
            <label>
                <span>URL CTA intro dokter</span>
                <input type="text" name="doctor_intro_cta_url" value="{{ old('doctor_intro_cta_url', $homepage->doctor_intro_cta_url) }}">
            </label>
            <label class="span-2">
                <span>Gambar intro dokter</span>
                <input type="file" name="doctor_intro_image" accept="image/*">
            </label>

            <label class="span-2">
                <span>Judul about</span>
                <input type="text" name="about_title" value="{{ old('about_title', $homepage->about_title) }}">
            </label>
            <label class="span-2">
                <span>Body about</span>
                <textarea name="about_body" rows="4">{{ old('about_body', $homepage->about_body) }}</textarea>
            </label>
            <label class="span-2">
                <span>Body about kedua</span>
                <textarea name="about_secondary_body" rows="3">{{ old('about_secondary_body', $homepage->about_secondary_body) }}</textarea>
            </label>
            <label>
                <span>Label CTA about</span>
                <input type="text" name="about_cta_label" value="{{ old('about_cta_label', $homepage->about_cta_label) }}">
            </label>
            <label>
                <span>URL CTA about</span>
                <input type="text" name="about_cta_url" value="{{ old('about_cta_url', $homepage->about_cta_url) }}">
            </label>
            <label class="span-2">
                <span>Gambar about</span>
                <input type="file" name="about_image" accept="image/*">
            </label>

            <label>
                <span>Judul section services</span>
                <input type="text" name="services_title" value="{{ old('services_title', $homepage->services_title) }}">
            </label>
            <label>
                <span>Judul section highlights</span>
                <input type="text" name="highlights_title" value="{{ old('highlights_title', $homepage->highlights_title) }}">
            </label>
            <label>
                <span>Judul section contact</span>
                <input type="text" name="contact_title" value="{{ old('contact_title', $homepage->contact_title) }}">
            </label>
            <label class="span-2">
                <span>Gambar highlight bottom</span>
                <input type="file" name="highlight_bottom_image" accept="image/*">
            </label>
            <label class="span-2">
                <span>Gambar contact section</span>
                <input type="file" name="contact_image" accept="image/*">
            </label>
            <label class="span-2">
                <span>Highlights homepage `Title|URL|ImagePath`, satu baris satu item</span>
                <textarea name="highlights_text" rows="8">{{ old('highlights_text', $highlightsText) }}</textarea>
            </label>

            <div class="span-2 admin-form-actions">
                <button type="submit" class="button-primary">Simpan Homepage</button>
            </div>
        </form>
    </section>
@endsection
