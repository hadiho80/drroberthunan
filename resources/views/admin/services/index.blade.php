@extends('layouts.admin', ['title' => 'CMS Layanan'])

@section('content')
    <section class="admin-panel">
        <div class="admin-panel-heading">
            <div>
                <p class="section-badge">CMS Layanan</p>
                <h1>Daftar Layanan</h1>
            </div>
            <a href="{{ route('admin.services.create') }}" class="button-primary">Tambah Layanan</a>
        </div>

        <div class="admin-table">
            @forelse($services as $service)
                <article class="admin-table-row">
                    <div>
                        <h2>{{ $service->title }}</h2>
                        <p>{{ $service->description }}</p>
                    </div>
                    <div class="admin-table-actions">
                        <a href="{{ route('admin.services.edit', $service) }}" class="button-secondary">Edit</a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button-danger">Hapus</button>
                        </form>
                    </div>
                </article>
            @empty
                <p class="admin-empty">Belum ada layanan yang tersimpan.</p>
            @endforelse
        </div>
    </section>
@endsection
