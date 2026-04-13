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

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="admin-form-grid">
            @csrf
            @if($method !== 'POST')
                @method($method)
            @endif

            <label>
                <span>Judul layanan</span>
                <input type="text" name="title" value="{{ old('title', $service->title) }}">
            </label>
            <label>
                <span>Slug</span>
                <input type="text" name="slug" value="{{ old('slug', $service->slug) }}">
            </label>
            <label>
                <span>Eyebrow</span>
                <input type="text" name="eyebrow" value="{{ old('eyebrow', $service->eyebrow) }}">
            </label>
            <label>
                <span>Custom layout</span>
                <input type="text" name="custom_layout" value="{{ old('custom_layout', $service->custom_layout) }}">
            </label>
            <label class="span-2">
                <span>Intro</span>
                <textarea name="intro" rows="4">{{ old('intro', $service->intro) }}</textarea>
            </label>
            <label class="span-2">
                <span>Deskripsi kartu layanan</span>
                <textarea name="card_description" rows="3">{{ old('card_description', $service->card_description) }}</textarea>
            </label>
            <label>
                <span>Hero suffix</span>
                <input type="text" name="hero_suffix" value="{{ old('hero_suffix', $service->hero_suffix) }}">
            </label>
            <label>
                <span>Sort order</span>
                <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}">
            </label>
            <label class="span-2">
                <span>Hero body</span>
                <textarea name="hero_body" rows="4">{{ old('hero_body', $service->hero_body) }}</textarea>
            </label>
            <label>
                <span>Overview title</span>
                <input type="text" name="overview_title" value="{{ old('overview_title', $service->overview_title) }}">
            </label>
            <label class="span-2">
                <span>Overview items, satu baris satu item</span>
                <textarea name="overview_items_text" rows="6">{{ old('overview_items_text', collect($service->overview_items ?? [])->implode("\n")) }}</textarea>
            </label>
            <label class="span-2">
                <span>Feature copy, satu baris satu paragraf</span>
                <textarea name="feature_copy_text" rows="5">{{ old('feature_copy_text', collect($service->feature_copy ?? [])->implode("\n")) }}</textarea>
            </label>
            <label class="span-2">
                <span>Feature images path/url, satu baris satu item</span>
                <textarea name="feature_images_text" rows="4">{{ old('feature_images_text', collect($service->feature_images ?? [])->implode("\n")) }}</textarea>
            </label>
            <label class="span-2">
                <span>Gallery images path/url, satu baris satu item</span>
                <textarea name="gallery_images_text" rows="4">{{ old('gallery_images_text', collect($service->gallery_images ?? [])->implode("\n")) }}</textarea>
            </label>
            <label>
                <span>Card icon</span>
                <input type="file" name="card_icon" accept="image/*">
            </label>
            <label>
                <span>Card image</span>
                <input type="file" name="card_image" accept="image/*">
            </label>
            <label>
                <span>Hero image</span>
                <input type="file" name="hero_image" accept="image/*">
            </label>
            <label>
                <span>Highlight image</span>
                <input type="file" name="highlight_image" accept="image/*">
            </label>
            <label class="span-2">
                <span>Feature image tunggal</span>
                <input type="file" name="feature_image" accept="image/*">
            </label>
            <label class="span-2 inline-flex items-center gap-3">
                <input type="checkbox" name="show_intro" value="1" @checked(old('show_intro', $service->show_intro))>
                <span>Tampilkan intro di halaman detail</span>
            </label>
            <label class="span-2 inline-flex items-center gap-3">
                <input type="checkbox" name="overview_split_columns" value="1" @checked(old('overview_split_columns', $service->overview_split_columns))>
                <span>Overview dibagi 2 kolom</span>
            </label>
            <label class="span-2 inline-flex items-center gap-3">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $service->is_featured))>
                <span>Tampilkan di kartu service homepage</span>
            </label>
            <label class="span-2">
                <span>Sections JSON terstruktur</span>
                <textarea name="sections_json" rows="16">{{ old('sections_json', $service->sections_json ?? '[]') }}</textarea>
            </label>

            <div class="span-2 admin-form-actions">
                <button type="submit" class="button-primary">Simpan Layanan</button>
            </div>
        </form>
    </section>
@endsection
