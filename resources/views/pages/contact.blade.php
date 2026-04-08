@php
    $seoTitle = $seoTitleDefault.' | '.$pageTitle;
    $seoDescription = $pageIntro;
    $structuredData = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ContactPage',
        'name' => $pageTitle,
        'description' => $pageIntro,
        'url' => url()->current(),
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
                <section class="{{ $pagePadX }} {{ $pageSectionTop }} pb-8 md:pb-10 lg:pb-12 bg-[#eef6fc]">
                    <div class="{{ $pageContentMax }}">
                        <div class="grid grid-cols-1 gap-7 md:gap-8 lg:gap-10">
                            <div class="grid grid-cols-1 gap-7 md:grid-cols-[minmax(0,0.9fr)_minmax(0,1.05fr)] md:items-start md:gap-10 lg:grid-cols-[minmax(0,0.85fr)_minmax(0,1fr)] lg:gap-14">
                                <div>
                                    <h1 class="m-0 font-sans text-[32px] leading-[1.08] font-extrabold tracking-[-0.03em] text-[#0E446A] md:text-[40px] md:leading-[1.05]">{{ strtoupper($pageTitle) }}</h1>

                                    <div class="mt-8 md:mt-10">
                                        <img class="w-[150px] md:w-[168px] lg:w-[176px]" src="{{ asset('assets/branding/nhscope-logo-dark.png') }}" alt="NH Scope logo">
                                        <p class="mt-5 max-w-[360px] font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $contactAddress }}</p>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="m-0 font-sans text-[20px] leading-[1.35] font-semibold text-[#00223A] md:text-[24px] lg:max-w-[420px]">dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS's Schedule</h2>

                                    <ul class="mt-5 m-0 grid gap-0 p-0 list-none">
                                        <li class="grid grid-cols-[1fr_auto] items-center gap-4 py-[7px] font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:py-[8px] md:text-[18px]"><span>Monday</span><span>17:00 - 20:00</span></li>
                                        <li class="grid grid-cols-[1fr_auto] items-center gap-4 py-[7px] font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:py-[8px] md:text-[18px]"><span>Tuesday</span><span>09:00 - 12:00</span></li>
                                        <li class="grid grid-cols-[1fr_auto] items-center gap-4 py-[7px] font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:py-[8px] md:text-[18px]"><span>Wednesday</span><span>17:00 - 20:00</span></li>
                                        <li class="grid grid-cols-[1fr_auto] items-center gap-4 py-[7px] font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:py-[8px] md:text-[18px]"><span>Thursday</span><span>09:00 - 12:00</span></li>
                                        <li class="grid grid-cols-[1fr_auto] items-center gap-4 py-[7px] font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:py-[8px] md:text-[18px]"><span>Friday</span><span class="text-right">09:00 - 12:00 / 17:00 - 20:00</span></li>
                                        <li class="grid grid-cols-[1fr_auto] items-center gap-4 py-[7px] font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:py-[8px] md:text-[18px]"><span>Sunday</span><span>09:00 - 13:00</span></li>
                                    </ul>

                                    <div class="mt-5 flex items-center gap-3 font-sans text-[14px] leading-[1.4] font-semibold text-[#00223A] md:text-[18px]">
                                        <span>Ask Me A Question:</span>
                                        <a href="mailto:{{ $contactEmail }}" aria-label="Email">
                                            <img class="h-[18px] w-auto md:h-[22px]" src="{{ asset('assets/footer/icon-mail.png') }}" alt="">
                                        </a>
                                        <a href="{{ $whatsAppLink }}" target="_blank" rel="noreferrer" aria-label="WhatsApp">
                                            <img class="h-[18px] w-[18px] md:h-[22px] md:w-[22px]" src="{{ asset('assets/footer/icon-wa.png') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <form class="contact-page-form grid gap-3 border-t border-[#d7e7f3] pt-6 md:gap-4 md:pt-7 lg:pt-8" action="#">
                                <input class="w-full rounded-[4px] border border-[#cfe0ec] bg-white px-3 py-[10px] font-sans text-[14px] font-normal text-[#495057] placeholder:text-[#8aa0b1] md:px-4 md:py-3 md:text-[18px]" type="text" placeholder="Name *">
                                <div class="contact-page-form-row grid grid-cols-1 gap-3 md:grid-cols-2 md:gap-4">
                                    <input class="w-full rounded-[4px] border border-[#cfe0ec] bg-white px-3 py-[10px] font-sans text-[14px] font-normal text-[#495057] placeholder:text-[#8aa0b1] md:px-4 md:py-3 md:text-[18px]" type="text" placeholder="Phone No. *">
                                    <input class="w-full rounded-[4px] border border-[#cfe0ec] bg-white px-3 py-[10px] font-sans text-[14px] font-normal text-[#495057] placeholder:text-[#8aa0b1] md:px-4 md:py-3 md:text-[18px]" type="email" placeholder="Email *">
                                </div>
                                <textarea class="min-h-[140px] w-full resize-none rounded-[4px] border border-[#cfe0ec] bg-white px-3 py-3 font-sans text-[14px] font-normal text-[#495057] placeholder:text-[#8aa0b1] md:min-h-[170px] md:px-4 md:py-3 md:text-[18px]" rows="7" placeholder="Message"></textarea>
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
