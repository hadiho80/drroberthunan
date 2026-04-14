@php
    $seoTitle = 'Contact '.$doctorName.' | National Hospital Surabaya';
    // $seoDescription = $pageIntro ?: ('Contact '.$doctorName.' at '.$clinicName.', Surabaya, for appointments, questions, and women health consultation support.');
    $seoDescription = 'Contact '.$doctorName.' at '.$clinicName.', Surabaya, for appointments, questions, and women health consultation support.';
    $seoImageAlt = $clinicName;
    $seoImageType = 'image/png';
    $structuredData = json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'ContactPage',
                '@id' => url()->current().'#contact-page',
                'name' => $pageTitle,
                'description' => $seoDescription,
                'url' => url()->current(),
            ],
            [
                '@type' => 'Hospital',
                '@id' => url('/').'#hospital',
                'name' => $clinicName,
                'department' => $clinicDepartment,
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $contactPageAddress,
                    'addressLocality' => $contactCity,
                    'addressRegion' => $contactRegion,
                    'postalCode' => $contactPostalCode,
                    'addressCountry' => $contactCountry,
                ],
                'telephone' => $contactPagePhone,
                'email' => $contactPageEmail,
                'url' => url()->current(),
                'openingHoursSpecification' => collect($contactScheduleSchema)->map(fn ($schedule) => [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => $schedule['day'],
                    'opens' => $schedule['opens_at'],
                    'closes' => $schedule['closes_at'],
                ])->filter(fn ($item) => !empty($item['opens']) && !empty($item['closes']))->values()->all(),
            ],
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => 'Home',
                        'item' => route('site.home'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => $pageTitle,
                        'item' => url()->current(),
                    ],
                ],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $pagePadX = 'px-4 md:px-6 lg:px-10';
    $pageSectionTop = 'pt-7 md:pt-8 lg:pt-10';
    $pageContentMax = 'mx-auto w-full max-w-[1100px]';
@endphp

@extends('layouts.site')

