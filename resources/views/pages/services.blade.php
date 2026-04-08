@php
    $seoTitle = $seoTitleDefault.' | '.$pageTitle;
    $seoDescription = $pageIntro;
    $structuredData = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => $pageTitle,
        'description' => $pageIntro,
        'url' => url()->current(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $pagePadX = 'px-[10px] md:px-[22px] lg:px-16';
    $pageSectionTop = 'pt-6 md:pt-8 lg:pt-10';
    $pageContentMax = 'mx-auto w-full max-w-[900px]';
    $serviceVisualMap = [
        'obstetrics' => asset('assets/highlights/obstetrics.png'),
        'gynaecology' => asset('assets/highlights/gynecology.png'),
        'minimally-invasive-surgery' => asset('assets/highlights/minimally-invasive-surgery.png'),
        'laparoscopy' => asset('assets/highlights/laparoscopy.png'),
        'myoma' => asset('assets/highlights/myoma.png'),
        'endometriosis' => asset('assets/highlights/endometriosis.png'),
        'ovarian-cyst' => asset('assets/highlights/ovarian-cyst.png'),
        'hysterectomy' => asset('assets/highlights/hysterectomy.png'),
    ];
@endphp

@extends('layouts.site')

@section('content')
    <div class="site-page">
        <div class="page-shell">
            @include('partials.site-header')

            <main class="site-main grid gap-10 pb-20 md:gap-20 md:pb-40">
                <section class="{{ $pagePadX }} {{ $pageSectionTop }} pb-6 md:pb-8 lg:pb-10 bg-white">
                    <div class="{{ $pageContentMax }}">
                        <div class="mb-[12px] max-w-[360px] md:mb-[14px] md:max-w-[440px] lg:mb-[18px] lg:max-w-[520px]">
                            <p class="mb-[6px] text-[0.5rem] font-extrabold uppercase tracking-[0.12em] text-[#1971c2] md:mb-[8px] md:text-[0.56rem] lg:mb-[10px] lg:text-[0.72rem]">Services</p>
                            <h1 class="m-0 text-[0.86rem] font-extrabold leading-[1.08] tracking-[-0.03em] text-[#0e446a] md:text-[0.96rem] lg:text-[1.42rem]">{{ $pageTitle }}</h1>
                            <p class="mt-[6px] text-[0.54rem] leading-[1.48] text-[#495057] md:mt-[8px] md:text-[0.58rem] md:leading-[1.58] lg:mt-[10px] lg:text-[0.72rem] lg:leading-[1.7]">{{ $pageIntro }}</p>
                        </div>

                        <div class="grid grid-cols-1 gap-10 md:gap-20 lg:grid-cols-2">
                            @foreach($servicePages as $page)
                                <article class="overflow-hidden rounded-[4px] border border-[var(--site-line)] bg-white shadow-[0_12px_28px_rgba(14,68,106,0.04)]">
                                    <div class="relative min-h-[88px] overflow-hidden md:min-h-[120px] lg:min-h-[132px]">
                                        <img class="absolute inset-0 h-full w-full object-cover" src="{{ $serviceVisualMap[$page['slug']] ?? asset('assets/highlights/nhscope.png') }}" alt="{{ $page['title'] }}">
                                        <span class="absolute inset-0 bg-[linear-gradient(180deg,rgba(14,68,106,0.18)_0%,rgba(14,68,106,0.52)_100%)]"></span>
                                    </div>
                                    <div class="grid gap-[8px] p-[10px] md:gap-[8px] md:p-[12px] lg:gap-[10px] lg:p-[15px]">
                                        <p class="m-0 text-[0.52rem] font-extrabold uppercase tracking-[0.12em] text-[#1971c2] md:text-[0.64rem] lg:text-[0.74rem]">{{ $page['eyebrow'] }}</p>
                                        <h3 class="m-0 text-[0.72rem] font-semibold leading-[1.24] text-[#00223A] [font-family:'DM_Sans',sans-serif] md:text-[0.82rem] lg:text-[0.92rem] lg:leading-[1.28]">{{ $page['title'] }}</h3>
                                        <p class="m-0 text-[0.54rem] leading-[1.48] text-[#495057] md:text-[0.58rem] md:leading-[1.6] lg:text-[0.68rem] lg:leading-[1.72]">{{ $page['intro'] }}</p>
                                        <ul class="m-0 grid gap-[4px] pl-[14px] text-[0.5rem] leading-[1.42] text-[#495057] md:gap-[5px] md:text-[0.54rem] md:leading-[1.5] lg:gap-[6px] lg:pl-[18px] lg:text-[0.64rem] lg:leading-[1.62]">
                                            @foreach(collect($page['overview'])->take(3) as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                        <a class="button-secondary" href="{{ route('site.service.show', $page['slug']) }}">Open Service</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            </main>

            @include('partials.site-footer')
        </div>
    </div>
@endsection
