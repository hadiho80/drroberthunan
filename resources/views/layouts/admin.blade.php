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
            <a class="admin-brand" href="{{ route('admin.homepage.index') }}">Dr. Robert Hunan CMS</a>
            <nav class="admin-nav">
                <a href="{{ route('admin.homepage.index') }}" @class(['is-active' => request()->routeIs('admin.homepage.*')])>Homepage & SEO</a>
                <a href="{{ route('admin.services.index') }}" @class(['is-active' => request()->routeIs('admin.services.*')])>Layanan</a>
                <a href="{{ url('/') }}" target="_blank" rel="noreferrer">Lihat Website</a>
            </nav>
        </aside>

        <main class="admin-main">
            @if(session('status'))
                <div class="admin-alert">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="admin-alert admin-alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
