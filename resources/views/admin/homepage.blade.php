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

        <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data" class="admin-form-stack">
            @csrf

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Hero Section</h2>
                    <p>Kontrol judul, deskripsi, CTA, dan gambar utama homepage.</p>
                </div>
                <div class="admin-form-grid">
                    <label class="span-2">
                        <span>Judul hero</span>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $homepage->hero_title) }}">
                    </label>
                    <label class="span-2">
                        <span>Deskripsi hero</span>
                        <textarea name="hero_description" rows="4">{{ old('hero_description', $homepage->hero_description) }}</textarea>
                    </label>
                    <label>
                        <span>Label tombol hero</span>
                        <input type="text" name="hero_primary_cta_label" value="{{ old('hero_primary_cta_label', $homepage->hero_primary_cta_label) }}">
                    </label>
                    <label>
                        <span>URL tombol hero</span>
                        <small class="admin-field-help">Boleh isi path internal seperti `/contact` atau URL penuh.</small>
                        <input type="text" name="hero_primary_cta_url" value="{{ old('hero_primary_cta_url', $homepage->hero_primary_cta_url) }}">
                    </label>
                    @include('admin.partials.image-upload-field', ['name' => 'hero_image', 'label' => 'Gambar hero', 'value' => old('hero_image', $homepage->hero_image), 'class' => 'span-2', 'fallbackLabel' => 'Belum ada gambar hero.', 'help' => 'Preview akan tampil otomatis jika gambar sudah tersimpan.'])
                </div>
            </section>

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Intro Dokter & About</h2>
                    <p>Dua blok ini biasanya dibaca berurutan di homepage, jadi saya kelompokkan supaya editor lebih mudah mengecek alurnya.</p>
                </div>
                <div class="admin-form-grid">
                    <label class="span-2">
                        <span>Judul intro dokter</span>
                        <input type="text" name="doctor_intro_title" value="{{ old('doctor_intro_title', $homepage->doctor_intro_title) }}">
                    </label>
                    <label class="span-2">
                        <span>Isi intro dokter</span>
                        <textarea name="doctor_intro_body" rows="4">{{ old('doctor_intro_body', $homepage->doctor_intro_body) }}</textarea>
                    </label>
                    <label>
                        <span>Stat intro dokter</span>
                        <small class="admin-field-help">Contoh: jumlah tahun pengalaman atau fokus layanan.</small>
                        <input type="text" name="doctor_intro_stat" value="{{ old('doctor_intro_stat', $homepage->doctor_intro_stat) }}">
                    </label>
                    <label>
                        <span>Label CTA intro dokter</span>
                        <input type="text" name="doctor_intro_cta_label" value="{{ old('doctor_intro_cta_label', $homepage->doctor_intro_cta_label) }}">
                    </label>
                    <label class="span-2">
                        <span>URL CTA intro dokter</span>
                        <input type="text" name="doctor_intro_cta_url" value="{{ old('doctor_intro_cta_url', $homepage->doctor_intro_cta_url) }}">
                    </label>
                    @include('admin.partials.image-upload-field', ['name' => 'doctor_intro_image', 'label' => 'Gambar intro dokter', 'value' => old('doctor_intro_image', $homepage->doctor_intro_image), 'class' => 'span-2', 'fallbackLabel' => 'Belum ada gambar intro dokter.'])
                    <label class="span-2">
                        <span>Judul about NH Scope</span>
                        <input type="text" name="about_title" value="{{ old('about_title', $homepage->about_title) }}">
                    </label>
                    <label class="span-2">
                        <span>Body about utama</span>
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
                    @include('admin.partials.image-upload-field', ['name' => 'about_image', 'label' => 'Gambar about', 'value' => old('about_image', $homepage->about_image), 'class' => 'span-2', 'fallbackLabel' => 'Belum ada gambar about.'])
                </div>
            </section>

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Services & Highlights</h2>
                    <p>Atur judul section, pilih kartu layanan yang muncul di homepage, lalu kelola highlight di bawahnya.</p>
                </div>
                <div class="admin-form-grid">
                    <label>
                        <span>Judul section services</span>
                        <input type="text" name="services_title" value="{{ old('services_title', $homepage->services_title) }}">
                    </label>
                    <label>
                        <span>Judul section highlights</span>
                        <input type="text" name="highlights_title" value="{{ old('highlights_title', $homepage->highlights_title) }}">
                    </label>
                    <div class="span-2">
                        <span class="admin-field-label">Kartu service homepage</span>
                        <p class="admin-field-help">Centang layanan yang ingin ditampilkan lalu atur urutannya. Angka lebih kecil akan tampil lebih dulu.</p>
                        <div class="admin-service-card-picker">
                            @php
                                $selectedCards = $homepage->serviceCards->keyBy('service_id');
                            @endphp
                            @foreach($services as $service)
                                @php
                                    $selectedCard = $selectedCards->get($service->id);
                                @endphp
                                <label class="admin-service-card-option">
                                    <input type="checkbox" name="service_cards[{{ $service->id }}][enabled]" value="1" @checked(old("service_cards.{$service->id}.enabled", (bool) $selectedCard))>
                                    <span class="admin-service-card-option-title">{{ $service->title }}</span>
                                    <input type="number" name="service_cards[{{ $service->id }}][sort_order]" value="{{ old("service_cards.{$service->id}.sort_order", $selectedCard->sort_order ?? ($service->sort_order ?? 0)) }}" placeholder="Urutan" class="admin-service-card-option-order">
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @include('admin.partials.image-upload-field', ['name' => 'highlight_bottom_image', 'label' => 'Video highlight bottom', 'value' => old('highlight_bottom_image', $homepage->highlight_bottom_image), 'class' => 'span-2', 'accept' => 'video/mp4,video/quicktime,video/webm,video/x-m4v,.mp4,.mov,.webm,.m4v', 'fallbackLabel' => 'Belum ada video highlight bottom.', 'help' => 'Upload video landscape. Video tidak autoplay dan baru diputar saat pengunjung klik play agar tetap ringan.'])
                    <label class="span-2">
                        <span>Data highlights</span>
                        <small class="admin-field-help">Gunakan format `Title|URL|ImagePath`, satu baris satu item.</small>
                        <textarea name="highlights_text" rows="8">{{ old('highlights_text', $highlightsText) }}</textarea>
                    </label>
                </div>
            </section>

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Contact Section Homepage</h2>
                    <p>Bagian ini khusus untuk section contact di homepage, bukan halaman contact utama.</p>
                </div>
                <div class="admin-form-grid">
                    <label>
                        <span>Judul section contact</span>
                        <input type="text" name="contact_title" value="{{ old('contact_title', $homepage->contact_title) }}">
                    </label>
                    <label>
                        <span>Pesan sukses form</span>
                        <input type="text" name="contact_success_message" value="{{ old('contact_success_message', $homepage->contact_success_message) }}">
                    </label>
                    <label>
                        <span>Label tombol form</span>
                        <input type="text" name="contact_button_label" value="{{ old('contact_button_label', $homepage->contact_button_label) }}">
                    </label>
                    <label>
                        <span>Placeholder nama</span>
                        <input type="text" name="contact_name_placeholder" value="{{ old('contact_name_placeholder', $homepage->contact_name_placeholder) }}">
                    </label>
                    <label>
                        <span>Placeholder telepon</span>
                        <input type="text" name="contact_phone_placeholder" value="{{ old('contact_phone_placeholder', $homepage->contact_phone_placeholder) }}">
                    </label>
                    <label>
                        <span>Placeholder email</span>
                        <input type="text" name="contact_email_placeholder" value="{{ old('contact_email_placeholder', $homepage->contact_email_placeholder) }}">
                    </label>
                    <label class="span-2">
                        <span>Placeholder pesan</span>
                        <input type="text" name="contact_message_placeholder" value="{{ old('contact_message_placeholder', $homepage->contact_message_placeholder) }}">
                    </label>
                    @include('admin.partials.image-upload-field', ['name' => 'contact_image', 'label' => 'Gambar contact section', 'value' => old('contact_image', $homepage->contact_image), 'class' => 'span-2', 'fallbackLabel' => 'Belum ada gambar contact section.'])
                </div>
            </section>

            <div class="admin-form-actions">
                <p>Simpan setelah seluruh section homepage selesai dicek dari atas ke bawah.</p>
                <button type="submit" class="button-primary">Simpan Homepage</button>
            </div>
        </form>
    </section>
@endsection
