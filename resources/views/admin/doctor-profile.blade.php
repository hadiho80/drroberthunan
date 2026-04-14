@php
    $sections = $profile->sections->keyBy('key');
@endphp

@extends('layouts.admin', ['title' => 'Doctor Profile'])

@section('content')
    <section class="admin-panel">
        <div class="admin-panel-heading">
            <div>
                <p class="section-badge">Doctor Profile</p>
                <h1>Doctor Profile Content</h1>
            </div>
            <p>Konten profil dokter dipisahkan dari homepage agar struktur datanya lebih jelas.</p>
        </div>

        <form action="{{ route('admin.doctor-profile.update') }}" method="POST" enctype="multipart/form-data" class="admin-form-stack">
            @csrf
            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Identitas Dokter</h2>
                    <p>Bagian ini mengatur nama, subtitle, intro, dan foto utama yang dipakai di area profile.</p>
                </div>
                <div class="admin-form-grid">
                    <label>
                        <span>Nama dokter</span>
                        <input type="text" name="title" value="{{ old('title', $profile->title) }}">
                    </label>
                    <label>
                        <span>Subtitle</span>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $profile->subtitle) }}">
                    </label>
                    <label class="span-2">
                        <span>Intro singkat</span>
                        <small class="admin-field-help">Gunakan 1-2 paragraf pendek untuk pembuka profile dokter.</small>
                        <textarea name="intro" rows="4">{{ old('intro', $profile->intro) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span>Biography</span>
                        <small class="admin-field-help">Bisa diisi lebih panjang untuk kebutuhan konten atau SEO internal.</small>
                        <textarea name="biography" rows="5">{{ old('biography', $profile->biography) }}</textarea>
                    </label>
                    @include('admin.partials.image-upload-field', ['name' => 'image', 'label' => 'Foto profile', 'value' => old('image', $profile->image), 'class' => 'span-2', 'fallbackLabel' => 'Belum ada foto profile.', 'help' => 'Upload foto portrait yang paling representatif untuk halaman profile.'])
                </div>
            </section>

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Riwayat & Pengalaman</h2>
                    <p>Isi daftar satu baris satu item supaya admin lebih mudah menambah atau menghapus poin.</p>
                </div>
                <div class="admin-form-grid">
                    <label class="span-2">
                        <span>Pengantar clinical experience</span>
                        <small class="admin-field-help">Kalau tidak dibutuhkan, bisa dibiarkan kosong.</small>
                        <textarea name="experience_intro" rows="3">{{ old('experience_intro', $sections->get('experience')?->intro) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span>Clinical experience</span>
                        <small class="admin-field-help">Satu baris mewakili satu pengalaman klinis.</small>
                        <textarea name="experience_items" rows="5">{{ old('experience_items', collect($sections->get('experience')?->items ?? [])->implode("\n")) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span>Education</span>
                        <small class="admin-field-help">Satu baris mewakili satu riwayat pendidikan.</small>
                        <textarea name="education_items" rows="5">{{ old('education_items', collect($sections->get('education')?->items ?? [])->implode("\n")) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span>Training experience</span>
                        <small class="admin-field-help">Satu baris mewakili satu pelatihan atau workshop.</small>
                        <textarea name="training_items" rows="6">{{ old('training_items', collect($sections->get('training')?->items ?? [])->implode("\n")) }}</textarea>
                    </label>
                </div>
            </section>

            <div class="admin-form-actions">
                <p>Simpan setelah semua teks dan foto profile sudah diperiksa kembali.</p>
                <button type="submit" class="button-primary">Simpan Doctor Profile</button>
            </div>
        </form>
    </section>
@endsection
