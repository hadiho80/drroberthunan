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
    $pagePadX = 'px-[10px] md:px-[22px] lg:px-16';
    $pageSectionTop = 'pt-6 md:pt-8 lg:pt-10';
    $pageContentMax = 'mx-auto w-full max-w-[860px]';
@endphp

@extends('layouts.site')

@section('content')
    <div class="site-page">
        <div class="page-shell">
            @include('partials.site-header')

            <main class="site-main">
                <section class="{{ $pagePadX }} {{ $pageSectionTop }} pb-6 md:pb-8 lg:pb-10 bg-white">
                    <div class="{{ $pageContentMax }}">
                        <div class="mb-[12px] max-w-[360px] md:mb-[14px] md:max-w-[440px] lg:mb-[18px] lg:max-w-[520px]">
                            <p class="mb-[6px] text-[0.5rem] font-extrabold uppercase tracking-[0.12em] text-[#1971c2] md:mb-[8px] md:text-[0.56rem] lg:mb-[10px] lg:text-[0.72rem]">Contact</p>
                            <h1 class="m-0 text-[0.86rem] font-extrabold leading-[1.08] tracking-[-0.03em] text-[#0e446a] md:text-[0.96rem] lg:text-[1.42rem]">{{ $pageTitle }}</h1>
                            <p class="mt-[6px] text-[0.54rem] leading-[1.48] text-[#495057] md:mt-[8px] md:text-[0.58rem] md:leading-[1.58] lg:mt-[10px] lg:text-[0.72rem] lg:leading-[1.7]">{{ $pageIntro }}</p>
                        </div>

                        <div class="grid grid-cols-1 gap-[14px] md:grid-cols-[minmax(0,0.72fr)_minmax(0,1fr)] md:items-start md:gap-[18px] lg:grid-cols-[minmax(0,0.7fr)_minmax(0,1fr)] lg:gap-[28px]">
                            <div class="rounded-[4px] border border-[var(--site-line)] bg-white p-[12px] shadow-[0_12px_28px_rgba(14,68,106,0.04)] md:p-[14px] lg:p-[18px]">
                                <h2 class="mb-2 text-[0.72rem] font-extrabold leading-[1.08] tracking-[-0.03em] text-[#0e446a] md:mb-3 md:text-[0.82rem] lg:mb-[14px] lg:text-[1.02rem]">Clinic Information</h2>
                                <div>
                                    <img class="mb-[10px] w-[82px] md:mb-3 md:w-[90px] lg:mb-4 lg:w-[112px]" src="{{ asset('assets/branding/nhscope-logo-dark.png') }}" alt="NH Scope logo">
                                    <p class="m-0 text-[0.54rem] leading-[1.45] text-[#495057] md:text-[0.56rem] md:leading-[1.58] lg:text-[0.68rem] lg:leading-[1.72]">{{ $contactAddress }}</p>
                                </div>
                                <p class="mt-[10px] mb-0 text-[0.54rem] leading-[1.45] text-[#495057] md:mt-[12px] md:text-[0.56rem] md:leading-[1.58] lg:mt-[14px] lg:text-[0.68rem] lg:leading-[1.72]">{{ $pageIntro }}</p>
                                <div class="mt-[10px] flex items-center gap-3 text-[0.54rem] font-extrabold text-[#0e446a] md:text-[0.56rem] lg:text-[0.68rem]">
                                    <span>Ask Me A Question:</span>
                                    <a href="mailto:{{ $contactEmail }}" aria-label="Email"><img class="h-[15px] w-auto lg:h-[17px]" src="{{ asset('assets/footer/icon-mail.png') }}" alt=""></a>
                                    <a href="{{ $whatsAppLink }}" target="_blank" rel="noreferrer" aria-label="WhatsApp"><img class="h-[15px] w-[15px] lg:h-[17px] lg:w-[17px]" src="{{ asset('assets/footer/icon-wa.png') }}" alt=""></a>
                                </div>
                            </div>
                            <div class="rounded-[4px] border border-[var(--site-line)] bg-white p-[12px] shadow-[0_12px_28px_rgba(14,68,106,0.04)] md:p-[14px] lg:p-[18px]">
                                <h2 class="mb-2 text-[0.72rem] font-extrabold text-[#0e446a] md:mb-3 md:text-[0.82rem] lg:mb-[14px] lg:text-[1.02rem]">dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS Schedule</h2>
                                <ul class="m-0 grid gap-0 p-0 list-none">
                                    <li class="flex items-center justify-between gap-4 border-b border-[#D3E2EE] py-[6px] text-[0.54rem] text-[#495057] md:text-[0.56rem] lg:text-[0.68rem]"><span>Monday</span><span>17:00 - 20:00</span></li>
                                    <li class="flex items-center justify-between gap-4 border-b border-[#D3E2EE] py-[6px] text-[0.54rem] text-[#495057] md:text-[0.56rem] lg:text-[0.68rem]"><span>Tuesday</span><span>09:00 - 12:00</span></li>
                                    <li class="flex items-center justify-between gap-4 border-b border-[#D3E2EE] py-[6px] text-[0.54rem] text-[#495057] md:text-[0.56rem] lg:text-[0.68rem]"><span>Wednesday</span><span>17:00 - 20:00</span></li>
                                    <li class="flex items-center justify-between gap-4 border-b border-[#D3E2EE] py-[6px] text-[0.54rem] text-[#495057] md:text-[0.56rem] lg:text-[0.68rem]"><span>Thursday</span><span>09:00 - 12:00</span></li>
                                    <li class="flex items-center justify-between gap-4 border-b border-[#D3E2EE] py-[6px] text-[0.54rem] text-[#495057] md:text-[0.56rem] lg:text-[0.68rem]"><span>Friday</span><span class="text-right">09:00 - 12:00 / 17:00 - 20:00</span></li>
                                    <li class="flex items-center justify-between gap-4 py-[6px] text-[0.54rem] text-[#495057] md:text-[0.56rem] lg:text-[0.68rem]"><span>Sunday</span><span>09:00 - 13:00</span></li>
                                </ul>
                            </div>
                        </div>

                        <form class="contact-page-form mt-4 grid gap-2 rounded-[4px] border border-[var(--site-line)] bg-white p-[12px] shadow-[0_12px_28px_rgba(14,68,106,0.04)] md:mt-[20px] md:gap-[10px] md:p-[14px] lg:mt-[26px] lg:gap-3 lg:p-[18px]" action="#">
                            <input type="text" placeholder="Name *">
                            <div class="contact-page-form-row grid grid-cols-1 gap-2 md:grid-cols-1 md:gap-[10px] lg:grid-cols-2 lg:gap-3">
                                <input type="text" placeholder="Phone No. *">
                                <input type="email" placeholder="Email *">
                            </div>
                            <textarea rows="7" placeholder="Message"></textarea>
                            <button type="submit" class="button-primary">Send An Enquiry</button>
                        </form>
                    </div>
                </section>
            </main>

            @include('partials.site-footer')
        </div>
    </div>
@endsection
