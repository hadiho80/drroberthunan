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

        <form action="{{ route('admin.contact-info.update') }}" method="POST" enctype="multipart/form-data" class="admin-form-stack">
            @csrf
            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Informasi Utama</h2>
                    <p>Bagian ini dipakai untuk judul halaman, kontak aktif, dan teks tombol yang tampil di area contact.</p>
                </div>
                <div class="admin-form-grid">
                    <label>
                        <span>Judul halaman</span>
                        <input type="text" name="page_title" value="{{ old('page_title', $contact->page_title) }}">
                    </label>
                    <label>
                        <span>Judul jadwal praktik</span>
                        <input type="text" name="schedule_heading" value="{{ old('schedule_heading', $contact->schedule_heading) }}">
                    </label>
                    <label>
                        <span>Nomor WhatsApp / telepon</span>
                        <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}">
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" value="{{ old('email', $contact->email) }}">
                    </label>
                    <label class="span-2">
                        <span>Alamat</span>
                        <textarea name="address" rows="3">{{ old('address', $contact->address) }}</textarea>
                    </label>
                    <label class="span-2">
                        <span>Link WhatsApp</span>
                        <small class="admin-field-help">Contoh: `https://wa.me/628...` agar tombol langsung membuka chat.</small>
                        <input type="text" name="whatsapp_link" value="{{ old('whatsapp_link', $contact->whatsapp_link) }}">
                    </label>
                    <label class="span-2">
                        <span>Label tombol ajakan</span>
                        <small class="admin-field-help">Contoh: “Chat via WhatsApp” atau “Hubungi sekarang”.</small>
                        <input type="text" name="ask_label" value="{{ old('ask_label', $contact->ask_label) }}">
                    </label>
                    @include('admin.partials.image-upload-field', ['name' => 'contact_image', 'label' => 'Gambar contact', 'value' => old('contact_image', $contact->contact_image), 'class' => 'span-2', 'fallbackLabel' => 'Belum ada contact image.', 'help' => 'Upload hanya jika memang dipakai di tampilan contact.'])
                </div>
            </section>

            <section class="admin-form-section">
                <div class="admin-form-section-header">
                    <h2>Jadwal Praktik</h2>
                    <p>Masukkan satu slot per baris agar format tetap rapi dan mudah diedit ulang.</p>
                </div>
                <div class="admin-form-grid">
                    <label class="span-2">
                        <span>Format jadwal</span>
                        <small class="admin-field-help">Gunakan format `Hari|Label waktu|Jam buka|Jam tutup`. Jika hanya butuh label tanpa jam detail, kolom jam bisa dikosongkan.</small>
                        <textarea name="schedule_rows" rows="8">{{ old('schedule_rows', $scheduleRows) }}</textarea>
                    </label>
                </div>
            </section>

            <div class="admin-form-actions">
                <p>Periksa nomor, email, dan link WhatsApp sebelum menyimpan.</p>
                <button type="submit" class="button-primary">Simpan Contact Info</button>
            </div>
        </form>
    </section>
@endsection
