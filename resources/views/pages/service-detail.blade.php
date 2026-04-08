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
    $pagePadX = 'px-4 md:px-6 lg:px-10';
    $pageSectionTop = 'pt-6 md:pt-8 lg:pt-10';
    $pageContentMax = 'mx-auto w-full max-w-[1100px]';
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
    $serviceHeroSuffix = $servicePage['hero_suffix'] ?? '';
    $showServiceIntro = $servicePage['show_intro'] ?? true;
    $overviewSplitColumns = $servicePage['overview_split_columns'] ?? false;
    $overviewColumns = $overviewSplitColumns
        ? array_chunk($servicePage['overview'], (int) ceil(count($servicePage['overview']) / 2))
        : [];
@endphp

@extends('layouts.site')

@section('content')
    <div class="site-page">
        <div class="page-shell">
            @include('partials.site-header')

            <main class="site-main">
                <section class="service-detail-page-hero relative isolate min-h-[210px] overflow-hidden {{ $pagePadX }} py-6 md:min-h-[320px] md:py-8 lg:min-h-[430px] lg:py-12">
                    <img class="absolute inset-0 -z-20 h-full w-full object-cover" src="{{ $serviceHeroImage }}" alt="{{ $servicePage['title'] }}">
                    <span class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(8,27,42,0.82)_0%,rgba(8,27,42,0.58)_46%,rgba(8,27,42,0.22)_100%)]"></span>
                    <div class="{{ $pageContentMax }} relative flex min-h-[162px] items-center md:min-h-[240px] lg:min-h-[335px]">
                        <div class="w-full text-left text-white md:max-w-[420px] lg:max-w-[520px]">
                            <p class="mb-3 font-sans text-[24px] leading-[1.2] font-normal text-white/90 md:text-[32px]">{{ $servicePage['eyebrow'] }}</p>
                            <h1 class="m-0 w-full font-sans text-[32px] leading-[1.08] font-extrabold tracking-[-0.03em] text-white md:text-[40px] md:leading-[1.05]">{{ strtoupper($servicePage['title']).$serviceHeroSuffix }}</h1>
                        </div>
                    </div>
                </section>

                <section class="{{ $pagePadX }} {{ $pageSectionTop }} pb-6 md:pb-8 lg:pb-10 bg-white">
                    <div class="{{ $pageContentMax }} grid gap-4 md:gap-5 lg:gap-6">
                        @if($showServiceIntro)
                            <div class="max-w-[980px]">
                                <h3 class="m-0 font-sans text-[24px] leading-[1.45] font-medium text-[#00223A] md:text-[32px] md:leading-[1.4]">{{ $servicePage['intro'] }}</h3>
                            </div>
                        @endif

                        <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                            <h2 class="m-0 font-sans text-[24px] leading-[1.25] font-semibold text-[#00223A] md:text-[32px]">{{ $servicePage['overview_title'] }}</h2>
                            @if($overviewSplitColumns)
                                <div class="mt-3 grid gap-2 md:grid-cols-2 md:gap-x-10 lg:mt-4">
                                    @foreach($overviewColumns as $column)
                                        <ul class="list-disc pl-[1.2em] marker:text-[#495057]">
                                            @foreach($column as $item)
                                                <li class="font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]"><span>{{ $item }}</span></li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>
                            @else
                                <ul class="mt-3 grid list-disc gap-2 pl-[1.2em] marker:text-[#495057] md:gap-[0.35rem] lg:mt-4 lg:gap-[0.45rem]">
                                    @foreach($servicePage['overview'] as $item)
                                        <li class="font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]"><span>{{ $item }}</span></li>
                                    @endforeach
                                </ul>
                            @endif
                        </article>

                        @foreach($servicePage['sections'] as $section)
                            @php
                                $sectionSplitColumns = $section['split_columns'] ?? false;
                                $sectionColumns = $sectionSplitColumns && !empty($section['list'])
                                    ? array_chunk($section['list'], (int) ceil(count($section['list']) / 2))
                                    : [];
                            @endphp
                            <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                <h2 class="m-0 font-sans text-[24px] leading-[1.25] font-semibold text-[#00223A] md:text-[32px]">{{ $section['title'] }}</h2>
                                @if(!empty($section['list']))
                                    @if($sectionSplitColumns)
                                        <div class="mt-3 grid gap-2 md:grid-cols-2 md:gap-x-10 lg:mt-4">
                                            @foreach($sectionColumns as $column)
                                                <ul class="list-disc pl-[1.2em] marker:text-[#495057]">
                                                    @foreach($column as $item)
                                                        <li class="font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]"><span>{{ $item }}</span></li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </div>
                                    @else
                                        <ul class="mt-3 grid list-disc gap-2 pl-[1.2em] marker:text-[#495057] md:gap-[0.35rem] lg:mt-4 lg:gap-[0.45rem]">
                                            @foreach($section['list'] as $item)
                                                <li class="font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]"><span>{{ $item }}</span></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @else
                                    <p class="mt-3 mb-0 font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $section['copy'] }}</p>
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
