@php
    $seoTitle = $pageSeoTitle ?? $seoTitleDefault;
    $seoDescription = $pageSeoDescription ?? $seoDescriptionDefault;
    $seoKeywords = $pageSeoKeywords ?? $seoKeywords;
    $seoImage = $pageSeoImage ?? $seoImage;
    $seoImageAlt = $doctorName;
    $seoImageType = 'image/png';
    $structuredData = json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Physician',
                '@id' => url('/').'#physician',
                'name' => $doctorName,
                'description' => $seoDescription,
                'image' => $seoImage,
                'url' => url('/'),
                'telephone' => $contactPhone,
                'email' => $contactEmail,
                'medicalSpecialty' => [
                    'Obstetrics',
                    'Gynecology',
                    'Minimally Invasive Surgery',
                    'Laparoscopy',
                ],
                'areaServed' => [
                    '@type' => 'City',
                    'name' => $contactCity,
                ],
                'worksFor' => [
                    '@id' => url('/').'#hospital',
                ],
            ],
            [
                '@type' => 'Hospital',
                '@id' => url('/').'#hospital',
                'name' => $clinicName,
                'department' => $clinicDepartment,
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $contactAddress,
                    'addressLocality' => $contactCity,
                    'addressRegion' => $contactRegion,
                    'postalCode' => $contactPostalCode,
                    'addressCountry' => $contactCountry,
                ],
                'telephone' => $contactPhone,
                'email' => $contactEmail,
                'url' => route('site.contact'),
                'availableService' => collect($servicePages)->take(4)->map(fn ($page) => [
                    '@type' => 'MedicalProcedure',
                    'name' => $page['title'],
                    'url' => route('site.service.show', $page['slug']),
                ])->all(),
            ],
            [
                '@type' => 'WebSite',
                '@id' => url('/').'#website',
                'name' => $siteName,
                'url' => url('/'),
                'inLanguage' => 'en',
            ],
            [
                '@type' => 'WebPage',
                '@id' => url('/').'#webpage',
                'name' => $seoTitle,
                'description' => $seoDescription,
                'url' => url('/'),
                'isPartOf' => [
                    '@id' => url('/').'#website',
                ],
                'about' => [
                    '@id' => url('/').'#physician',
                ],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $homeSectionPadX = 'px-[10px] md:px-[22px] lg:px-20';
    $homeSectionPadTop = 'pt-6 md:pt-8 lg:pt-14';
    $homeSectionPadBottom = 'pb-6 md:pb-8 lg:pb-14';
    $homeSectionClass = $homeSectionPadX.' '.$homeSectionPadTop.' '.$homeSectionPadBottom.' bg-white';
    $homeContentMax = 'mx-auto w-full max-w-[1090px]';
    $sectionTitleClass = "mb-4 text-center text-[0.78rem] leading-[1.12] font-extrabold text-[#0E446A] [font-family:'DM_Sans',sans-serif] md:mb-[18px] md:text-[1.28rem] md:leading-[1.08] lg:mb-[26px] lg:text-[2.35rem] lg:leading-[1.08]";
    $sectionTitleLeftClass = "mb-4 text-left text-[0.78rem] leading-[1.12] font-extrabold text-[#0E446A] [font-family:'DM_Sans',sans-serif] md:mb-[18px] md:text-[1.28rem] md:leading-[1.08] lg:mb-[26px] lg:text-[2.35rem] lg:leading-[1.08]";
    $sectionSubtitleClass = "m-0 text-[0.72rem] leading-[1.26] font-semibold text-[#00223A] [font-family:'DM_Sans',sans-serif] md:text-[0.8rem] md:leading-[1.28] lg:text-[1rem] lg:leading-[1.32]";
    $sectionBodyClass = "m-0 text-[0.54rem] leading-[1.62] font-normal text-[#495057] [font-family:'DM_Sans',sans-serif] md:text-[0.72rem] md:leading-[1.68] lg:text-[0.92rem] lg:leading-[1.78]";
    $contactFieldClass = "w-full rounded-[3px] border border-[var(--site-line)] bg-white px-2 py-[6px] text-[0.56rem] font-normal text-[#495057] [font-family:'DM_Sans',sans-serif] placeholder:text-[#495057] md:rounded-[4px] md:px-[10px] md:py-[10px] md:text-[0.78rem] lg:px-[14px] lg:py-[12px] lg:text-[0.96rem]";
@endphp

@extends('layouts.site')

@section('content')
    <div class="site-page">
        <div class="page-shell">
            @include('partials.site-header')

            <main class="site-main">
                <section class="home-hero-desktop">
                    <div class="home-hero-background" aria-hidden="true"></div>
                    <div class="home-hero-layout {{ $homeContentMax }}">
                        <div class="home-hero-copy">
                            <h1>{{ $homepage['hero_title'] }}</h1>
                            <p>{{ $homepage['hero_description'] }}</p>
                            <div class="hero-actions">
                                <a href="{{ $homepage['hero_primary_cta_url'] }}" class="button-primary">{{ $homepage['hero_primary_cta_label'] }}</a>
                            </div>
                        </div>
                        <div class="home-hero-visual">
                            <div class="hero-logo-card hero-logo-card-scope">
                                <img src="{{ asset('assets/branding/nhscope-logo-dark.png') }}" alt="NH Scope" decoding="async">
                            </div>
                            <div class="hero-logo-card hero-logo-card-hospital">
                                <img src="{{ asset('assets/branding/national-hospital-logo.png') }}" alt="National Hospital" decoding="async">
                            </div>
                            <div class="home-hero-image">
                                <img src="{{ $homepage['hero_image'] }}" alt="{{ $siteName }}" fetchpriority="high" decoding="async">
                            </div>
                        </div>
                    </div>
                </section>

                <section class="doctor-intro-section">
                    <div class="doctor-intro-inner {{ $homeContentMax }}">
                        <div class="doctor-intro-photo">
                            <img src="{{ $homepage['doctor_intro_image'] }}" alt="{{ $doctorName }}" loading="lazy" decoding="async">
                        </div>
                        <div class="doctor-intro-copy">
                            <h2>{{ $homepage['doctor_intro_title'] }}</h2>
                            <p>{{ $homepage['doctor_intro_body'] }}</p>
                            <p>{{ $homepage['doctor_intro_stat'] }}</p>
                            <div class="hero-actions">
                                <a href="{{ $homepage['doctor_intro_cta_url'] }}" class="button-primary">{{ $homepage['doctor_intro_cta_label'] }}</a>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="about-nh-section {{ $homeSectionPadX }} {{ $homeSectionPadTop }} {{ $homeSectionPadBottom }} bg-white">
                    <div class="about-nh-grid {{ $homeContentMax }} grid grid-cols-1 gap-[14px] md:grid-cols-[minmax(0,240px)_minmax(0,1fr)] md:items-center md:gap-[20px] lg:grid-cols-[minmax(320px,470px)_minmax(360px,1fr)] lg:justify-center lg:gap-12">
                        <article class="about-nh-copy grid content-start gap-3 md:gap-[12px] lg:gap-[18px]">
                            <h2 class="{{ $sectionSubtitleClass }} md:text-[1.02rem] md:leading-[1.16] lg:text-[2.2rem] lg:leading-[1.08]">{{ $homepage['about_title'] }}</h2>
                            <p class="{{ $sectionBodyClass }} md:text-[0.76rem] md:leading-[1.68] lg:text-[0.96rem] lg:leading-[1.76]">{{ $homepage['about_body'] }}</p>
                            <p class="{{ $sectionBodyClass }} md:text-[0.76rem] md:leading-[1.68] lg:text-[0.96rem] lg:leading-[1.76]">{{ $homepage['about_secondary_body'] }}</p>
                            <a href="{{ $homepage['about_cta_url'] }}" class="button-primary w-fit justify-self-start min-h-[24px] px-[10px] text-[0.5rem] md:min-h-[36px] md:px-[18px] md:text-[0.78rem] lg:min-h-[46px] lg:px-5 lg:text-[0.9rem]">{{ $homepage['about_cta_label'] }}</a>
                        </article>
                        <article class="about-nh-media w-full min-h-[172px] overflow-hidden rounded-[12px] md:min-h-[206px] md:rounded-[10px] lg:max-w-[560px] lg:min-h-[320px] lg:justify-self-start lg:rounded-[16px]">
                            <img class="h-full w-full object-cover object-center" src="{{ $homepage['about_image'] }}" alt="NH Scope doctors" loading="lazy" decoding="async">
                        </article>
                    </div>
                </section>

                <section class="our-service-section {{ $homeSectionClass }}">
                    <h2 class="{{ $sectionTitleClass }}">{{ $homepage['services_title'] }}</h2>
                    <div class="{{ $homeContentMax }} grid max-w-[286px] grid-cols-1 gap-[14px] md:max-w-full md:grid-cols-1 md:gap-[12px] lg:grid-cols-3 lg:gap-6">
                        @foreach($featuredServices as $item)
                            <a href="{{ $item['url'] }}" class="grid min-h-[100px] content-start gap-[8px] rounded-[5px] border border-[#D3E2EE] bg-white px-[13px] pt-[12px] pb-[12px] shadow-[0_4px_12px_rgba(14,68,106,0.06)] transition-transform duration-200 ease-out hover:-translate-y-0.5 hover:border-[#B8D0E2] hover:shadow-[0_12px_24px_rgba(14,68,106,0.1)] md:min-h-[90px] md:px-[14px] md:pt-[14px] md:pb-[14px] lg:min-h-[176px] lg:gap-4 lg:rounded-[8px] lg:px-5 lg:pt-5 lg:pb-5">
                                <span class="service-card-icon-wrap mb-0 inline-flex h-6 w-6 items-center justify-start bg-transparent md:mb-[2px] md:h-[22px] md:w-[22px] lg:mb-0 lg:h-[28px] lg:w-[28px]" aria-hidden="true">
                                    <img class="service-card-icon object-contain" src="{{ $item['icon'] }}" alt="" loading="lazy" decoding="async">
                                </span>
                                <h3 class="{{ $sectionSubtitleClass }}">{{ $item['label'] }}</h3>
                                <p class="{{ $sectionBodyClass }} md:max-w-[320px] md:text-[0.68rem] md:leading-[1.66] lg:max-w-none">{{ $item['copy'] }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="highlights-section {{ $homeSectionPadTop }} {{ $homeSectionPadBottom }} bg-white">
                    <h2 class="{{ $sectionTitleClass }}">{{ $homepage['highlights_title'] }}</h2>
                    <div class="{{ $homeContentMax }} grid max-w-[286px] grid-cols-1 overflow-hidden rounded-[12px] md:max-w-full md:grid-cols-3 lg:rounded-[14px]">
                        @foreach($highlightItems as $item)
                            <a href="{{ $item['url'] }}" class="relative flex min-h-[120px] items-end justify-center overflow-hidden px-2 py-[10px] text-center text-[0.68rem] text-white md:min-h-[136px] md:px-[10px] md:py-3 md:text-[0.96rem] lg:min-h-[188px] lg:px-4 lg:py-4 lg:text-[1rem]">
                                <img class="absolute inset-0 h-full w-full object-cover" src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy" decoding="async">
                                <span class="absolute inset-0 bg-[linear-gradient(180deg,rgba(14,68,106,0.08)_0%,rgba(14,68,106,0.46)_100%)]"></span>
                                <span class="relative max-w-[90%] font-bold [font-family:'DM_Sans',sans-serif] leading-[1.2]">{{ $item['title'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="highlight-bottom-section {{ $homeSectionPadTop }} {{ $homeSectionPadBottom }} bg-white">
                    <div class="{{ $homeContentMax }} max-w-[286px] overflow-hidden rounded-[12px] md:max-w-full lg:rounded-[10px]">
                        <img class="block w-full aspect-[335/177] object-cover" src="{{ $homepage['highlight_bottom_image'] }}" alt="NH Scope highlight" loading="lazy" decoding="async">
                    </div>
                </section>

                <section id="contact-section" class="contact-section {{ $homeSectionPadTop }} {{ $homeSectionPadBottom }} bg-[#eef7ff]">
                    <div class="{{ $homeContentMax }} max-w-[286px] bg-[#eef7ff] md:max-w-full">
                        <h2 class="{{ $sectionTitleLeftClass }}">{{ $homepage['contact_title'] }}</h2>
                        @if(session('enquiry_status'))
                            <div class="mb-4 rounded-[6px] border border-[#b8d6ea] bg-white px-4 py-3 font-sans text-[14px] leading-[1.6] font-medium text-[#0E446A] md:mb-5 md:text-[16px]">
                                {{ $homepage['contact_success_message'] ?: session('enquiry_status') }}
                            </div>
                        @endif
                        <div class="grid grid-cols-1 gap-4 md:gap-5 lg:grid-cols-[minmax(0,1fr)_320px] lg:items-start lg:gap-10">
                            <form class="grid gap-[8px] md:gap-[12px] lg:gap-4" action="{{ route('site.enquiry.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="source" value="home page">
                                <input class="{{ $contactFieldClass }}" type="text" name="name" placeholder="{{ $homepage['contact_name_placeholder'] }}" required>
                                <input class="{{ $contactFieldClass }}" type="text" name="phone" placeholder="{{ $homepage['contact_phone_placeholder'] }}" required>
                                <input class="{{ $contactFieldClass }}" type="email" name="email" placeholder="{{ $homepage['contact_email_placeholder'] }}" required>
                                <textarea class="{{ $contactFieldClass }} min-h-[120px] resize-none md:min-h-[160px] lg:min-h-[128px]" rows="6" name="message" placeholder="{{ $homepage['contact_message_placeholder'] }}"></textarea>
                                <div>
                                    <button type="submit" class="button-primary min-h-[30px] min-w-[102px] px-3 text-[0.58rem] md:min-h-[40px] md:min-w-[160px] md:px-[20px] md:text-[0.82rem] lg:min-h-[48px] lg:min-w-[188px] lg:px-[22px] lg:text-[0.92rem]">{{ $homepage['contact_button_label'] }}</button>
                                </div>
                            </form>
                            <div class="overflow-hidden rounded-[12px] md:rounded-[14px] lg:rounded-[14px]">
                                <img class="block w-full aspect-[1/0.82] object-cover md:aspect-[1/0.74] lg:aspect-[1/1.08]" src="{{ $homepage['contact_image'] }}" alt="National Hospital building" loading="lazy" decoding="async">
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            @include('partials.site-footer')
        </div>

    </div>
@endsection
