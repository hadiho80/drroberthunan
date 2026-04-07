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

            <label class="span-2">
                <span>Judul layanan</span>
                <input type="text" name="title" value="{{ old('title', $service->title) }}">
            </label>
            <label class="span-2">
                <span>Deskripsi layanan</span>
                <textarea name="description" rows="6">{{ old('description', $service->description) }}</textarea>
            </label>
            <label class="span-2">
                <span>Gambar layanan</span>
                <input type="file" name="image" accept="image/*">
            </label>

            <div class="span-2 admin-form-actions">
                <button type="submit" class="button-primary">Simpan Layanan</button>
            </div>
        </form>
    </section>
@endsection
