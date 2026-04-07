@php
    $seoTitle = $seoTitleDefault.' | '.$servicePage['title'];
    $seoDescription = $servicePage['intro'];
    $structuredData = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'MedicalProcedure',
        'name' => $servicePage['title'],
        'description' => $servicePage['intro'],
        'url' => url()->current(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $pagePadX = 'px-[10px] md:px-[22px] lg:px-16';
    $pageSectionTop = 'pt-6 md:pt-8 lg:pt-10';
    $pageContentMax = 'mx-auto w-full max-w-[860px]';
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
    $serviceHeroImage = $serviceVisualMap[$servicePage['slug']] ?? asset('assets/highlights/nhscope.png');
@endphp

@extends('layouts.site')

@section('content')
    <div class="site-page">
        <div class="page-shell">
            @include('partials.site-header')

            <main class="site-main">
                <section class="service-detail-page-hero relative isolate min-h-[150px] overflow-hidden {{ $pagePadX }} py-3 md:min-h-[210px] md:py-5 lg:min-h-[268px] lg:py-9">
                    <img class="absolute inset-0 -z-20 h-full w-full object-cover" src="{{ $serviceHeroImage }}" alt="{{ $servicePage['title'] }}">
                    <span class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(8,27,42,0.82)_0%,rgba(8,27,42,0.58)_46%,rgba(8,27,42,0.22)_100%)]"></span>
                    <div class="{{ $pageContentMax }} relative">
                        <div class="max-w-[150px] text-white md:max-w-[210px] lg:max-w-[340px]">
                            <p class="mb-[6px] text-[0.52rem] opacity-85 md:text-[0.52rem] lg:mb-2 lg:text-[0.74rem]">Services</p>
                            <h1 class="mb-[6px] text-[0.9rem] font-extrabold leading-[1.05] tracking-[-0.03em] text-white md:mb-2 md:text-[1.25rem] lg:mb-[10px] lg:text-[1.9rem]">{{ strtoupper($servicePage['title']) }}</h1>
                            <p class="m-0 text-[0.52rem] leading-[1.45] text-white md:text-[0.64rem] md:leading-[1.55] lg:max-w-[330px] lg:text-[0.82rem] lg:leading-[1.7]">{{ $servicePage['intro'] }}</p>
                        </div>
                    </div>
                </section>

                <section class="{{ $pagePadX }} {{ $pageSectionTop }} pb-6 md:pb-8 lg:pb-10 bg-white">
                    <div class="{{ $pageContentMax }} grid gap-[10px] md:gap-[14px] lg:gap-5">
                    <article class="rounded-[4px] border border-[var(--site-line)] bg-white px-3 py-[10px] shadow-[0_10px_24px_rgba(14,68,106,0.04)] md:px-4 md:py-[14px] lg:px-5 lg:py-[18px]">
                        <h2 class="mb-2 text-[0.72rem] font-extrabold text-[#0e446a] md:text-[0.8rem] lg:mb-3 lg:text-[0.9rem]">{{ $servicePage['overview_title'] }}</h2>
                        <ul class="m-0 grid gap-[5px] pl-[14px] text-[0.52rem] leading-[1.42] text-[#495057] md:gap-[7px] md:text-[0.6rem] md:leading-[1.54] lg:gap-[8px] lg:pl-[18px] lg:text-[0.7rem] lg:leading-[1.68]">
                            @foreach($servicePage['overview'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>

                    <div class="overflow-hidden rounded-[4px] border border-[var(--site-line)]">
                        <img class="block w-full aspect-[16/8] object-cover md:aspect-[16/7] lg:aspect-[16/6.6]" src="{{ $serviceHeroImage }}" alt="{{ $servicePage['title'] }}">
                    </div>

                    @foreach($servicePage['sections'] as $section)
                        <article class="rounded-[4px] border border-[var(--site-line)] bg-white px-3 py-[10px] shadow-[0_10px_24px_rgba(14,68,106,0.04)] md:px-4 md:py-[14px] lg:px-5 lg:py-[18px]">
                            <h2 class="mb-2 text-[0.72rem] font-extrabold text-[#0e446a] md:text-[0.8rem] lg:mb-3 lg:text-[0.9rem]">{{ $section['title'] }}</h2>
                            @if(!empty($section['list']))
                                <ul class="m-0 grid gap-[5px] pl-[14px] text-[0.52rem] leading-[1.42] text-[#495057] md:gap-[7px] md:text-[0.6rem] md:leading-[1.54] lg:gap-[8px] lg:pl-[18px] lg:text-[0.7rem] lg:leading-[1.68]">
                                    @foreach($section['list'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="m-0 text-[0.54rem] leading-[1.46] text-[#495057] md:text-[0.62rem] md:leading-[1.6] lg:text-[0.7rem] lg:leading-[1.72]">{{ $section['copy'] }}</p>
                            @endif
                        </article>
                    @endforeach
                    </div>
                </section>
            </main>

            @include('partials.site-footer')
        </div>
    </div>
@endsection
