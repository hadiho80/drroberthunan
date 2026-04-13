@extends('layouts.admin', ['title' => 'Contact Info'])

@section('content')
    <section class="admin-panel">
        <div class="admin-panel-heading">
            <div>
                <p class="section-badge">Contact Info</p>
                <h1>Contact Info Content</h1>
            </div>
            <p>Informasi kontak, alamat, dan jadwal praktik dikelola terpisah dari homepage.</p>
        </div>

        <form action="{{ route('admin.contact-info.update') }}" method="POST" class="admin-form-grid">
            @csrf
            <label>
                <span>Page title</span>
                <input type="text" name="page_title" value="{{ old('page_title', $contact->page_title) }}">
            </label>
            <label>
                <span>Schedule heading</span>
                <input type="text" name="schedule_heading" value="{{ old('schedule_heading', $contact->schedule_heading) }}">
            </label>
            <label class="span-2">
                <span>Page intro</span>
                <textarea name="page_intro" rows="4">{{ old('page_intro', $contact->page_intro) }}</textarea>
            </label>
            <label class="span-2">
                <span>Ask label</span>
                <input type="text" name="ask_label" value="{{ old('ask_label', $contact->ask_label) }}">
            </label>
            <label class="span-2">
                <span>Schedule rows `Day|Time label|Open|Close`, satu baris satu slot</span>
                <textarea name="schedule_rows" rows="8">{{ old('schedule_rows', $scheduleRows) }}</textarea>
            </label>

            <div class="span-2 admin-form-actions">
                <button type="submit" class="button-primary">Simpan Contact Info</button>
            </div>
        </form>
    </section>
@endsection
