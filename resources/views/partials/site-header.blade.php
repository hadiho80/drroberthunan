@php
    $isServicesRoute = request()->routeIs('site.services') || request()->routeIs('site.service.show');
@endphp

<header class="site-header">
    <div class="site-header-bar">
        <a href="{{ route('site.home') }}" class="site-brand">
            <span class="site-brand-logo">
                <img src="{{ asset('assets/branding/nhscope-logo-dark.png') }}" alt="NH Scope logo">
            </span>
            <span class="site-brand-name">dr. Robert Hunan Purwaka</span>
        </a>

        <nav class="site-nav-desktop" aria-label="Primary">
            <a href="{{ route('site.profile') }}" @class(['is-active' => request()->routeIs('site.profile')])>Doctor's Profile</a>
            <div class="desktop-dropdown">
                <button type="button" class="desktop-dropdown-trigger {{ $isServicesRoute ? 'is-active' : '' }}" aria-expanded="false">
                    <span>Services</span>
                    <span class="nav-chevron"></span>
                </button>
                <div class="desktop-dropdown-menu">
                    @foreach($serviceMenuItems as $item)
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @endforeach
                </div>
            </div>
            <a href="{{ route('site.contact') }}" @class(['is-active' => request()->routeIs('site.contact')])>Contact Us</a>
        </nav>

        <button
            type="button"
            class="site-menu-toggle"
            aria-expanded="false"
            aria-controls="mobile-nav-panel"
            data-menu-toggle
        >
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <div id="mobile-nav-panel" class="mobile-nav-panel" data-mobile-nav hidden>
        <nav class="mobile-nav" aria-label="Mobile">
            <a href="{{ route('site.profile') }}" @class(['is-active' => request()->routeIs('site.profile')])>Doctor's Profile</a>

            <div class="mobile-dropdown {{ $isServicesRoute ? 'is-open is-active' : '' }}" data-dropdown>
                <button
                    type="button"
                    class="mobile-dropdown-trigger"
                    aria-expanded="{{ $isServicesRoute ? 'true' : 'false' }}"
                    data-dropdown-trigger
                >
                    <span class="mobile-dropdown-label">Services</span>
                    <span class="mobile-dropdown-icon">
                        <span class="nav-chevron"></span>
                    </span>
                </button>
                <div class="mobile-dropdown-menu" data-dropdown-menu @if(!$isServicesRoute) hidden @endif>
                    @foreach($serviceMenuItems as $item)
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('site.contact') }}" @class(['is-active' => request()->routeIs('site.contact')])>Contact Us</a>
        </nav>
    </div>
</header>