@section('content')
    <div class="site-page">
        <div class="page-shell">
            @include('partials.site-header')

            <main class="site-main">
                <section class="contact-page-section {{ $pagePadX }} {{ $pageSectionTop }} pb-8 md:pb-10 lg:pb-12 bg-[#eef6fc]">
                    <div class="{{ $pageContentMax }}">
                        <div class="grid grid-cols-1 gap-7 md:gap-8 lg:gap-10">
                            @if(session('enquiry_status'))
                                <div class="rounded-[6px] border border-[#b8d6ea] bg-white px-4 py-3 font-sans text-[14px] leading-[1.6] font-medium text-[#0E446A] md:text-[16px]">
                                    {{ session('enquiry_status') }}
                                </div>
                            @endif

                            <div class="grid grid-cols-1 gap-7 md:grid-cols-[minmax(0,0.9fr)_minmax(0,1.05fr)] md:items-start md:gap-10 lg:grid-cols-[minmax(0,0.85fr)_minmax(0,1fr)] lg:gap-14">
                                <div>
                                    <h1 class="m-0 font-sans text-[32px] leading-[1.08] font-extrabold tracking-[-0.03em] text-[#0E446A] md:text-[40px] md:leading-[1.05]">{{ strtoupper($pageTitle) }}</h1>
                                    {{-- @if($pageIntro)
                                        <p class="mt-4 max-w-[520px] font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $pageIntro }}</p>
                                    @endif --}}

                                    <div class="mt-8 md:mt-10">
                                        <img class="w-[150px] md:w-[168px] lg:w-[176px]" src="{{ asset('assets/branding/nhscope-logo-dark.png') }}" alt="NH Scope logo">
                                        <p class="mt-5 max-w-[360px] font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $contactPageAddress }}</p>
                                        @if($contactPageImage)
                                            <div class="mt-5 max-w-[360px] overflow-hidden rounded-[8px] border border-[#d7e7f3] bg-white">
                                                <img class="block h-auto w-full object-cover" src="{{ $contactPageImage }}" alt="{{ $pageTitle }}" loading="lazy" decoding="async">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <h2 class="m-0 font-sans text-[20px] leading-[1.35] font-semibold text-[#00223A] md:text-[24px] lg:max-w-[420px]">{{ $scheduleHeading }}</h2>

                                    <ul class="mt-5 m-0 grid gap-0 p-0 list-none">
                                        @foreach($contactSchedules as $schedule)
                                            <li class="grid grid-cols-[1fr_auto] items-center gap-4 py-[7px] font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:py-[8px] md:text-[18px]">
                                                <span>{{ $schedule['day'] }}</span>
                                                <span class="text-right">{{ $schedule['time'] }}</span>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="mt-5 flex items-center gap-3 font-sans text-[14px] leading-[1.4] font-semibold text-[#00223A] md:text-[18px]">
                                        <span>{{ $askLabel }}</span>
                                        <a href="mailto:{{ $contactPageEmail }}" aria-label="Email">
                                            <img class="h-[18px] w-auto md:h-[22px]" style="filter: brightness(0) saturate(100%) invert(10%) sepia(20%) saturate(2339%) hue-rotate(172deg) brightness(96%) contrast(102%);" src="{{ asset('assets/footer/icon-mail.png') }}" alt="">
                                        </a>
                                        <a href="{{ $contactPageWhatsAppLink ?: $whatsAppLink }}" target="_blank" rel="noreferrer" aria-label="WhatsApp">
                                            <img class="h-[18px] w-[18px] md:h-[22px] md:w-[22px]" style="filter: brightness(0) saturate(100%) invert(10%) sepia(20%) saturate(2339%) hue-rotate(172deg) brightness(96%) contrast(102%);" src="{{ asset('assets/footer/icon-wa.png') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <form class="contact-page-form contact-page-enquiry-form grid gap-3 border-t border-[#d7e7f3] pt-6 md:gap-4 md:pt-7 lg:pt-8" action="{{ route('site.enquiry.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="source" value="contact page">
                                <input class="w-full rounded-[4px] border border-[#cfe0ec] bg-white px-3 py-[10px] font-sans text-[14px] font-normal text-[#495057] placeholder:text-[#8aa0b1] md:px-4 md:py-3 md:text-[18px]" type="text" name="name" placeholder="Name *" required>
                                <div class="contact-page-form-row grid grid-cols-1 gap-3 md:grid-cols-2 md:gap-4">
                                    <input class="w-full rounded-[4px] border border-[#cfe0ec] bg-white px-3 py-[10px] font-sans text-[14px] font-normal text-[#495057] placeholder:text-[#8aa0b1] md:px-4 md:py-3 md:text-[18px]" type="text" name="phone" placeholder="Phone No. *" required>
                                    <input class="w-full rounded-[4px] border border-[#cfe0ec] bg-white px-3 py-[10px] font-sans text-[14px] font-normal text-[#495057] placeholder:text-[#8aa0b1] md:px-4 md:py-3 md:text-[18px]" type="email" name="email" placeholder="Email *" required>
                                </div>
                                <textarea class="min-h-[140px] w-full resize-none rounded-[4px] border border-[#cfe0ec] bg-white px-3 py-3 font-sans text-[14px] font-normal text-[#495057] placeholder:text-[#8aa0b1] md:min-h-[170px] md:px-4 md:py-3 md:text-[18px]" rows="7" name="message" placeholder="Message"></textarea>
                                <div>
                                    <button type="submit" class="inline-flex min-h-[40px] items-center justify-center rounded-[6px] bg-[#0E446A] px-5 font-sans text-[14px] font-semibold text-white transition-colors hover:bg-[#0b3656] md:min-h-[46px] md:px-6 md:text-[16px]">Send An Enquiry</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </main>

            @include('partials.site-footer')
        </div>
    </div>
@endsection
