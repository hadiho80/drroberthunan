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

        <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data" class="admin-form-stack">
            @csrf

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Identitas Situs</h2>
                    <p>Data dasar ini dipakai lintas halaman dan menjadi fondasi informasi global website.</p>
                </div>
                <div class="admin-form-grid">
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
                </div>
            </section>

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Kontak Global</h2>
                    <p>Dipakai untuk kebutuhan umum seperti footer, metadata bisnis, dan shortcut kontak di banyak halaman.</p>
                </div>
                <div class="admin-form-grid">
                    <label>
                        <span>Nomor kontak</span>
                        <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}">
                    </label>
                    <label>
                        <span>Email kontak</span>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $settings->contact_email) }}">
                    </label>
                    <label class="span-2">
                        <span>Alamat kontak</span>
                        <input type="text" name="contact_address" value="{{ old('contact_address', $settings->contact_address) }}">
                    </label>
                    <label>
                        <span>Kota</span>
                        <input type="text" name="contact_city" value="{{ old('contact_city', $settings->contact_city) }}">
                    </label>
                    <label>
                        <span>Provinsi / region</span>
                        <input type="text" name="contact_region" value="{{ old('contact_region', $settings->contact_region) }}">
                    </label>
                    <label>
                        <span>Kode pos</span>
                        <input type="text" name="contact_postal_code" value="{{ old('contact_postal_code', $settings->contact_postal_code) }}">
                    </label>
                    <label>
                        <span>Kode negara</span>
                        <small class="admin-field-help">Contoh: `ID`.</small>
                        <input type="text" name="contact_country" value="{{ old('contact_country', $settings->contact_country) }}">
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
                </div>
            </section>

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>SEO Global</h2>
                    <p>Fallback metadata ini akan dipakai saat halaman tertentu belum memiliki meta sendiri.</p>
                </div>
                <div class="admin-form-grid">
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
                        <span>SEO keywords default</span>
                        <small class="admin-field-help">Pisahkan kata kunci dengan koma jika diperlukan.</small>
                        <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $settings->seo_keywords) }}">
                    </label>
                    @include('admin.partials.image-upload-field', ['name' => 'seo_image', 'label' => 'SEO image default', 'value' => old('seo_image', $settings->seo_image), 'class' => 'span-2', 'fallbackLabel' => 'Belum ada SEO image.', 'help' => 'Dipakai sebagai fallback OG image ketika halaman belum punya image sendiri.'])
                </div>
            </section>

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>SEO & Publish Per Halaman</h2>
                    <p>Atur metadata halaman penting tanpa mengubah route public existing secara mendadak.</p>
                </div>
                <div class="admin-form-grid">
                    <div class="span-2 admin-form-section">
                        <div class="admin-form-section-header">
                            <h2>Homepage</h2>
                            <p>Kontrol status publish dan fallback SEO untuk halaman depan.</p>
                        </div>
                        <div class="admin-form-grid">
                            <label>
                                <span>Slug</span>
                                <input type="text" name="home_slug" value="{{ old('home_slug', $settings->home_slug) }}">
                            </label>
                            <label>
                                <span class="admin-field-label">Status publish</span>
                                <div class="admin-checkbox-field">
                                    <input type="checkbox" name="home_is_published" value="1" @checked(old('home_is_published', $settings->home_is_published ?? true))>
                                    <div class="admin-checkbox-copy">
                                        <strong>Homepage aktif</strong>
                                        <span>Jika dimatikan, route public homepage akan diperlakukan sebagai unpublished.</span>
                                    </div>
                                </div>
                            </label>
                            <label class="span-2">
                                <span>Meta title</span>
                                <input type="text" name="home_seo_title" value="{{ old('home_seo_title', $settings->home_seo_title) }}">
                            </label>
                            <label class="span-2">
                                <span>Meta description</span>
                                <textarea name="home_seo_description" rows="3">{{ old('home_seo_description', $settings->home_seo_description) }}</textarea>
                            </label>
                            <label class="span-2">
                                <span>Meta keywords</span>
                                <input type="text" name="home_seo_keywords" value="{{ old('home_seo_keywords', $settings->home_seo_keywords) }}">
                            </label>
                            @include('admin.partials.image-upload-field', ['name' => 'home_og_image', 'label' => 'OG image homepage', 'value' => old('home_og_image', $settings->home_og_image), 'class' => 'span-2', 'fallbackLabel' => 'Kosong = pakai SEO image global.'])
                        </div>
                    </div>

                    <div class="span-2 admin-form-section">
                        <div class="admin-form-section-header">
                            <h2>Doctor Profile</h2>
                            <p>Metadata untuk halaman profile dokter.</p>
                        </div>
                        <div class="admin-form-grid">
                            <label>
                                <span>Slug</span>
                                <input type="text" name="profile_slug" value="{{ old('profile_slug', $settings->profile_slug) }}">
                            </label>
                            <label>
                                <span class="admin-field-label">Status publish</span>
                                <div class="admin-checkbox-field">
                                    <input type="checkbox" name="profile_is_published" value="1" @checked(old('profile_is_published', $settings->profile_is_published ?? true))>
                                    <div class="admin-checkbox-copy">
                                        <strong>Doctor profile aktif</strong>
                                        <span>Jika dimatikan, halaman profile tidak akan tampil di public.</span>
                                    </div>
                                </div>
                            </label>
                            <label class="span-2">
                                <span>Meta title</span>
                                <input type="text" name="profile_seo_title" value="{{ old('profile_seo_title', $settings->profile_seo_title) }}">
                            </label>
                            <label class="span-2">
                                <span>Meta description</span>
                                <textarea name="profile_seo_description" rows="3">{{ old('profile_seo_description', $settings->profile_seo_description) }}</textarea>
                            </label>
                            <label class="span-2">
                                <span>Meta keywords</span>
                                <input type="text" name="profile_seo_keywords" value="{{ old('profile_seo_keywords', $settings->profile_seo_keywords) }}">
                            </label>
                            @include('admin.partials.image-upload-field', ['name' => 'profile_og_image', 'label' => 'OG image doctor profile', 'value' => old('profile_og_image', $settings->profile_og_image), 'class' => 'span-2', 'fallbackLabel' => 'Kosong = pakai SEO image global.'])
                        </div>
                    </div>

                    <div class="span-2 admin-form-section">
                        <div class="admin-form-section-header">
                            <h2>Services Page</h2>
                            <p>Metadata untuk halaman daftar layanan.</p>
                        </div>
                        <div class="admin-form-grid">
                            <label>
                                <span>Slug</span>
                                <input type="text" name="services_slug" value="{{ old('services_slug', $settings->services_slug) }}">
                            </label>
                            <label>
                                <span class="admin-field-label">Status publish</span>
                                <div class="admin-checkbox-field">
                                    <input type="checkbox" name="services_is_published" value="1" @checked(old('services_is_published', $settings->services_is_published ?? true))>
                                    <div class="admin-checkbox-copy">
                                        <strong>Services page aktif</strong>
                                        <span>Jika dimatikan, daftar layanan tidak akan tampil untuk pengunjung.</span>
                                    </div>
                                </div>
                            </label>
                            <label class="span-2">
                                <span>Meta title</span>
                                <input type="text" name="services_seo_title" value="{{ old('services_seo_title', $settings->services_seo_title) }}">
                            </label>
                            <label class="span-2">
                                <span>Meta description</span>
                                <textarea name="services_seo_description" rows="3">{{ old('services_seo_description', $settings->services_seo_description) }}</textarea>
                            </label>
                            <label class="span-2">
                                <span>Meta keywords</span>
                                <input type="text" name="services_seo_keywords" value="{{ old('services_seo_keywords', $settings->services_seo_keywords) }}">
                            </label>
                            @include('admin.partials.image-upload-field', ['name' => 'services_og_image', 'label' => 'OG image services page', 'value' => old('services_og_image', $settings->services_og_image), 'class' => 'span-2', 'fallbackLabel' => 'Kosong = pakai SEO image global.'])
                        </div>
                    </div>

                    <div class="span-2 admin-form-section">
                        <div class="admin-form-section-header">
                            <h2>Contact Page</h2>
                            <p>Metadata untuk halaman contact utama.</p>
                        </div>
                        <div class="admin-form-grid">
                            <label>
                                <span>Slug</span>
                                <input type="text" name="contact_slug" value="{{ old('contact_slug', $settings->contact_slug) }}">
                            </label>
                            <label>
                                <span class="admin-field-label">Status publish</span>
                                <div class="admin-checkbox-field">
                                    <input type="checkbox" name="contact_is_published" value="1" @checked(old('contact_is_published', $settings->contact_is_published ?? true))>
                                    <div class="admin-checkbox-copy">
                                        <strong>Contact page aktif</strong>
                                        <span>Jika dimatikan, halaman contact tidak akan tampil di public.</span>
                                    </div>
                                </div>
                            </label>
                            <label class="span-2">
                                <span>Meta title</span>
                                <input type="text" name="contact_seo_title" value="{{ old('contact_seo_title', $settings->contact_seo_title) }}">
                            </label>
                            <label class="span-2">
                                <span>Meta description</span>
                                <textarea name="contact_seo_description" rows="3">{{ old('contact_seo_description', $settings->contact_seo_description) }}</textarea>
                            </label>
                            <label class="span-2">
                                <span>Meta keywords</span>
                                <input type="text" name="contact_seo_keywords" value="{{ old('contact_seo_keywords', $settings->contact_seo_keywords) }}">
                            </label>
                            @include('admin.partials.image-upload-field', ['name' => 'contact_og_image', 'label' => 'OG image contact page', 'value' => old('contact_og_image', $settings->contact_og_image), 'class' => 'span-2', 'fallbackLabel' => 'Kosong = pakai SEO image global.'])
                        </div>
                    </div>
                </div>
            </section>

            <div class="admin-form-actions">
                <p>Perubahan site settings bisa memengaruhi banyak halaman, jadi cek kembali link dan metadata sebelum menyimpan.</p>
                <button type="submit" class="button-primary">Simpan Site Settings</button>
            </div>
        </form>
    </section>
@endsection
