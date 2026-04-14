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

        <form action="{{ route('admin.doctor-profile.update') }}" method="POST" enctype="multipart/form-data" class="admin-form-grid">
            @csrf
            <label>
                <span>Nama dokter</span>
                <input type="text" name="title" value="{{ old('title', $profile->title) }}">
            </label>
            <label>
                <span>Subtitle</span>
                <input type="text" name="subtitle" value="{{ old('subtitle', $profile->subtitle) }}">
            </label>
            <label class="span-2">
                <span>Intro</span>
                <textarea name="intro" rows="4">{{ old('intro', $profile->intro) }}</textarea>
            </label>
            <label class="span-2">
                <span>Biography</span>
                <textarea name="biography" rows="5">{{ old('biography', $profile->biography) }}</textarea>
            </label>
            <label class="span-2">
                <span>Foto profile</span>
                <input type="file" name="image" accept="image/*">
            </label>
            <label class="span-2">
                <span>Experience intro</span>
                <textarea name="experience_intro" rows="3">{{ old('experience_intro', $sections->get('experience')?->intro) }}</textarea>
            </label>
            <label class="span-2">
                <span>Clinical experience items, satu baris satu item</span>
                <textarea name="experience_items" rows="5">{{ old('experience_items', collect($sections->get('experience')?->items ?? [])->implode("\n")) }}</textarea>
            </label>
            <label class="span-2">
                <span>Education items, satu baris satu item</span>
                <textarea name="education_items" rows="5">{{ old('education_items', collect($sections->get('education')?->items ?? [])->implode("\n")) }}</textarea>
            </label>
            <label class="span-2">
                <span>Training items, satu baris satu item</span>
                <textarea name="training_items" rows="6">{{ old('training_items', collect($sections->get('training')?->items ?? [])->implode("\n")) }}</textarea>
            </label>

            <div class="span-2 admin-form-actions">
                <button type="submit" class="button-primary">Simpan Doctor Profile</button>
            </div>
        </form>
    </section>
@endsection
