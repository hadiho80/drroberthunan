<!DOCTYPE html>
<html lang="{{ $seoLang ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seoTitle ?? config('app.name') }}</title>
    <meta name="description" content="{{ $seoDescription ?? '' }}">
    <meta name="keywords" content="{{ $seoKeywords ?? '' }}">
    <meta name="author" content="{{ $doctorName ?? $siteName ?? config('app.name') }}">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <meta name="format-detection" content="telephone=no">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" href="{{ url()->current() }}" hreflang="{{ $seoLang ?? 'en' }}">
    <link rel="alternate" href="{{ url()->current() }}" hreflang="x-default">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ $seoOgLocale ?? 'en_US' }}">
    <meta property="og:title" content="{{ $seoTitle ?? config('app.name') }}">
    <meta property="og:description" content="{{ $seoDescription ?? '' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $siteName ?? config('app.name') }}">
    @if(!empty($seoImage))
        <meta property="og:image" content="{{ $seoImage }}">
        @if(!empty($seoImageType))
            <meta property="og:image:type" content="{{ $seoImageType }}">
        @endif
        <meta property="og:image:alt" content="{{ $seoImageAlt ?? ($seoTitle ?? config('app.name')) }}">
        <meta name="twitter:image" content="{{ $seoImage }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $seoDescription ?? '' }}">
    <meta name="twitter:image:alt" content="{{ $seoImageAlt ?? ($seoTitle ?? config('app.name')) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=DM+Sans:wght@400;500;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @isset($structuredData)
        <script type="application/ld+json">{!! $structuredData !!}</script>
    @endisset
</head>
<body class="site-body">
    @yield('content')

    <a href="{{ $whatsAppLink ?? 'https://wa.me/' }}" class="floating-whatsapp" target="_blank" rel="noreferrer" aria-label="Chat via WhatsApp">
        <img src="{{ asset('assets/footer/icon-wa.png') }}" alt="">
        <span>WhatsApp</span>
    </a>
</body>
</html>
