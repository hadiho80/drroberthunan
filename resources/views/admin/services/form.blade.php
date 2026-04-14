@extends('layouts.admin', ['title' => $service->exists ? 'Edit Layanan' : 'Tambah Layanan'])

@section('content')
    <section class="admin-panel">
        <div class="admin-panel-heading">
            <div>
                <p class="section-badge">CMS Layanan</p>
                <h1>{{ $service->exists ? 'Edit Layanan' : 'Tambah Layanan' }}</h1>
            </div>
            <a href="{{ route('admin.services.index') }}" class="button-secondary">Kembali</a>
        </div>

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="admin-form-stack">
            @csrf
            @if($method !== 'POST')
                @method($method)
            @endif

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Informasi Dasar</h2>
                    <p>Bagian ini menentukan identitas layanan, urutan tampil, dan status publish di website.</p>
                </div>
                <div class="admin-form-grid">
                    <label>
                        <span>Judul layanan</span>
                        <input type="text" name="title" value="{{ old('title', $service->title) }}">
                    </label>
                    <label>
                        <span>Slug</span>
                        <small class="admin-field-help">Gunakan huruf kecil dan tanda hubung. URL public service akan memakai nilai ini.</small>
                        <input type="text" name="slug" value="{{ old('slug', $service->slug) }}">
                    </label>
                    <label class="span-2">
                        <span>Ringkasan layanan</span>
                        <small class="admin-field-help">Dipakai untuk kartu service dan daftar layanan.</small>
                        <textarea name="card_description" rows="3">{{ old('card_description', $service->card_description) }}</textarea>
                    </label>
                    <label>
                        <span>Eyebrow</span>
                        <input type="text" name="eyebrow" value="{{ old('eyebrow', $service->eyebrow) }}">
                    </label>
                    <label>
                        <span>Custom layout</span>
                        <small class="admin-field-help">Biarkan seperti data existing jika layout halaman ini memang sudah khusus.</small>
                        <input type="text" name="custom_layout" value="{{ old('custom_layout', $service->custom_layout) }}">
                    </label>
                    <label>
                        <span>Urutan tampil</span>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}">
                    </label>
                    <label>
                        <span>Hero suffix</span>
                        <input type="text" name="hero_suffix" value="{{ old('hero_suffix', $service->hero_suffix) }}">
                    </label>
                    <label class="span-2">
                        <span>Intro</span>
                        <textarea name="intro" rows="4">{{ old('intro', $service->intro) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span class="admin-field-label">Status publish</span>
                        <div class="admin-checkbox-field">
                            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $service->is_published ?? true))>
                            <div class="admin-checkbox-copy">
                                <strong>Tampilkan layanan di website public</strong>
                                <span>Jika dimatikan, halaman detail service tidak akan tampil untuk pengunjung.</span>
                            </div>
                        </div>
                    </label>
                    <label class="span-2">
                        <span class="admin-field-label">Tampilkan di homepage</span>
                        <div class="admin-checkbox-field">
                            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $service->is_featured))>
                            <div class="admin-checkbox-copy">
                                <strong>Masukkan ke daftar service pilihan</strong>
                                <span>Gunakan bersama pengaturan urutan di CMS homepage jika layanan ini ingin muncul di halaman depan.</span>
                            </div>
                        </div>
                    </label>
                </div>
            </section>

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Konten Detail Service</h2>
                    <p>Kontrol teks utama, overview, dan blok konten pendukung untuk halaman detail layanan.</p>
                </div>
                <div class="admin-form-grid">
                    <label class="span-2">
                        <span>Hero body</span>
                        <textarea name="hero_body" rows="4">{{ old('hero_body', $service->hero_body) }}</textarea>
                    </label>
                    <label>
                        <span>Overview title</span>
                        <input type="text" name="overview_title" value="{{ old('overview_title', $service->overview_title) }}">
                    </label>
                    <label class="span-2">
                        <span>Overview items</span>
                        <small class="admin-field-help">Satu baris mewakili satu bullet overview.</small>
                        <textarea name="overview_items_text" rows="6">{{ old('overview_items_text', collect($service->overview_items ?? [])->implode("\n")) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span>Feature copy</span>
                        <small class="admin-field-help">Satu baris mewakili satu paragraf pendek.</small>
                        <textarea name="feature_copy_text" rows="5">{{ old('feature_copy_text', collect($service->feature_copy ?? [])->implode("\n")) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span>Feature images path / URL</span>
                        <small class="admin-field-help">Satu baris satu gambar. Gunakan jika layout existing memang membaca banyak gambar.</small>
                        <textarea name="feature_images_text" rows="4">{{ old('feature_images_text', collect($service->feature_images ?? [])->implode("\n")) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span>Gallery images path / URL</span>
                        <small class="admin-field-help">Satu baris satu gambar gallery.</small>
                        <textarea name="gallery_images_text" rows="4">{{ old('gallery_images_text', collect($service->gallery_images ?? [])->implode("\n")) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span class="admin-field-label">Tampilkan intro di halaman detail</span>
                        <div class="admin-checkbox-field">
                            <input type="checkbox" name="show_intro" value="1" @checked(old('show_intro', $service->show_intro))>
                            <div class="admin-checkbox-copy">
                                <strong>Aktifkan blok intro</strong>
                                <span>Matikan hanya jika layout service ini memang tidak membutuhkan intro terpisah.</span>
                            </div>
                        </div>
                    </label>
                    <label class="span-2">
                        <span class="admin-field-label">Overview dua kolom</span>
                        <div class="admin-checkbox-field">
                            <input type="checkbox" name="overview_split_columns" value="1" @checked(old('overview_split_columns', $service->overview_split_columns))>
                            <div class="admin-checkbox-copy">
                                <strong>Bagi overview menjadi dua kolom</strong>
                                <span>Pertahankan sesuai layout existing agar tampilan public tidak bergeser.</span>
                            </div>
                        </div>
                    </label>
                    <label class="span-2">
                        <span>Sections JSON terstruktur</span>
                        <small class="admin-field-help">Gunakan field seperti `title`, `copy`, `list_items`, `copy_blocks`, `split_columns`, dan `sort_order`.</small>
                        <textarea name="sections_json" rows="16">{{ old('sections_json', $service->sections_json ?? '[]') }}</textarea>
                    </label>
                </div>
            </section>

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Media & SEO</h2>
                    <p>Upload gambar dengan aman dan isi metadata SEO jika memang dibutuhkan untuk halaman ini.</p>
                </div>
                <div class="admin-form-grid">
                    <label class="span-2">
                        <span>SEO title</span>
                        <input type="text" name="seo_title" value="{{ old('seo_title', $service->seo_title) }}">
                    </label>
                    <label class="span-2">
                        <span>SEO description</span>
                        <textarea name="seo_description" rows="3">{{ old('seo_description', $service->seo_description) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span>SEO keywords</span>
                        <small class="admin-field-help">Pisahkan kata kunci dengan koma jika memang diperlukan.</small>
                        <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $service->seo_keywords) }}">
                    </label>
                    @include('admin.partials.image-upload-field', ['name' => 'og_image', 'label' => 'OG image', 'value' => old('og_image', $service->og_image), 'class' => 'span-2', 'fallbackLabel' => 'Kosong = pakai hero image sebagai fallback.', 'help' => 'Gunakan gambar khusus sharing jika ingin berbeda dari hero image.'])
                    @include('admin.partials.image-upload-field', ['name' => 'card_icon', 'label' => 'Card icon', 'value' => old('card_icon', $service->card_icon), 'fallbackLabel' => 'Belum ada card icon.'])
                    @include('admin.partials.image-upload-field', ['name' => 'card_image', 'label' => 'Card image', 'value' => old('card_image', $service->card_image), 'fallbackLabel' => 'Belum ada card image.'])
                    @include('admin.partials.image-upload-field', ['name' => 'hero_image', 'label' => 'Hero image', 'value' => old('hero_image', $service->hero_image), 'fallbackLabel' => 'Belum ada hero image.'])
                    @include('admin.partials.image-upload-field', ['name' => 'highlight_image', 'label' => 'Highlight image', 'value' => old('highlight_image', $service->highlight_image), 'fallbackLabel' => 'Belum ada highlight image.'])
                    @include('admin.partials.image-upload-field', ['name' => 'feature_image', 'label' => 'Feature image tunggal', 'value' => old('feature_image', $service->feature_image), 'class' => 'span-2', 'fallbackLabel' => 'Belum ada feature image.'])
                </div>
            </section>

            <div class="admin-form-actions">
                <p>{{ $service->exists ? 'Perubahan layanan akan langsung memengaruhi konten CMS setelah disimpan.' : 'Isi data dasar dulu, lalu lengkapi konten detail dan media.' }}</p>
                <button type="submit" class="button-primary">Simpan Layanan</button>
            </div>
        </form>
    </section>
@endsection
