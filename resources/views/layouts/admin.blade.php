<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin CMS' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a class="admin-brand" href="{{ route('admin.site-settings.index') }}">Dr. Robert Hunan CMS</a>
            <nav class="admin-nav">
                <a href="{{ route('admin.site-settings.index') }}" @class(['is-active' => request()->routeIs('admin.site-settings.*')])>Site Settings</a>
                <a href="{{ route('admin.homepage.index') }}" @class(['is-active' => request()->routeIs('admin.homepage.*')])>Homepage & SEO</a>
                <a href="{{ route('admin.doctor-profile.index') }}" @class(['is-active' => request()->routeIs('admin.doctor-profile.*')])>Doctor Profile</a>
                <a href="{{ route('admin.contact-info.index') }}" @class(['is-active' => request()->routeIs('admin.contact-info.*')])>Contact Info</a>
                <a href="{{ route('admin.services.index') }}" @class(['is-active' => request()->routeIs('admin.services.*')])>Layanan</a>
                <a href="{{ url('/') }}" target="_blank" rel="noreferrer">Lihat Website</a>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar">
                <div>
                    <p class="admin-topbar-label">Login sebagai</p>
                    <strong>{{ auth()->user()?->email }}</strong>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="button-secondary">Logout</button>
                </form>
            </div>

            @if(session('status'))
                <div class="admin-alert">
                    <strong>Perubahan berhasil disimpan.</strong>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="admin-alert admin-alert-error">
                    <strong>Form belum bisa disimpan.</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
