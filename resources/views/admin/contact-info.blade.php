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

        <form action="{{ route('admin.contact-info.update') }}" method="POST" enctype="multipart/form-data" class="admin-form-grid">
            @csrf
            <label>
                <span>Page title</span>
                <input type="text" name="page_title" value="{{ old('page_title', $contact->page_title) }}">
            </label>
            <label>
                <span>Schedule heading</span>
                <input type="text" name="schedule_heading" value="{{ old('schedule_heading', $contact->schedule_heading) }}">
            </label>
            {{-- <label class="span-2">
                <span>Page intro</span>
                <textarea name="page_intro" rows="4">{{ old('page_intro', $contact->page_intro) }}</textarea>
            </label> --}}
            <label>
                <span>Phone / WhatsApp number</span>
                <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}">
            </label>
            <label>
                <span>Email</span>
                <input type="email" name="email" value="{{ old('email', $contact->email) }}">
            </label>
            <label class="span-2">
                <span>Address</span>
                <textarea name="address" rows="3">{{ old('address', $contact->address) }}</textarea>
            </label>
            <label class="span-2">
                <span>WhatsApp link</span>
                <input type="text" name="whatsapp_link" value="{{ old('whatsapp_link', $contact->whatsapp_link) }}">
            </label>
            <label class="span-2">
                <span>Ask label</span>
                <input type="text" name="ask_label" value="{{ old('ask_label', $contact->ask_label) }}">
            </label>
            <label class="span-2">
                <span>Contact image</span>
                <input type="file" name="contact_image" accept="image/*">
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
