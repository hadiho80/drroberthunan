@php
    $seoTitle = $servicePage['title'].' | '.$doctorName.' in Surabaya';
    $seoDescription = $servicePage['intro'].' Learn more about consultation and treatment with '.$doctorName.' at '.$clinicName.'.';
    $pagePadX = 'px-4 md:px-6 lg:px-10';
    $pageSectionTop = '';
    $pageContentMax = 'mx-auto w-full max-w-[1100px]';
    $serviceVisualMap = [
        'obstetrics' => asset('assets/service-hero/obstetrics-hero.jpg'),
        'gynaecology' => asset('assets/service-hero/gynaecology-hero.jpg'),
        'minimally-invasive-surgery' => asset('assets/service-hero/minimally-invasive-surgery-hero.png'),
        'laparoscopy' => asset('assets/service-hero/laparoscopy-hero.png'),
        'myoma' => asset('assets/service-hero/myoma-hero.jpg'),
        'endometriosis' => asset('assets/service-hero/endometriosis-hero.jpg'),
        'ovarian-cyst' => asset('assets/service-hero/ovarian-cyst-hero.jpg'),
        'hysterectomy' => asset('assets/service-hero/hysterectomy-hero.jpg'),
    ];
    $serviceHeroImage = $serviceVisualMap[$servicePage['slug']] ?? asset('assets/highlights/nhscope.png');
    $seoImageAlt = $servicePage['title'].' service by '.$doctorName;
    $seoImageType = str_ends_with($serviceHeroImage, '.jpg') || str_ends_with($serviceHeroImage, '.jpeg') ? 'image/jpeg' : 'image/png';
    $serviceHeroSuffix = $servicePage['hero_suffix'] ?? '';
    $showServiceIntro = $servicePage['show_intro'] ?? true;
    $customLayout = $servicePage['custom_layout'] ?? null;
    $overviewSplitColumns = $servicePage['overview_split_columns'] ?? false;
    $overviewColumns = $overviewSplitColumns
        ? array_chunk($servicePage['overview'], (int) ceil(count($servicePage['overview']) / 2))
        : [];
    $structuredData = json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'MedicalProcedure',
                '@id' => url()->current().'#procedure',
                'name' => $servicePage['title'],
                'description' => $seoDescription,
                'url' => url()->current(),
                'image' => $serviceHeroImage,
                'bodyLocation' => 'Women reproductive health',
                'areaServed' => [
                    '@type' => 'City',
                    'name' => $contactCity,
                ],
                'provider' => [
                    '@type' => 'Physician',
                    'name' => $doctorName,
                ],
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
                        'name' => 'Services',
                        'item' => route('site.services'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 3,
                        'name' => $servicePage['title'],
                        'item' => url()->current(),
                    ],
                ],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp

@extends('layouts.site')

@section('content')
    <div class="site-page">
        <div class="page-shell">
            @include('partials.site-header')

            <main class="site-main service-detail-main pb-20 md:pb-40">
                @if($customLayout === 'endometriosis')
                    <section class="service-detail-page-section service-detail-page-hero relative isolate h-[351px] overflow-hidden {{ $pagePadX }} py-6 md:h-[595px] md:py-8 lg:py-10">
                        <img class="absolute inset-0 -z-20 h-full w-full object-cover" src="{{ $serviceHeroImage }}" alt="{{ $servicePage['title'] }}" fetchpriority="high" decoding="async">
                        <span class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(8,27,42,0.84)_0%,rgba(8,27,42,0.62)_44%,rgba(8,27,42,0.2)_100%)]"></span>
                        <div class="{{ $pageContentMax }} relative flex h-full items-center">
                            <div class="ml-10 lg:ml-20">
                                <div class="w-full max-w-[360px] text-left text-white md:max-w-[420px]">
                                    <h1 class="m-0 font-sans text-[32px] leading-[1.08] font-extrabold tracking-[-0.03em] text-white md:text-[40px] md:leading-[1.05]">{{ strtoupper($servicePage['title']) }}</h1>
                                    <p class="mt-3 font-sans text-[14px] leading-[1.6] font-normal text-white/90 md:text-[18px]">{{ $servicePage['hero_body'] ?? $servicePage['intro'] }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="service-detail-page-section {{ $pagePadX }} {{ $pageSectionTop }} pb-6 md:pb-8 lg:pb-10 bg-white">
                        <div class="{{ $pageContentMax }} service-detail-content-grid">
                            <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                <div class="grid gap-3">
                                    @foreach($servicePage['feature_copy'] ?? [] as $paragraph)
                                        <p class="m-0 font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $paragraph }}</p>
                                    @endforeach
                                </div>
                            </article>

                            <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                <div class="mx-auto w-full max-w-[840px] overflow-hidden rounded-[4px] border border-[#e3edf5] bg-white">
                                    <img class="mx-auto w-full object-contain" src="{{ $servicePage['feature_image'] ?? $serviceHeroImage }}" alt="{{ $servicePage['title'] }} illustration" loading="lazy" decoding="async">
                                </div>
                            </article>

                            @foreach($servicePage['sections'] as $section)
                                <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                    <h2 class="m-0 font-sans text-[24px] leading-[1.25] font-semibold text-[#00223A] md:text-[32px]">{{ $section['title'] }}</h2>

                                    @if(!empty($section['copy']))
                                        <p class="mt-3 mb-0 font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $section['copy'] }}</p>
                                    @endif

                                    @if(!empty($section['list']))
                                        <ul class="mt-3 grid list-disc gap-2 pl-[1.2em] marker:text-[#495057] md:gap-[0.35rem] lg:mt-4 lg:gap-[0.45rem]">
                                            @foreach($section['list'] as $item)
                                                <li class="font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]"><span>{{ $item }}</span></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if(!empty($section['copy_blocks']))
                                        <div class="mt-3 grid gap-4 lg:mt-4 lg:gap-5">
                                            @foreach($section['copy_blocks'] as $block)
                                                <div>
                                                    <h3 class="m-0 font-sans text-[20px] leading-[1.3] font-semibold text-[#00223A] md:text-[24px]">{{ $block['heading'] }}</h3>
                                                    <p class="mt-2 mb-0 font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $block['body'] }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </article>
                            @endforeach
                        </div>
                    </section>
                @elseif($customLayout === 'hysterectomy')
                    <section class="service-detail-page-section service-detail-page-hero relative isolate h-[351px] overflow-hidden {{ $pagePadX }} py-6 md:h-[595px] md:py-8 lg:py-10">
                        <img class="absolute inset-0 -z-20 h-full w-full object-cover" src="{{ $serviceHeroImage }}" alt="{{ $servicePage['title'] }}" fetchpriority="high" decoding="async">
                        <span class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(8,27,42,0.84)_0%,rgba(8,27,42,0.62)_44%,rgba(8,27,42,0.2)_100%)]"></span>
                        <div class="{{ $pageContentMax }} relative flex h-full items-center">
                            <div class="ml-10 lg:ml-20">
                                <div class="w-full max-w-[390px] text-left text-white md:max-w-[470px]">
                                    <h1 class="m-0 font-sans text-[32px] leading-[1.08] font-extrabold tracking-[-0.03em] text-white md:text-[40px] md:leading-[1.05]">{{ strtoupper($servicePage['title']) }}</h1>
                                    <p class="mt-3 font-sans text-[14px] leading-[1.6] font-normal text-white/90 md:text-[18px]">{{ $servicePage['hero_body'] ?? $servicePage['intro'] }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="service-detail-page-section {{ $pagePadX }} {{ $pageSectionTop }} pb-6 md:pb-8 lg:pb-10 bg-white">
                        <div class="{{ $pageContentMax }} service-detail-content-grid">
                            <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                <h2 class="m-0 font-sans text-[24px] leading-[1.25] font-semibold text-[#00223A] md:text-[32px]">{{ $servicePage['overview_title'] }}</h2>
                                <ul class="mt-3 grid list-disc gap-2 pl-[1.2em] marker:text-[#495057] md:gap-[0.35rem] lg:mt-4 lg:gap-[0.45rem]">
                                    @foreach($servicePage['overview'] as $item)
                                        <li class="font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]"><span>{{ $item }}</span></li>
                                    @endforeach
                                </ul>
                            </article>

                            @foreach($servicePage['sections'] as $section)
                                <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                    <h2 class="m-0 font-sans text-[24px] leading-[1.25] font-semibold text-[#00223A] md:text-[32px]">{{ $section['title'] }}</h2>
                                    <p class="mt-3 mb-0 font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $section['copy'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @elseif($customLayout === 'laparoscopy')
                    <section class="service-detail-page-section service-detail-page-hero relative isolate h-[351px] overflow-hidden {{ $pagePadX }} py-6 md:h-[595px] md:py-8 lg:py-10">
                        <img class="absolute inset-0 -z-20 h-full w-full object-cover" src="{{ $serviceHeroImage }}" alt="{{ $servicePage['title'] }}" fetchpriority="high" decoding="async">
                        <span class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(8,27,42,0.84)_0%,rgba(8,27,42,0.62)_44%,rgba(8,27,42,0.2)_100%)]"></span>
                        <div class="{{ $pageContentMax }} relative flex h-full items-center">
                            <div class="ml-10 lg:ml-20">
                                <div class="w-full max-w-[410px] text-left text-white md:max-w-[520px]">
                                    <h1 class="m-0 font-sans text-[32px] leading-[1.08] font-extrabold tracking-[-0.03em] text-white md:text-[40px] md:leading-[1.05]">{{ strtoupper($servicePage['title']) }}</h1>
                                    <p class="mt-3 font-sans text-[14px] leading-[1.6] font-normal text-white/90 md:text-[18px]">{{ $servicePage['hero_body'] ?? $servicePage['intro'] }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="service-detail-page-section {{ $pagePadX }} {{ $pageSectionTop }} pb-6 md:pb-8 lg:pb-10 bg-white">
                        <div class="{{ $pageContentMax }} service-detail-content-grid">
                            <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                <h2 class="m-0 font-sans text-[24px] leading-[1.25] font-semibold text-[#00223A] md:text-[32px]">{{ $servicePage['overview_title'] }}</h2>
                                <ul class="mt-3 grid list-disc gap-2 pl-[1.2em] marker:text-[#495057] md:gap-[0.35rem] lg:mt-4 lg:gap-[0.45rem]">
                                    @foreach($servicePage['overview'] as $item)
                                        <li class="font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]"><span>{{ $item }}</span></li>
                                    @endforeach
                                </ul>
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
                                </article>
                            @endforeach

                            @if(!empty($servicePage['gallery_images']))
                                <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                    <div class="grid gap-4 md:grid-cols-2 md:gap-6">
                                        @foreach($servicePage['gallery_images'] as $image)
                                            <div class="overflow-hidden rounded-[4px] border border-[#e3edf5] bg-white p-3 md:p-4">
                                                <img class="h-full w-full object-contain" src="{{ $image }}" alt="{{ $servicePage['title'] }} procedure illustration" loading="lazy" decoding="async">
                                            </div>
                                        @endforeach
                                    </div>
                                </article>
                            @endif
                        </div>
                    </section>
                @elseif($customLayout === 'myoma')
                    <section class="service-detail-page-section service-detail-page-hero relative isolate h-[351px] overflow-hidden {{ $pagePadX }} py-6 md:h-[595px] md:py-8 lg:py-10">
                        <img class="absolute inset-0 -z-20 h-full w-full object-cover" src="{{ $serviceHeroImage }}" alt="{{ $servicePage['title'] }}" fetchpriority="high" decoding="async">
                        <span class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(8,27,42,0.84)_0%,rgba(8,27,42,0.62)_44%,rgba(8,27,42,0.2)_100%)]"></span>
                        <div class="{{ $pageContentMax }} relative flex h-full items-center">
                            <div class="ml-10 lg:ml-20">
                                <div class="w-full max-w-[430px] text-left text-white md:max-w-[520px]">
                                    <h1 class="m-0 font-sans text-[32px] leading-[1.08] font-extrabold tracking-[-0.03em] text-white md:text-[40px] md:leading-[1.05]">{{ strtoupper($servicePage['title']) }}</h1>
                                    <p class="mt-3 font-sans text-[14px] leading-[1.6] font-normal text-white/90 md:text-[18px]">{{ $servicePage['hero_body'] ?? $servicePage['intro'] }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="service-detail-page-section {{ $pagePadX }} {{ $pageSectionTop }} pb-6 md:pb-8 lg:pb-10 bg-white">
                        <div class="{{ $pageContentMax }} service-detail-content-grid">
                            @if(!empty($servicePage['feature_copy']))
                                <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                    <div class="grid gap-3">
                                        @foreach($servicePage['feature_copy'] as $paragraph)
                                            <p class="m-0 font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $paragraph }}</p>
                                        @endforeach
                                    </div>
                                </article>
                            @endif

                            @if(!empty($servicePage['gallery_images']))
                                <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                    <div class="grid gap-4 md:grid-cols-3 md:gap-4">
                                        @foreach($servicePage['gallery_images'] as $image)
                                            <div class="overflow-hidden rounded-[4px] border border-[#e3edf5] bg-white p-3 md:p-4">
                                                <img class="h-full w-full object-contain" src="{{ $image }}" alt="{{ $servicePage['title'] }} illustration" loading="lazy" decoding="async">
                                            </div>
                                        @endforeach
                                    </div>
                                </article>
                            @endif

                            @foreach($servicePage['sections'] as $section)
                                <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                    <h2 class="m-0 font-sans text-[24px] leading-[1.25] font-semibold text-[#00223A] md:text-[32px]">{{ $section['title'] }}</h2>
                                    @if(!empty($section['copy']))
                                        <p class="mt-3 mb-0 font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $section['copy'] }}</p>
                                    @endif
                                    @if(!empty($section['list']))
                                        <ul class="mt-3 grid list-disc gap-2 pl-[1.2em] marker:text-[#495057] md:gap-[0.35rem] lg:mt-4 lg:gap-[0.45rem]">
                                            @foreach($section['list'] as $item)
                                                <li class="font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]"><span>{{ $item }}</span></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </article>
                            @endforeach
                        </div>
                    </section>
                @elseif($customLayout === 'ovarian-cyst')
                    <section class="service-detail-page-section service-detail-page-hero relative isolate h-[351px] overflow-hidden {{ $pagePadX }} py-6 md:h-[595px] md:py-8 lg:py-10">
                        <img class="absolute inset-0 -z-20 h-full w-full object-cover" src="{{ $serviceHeroImage }}" alt="{{ $servicePage['title'] }}" fetchpriority="high" decoding="async">
                        <span class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(8,27,42,0.84)_0%,rgba(8,27,42,0.62)_44%,rgba(8,27,42,0.2)_100%)]"></span>
                        <div class="{{ $pageContentMax }} relative flex h-full items-center">
                            <div class="ml-10 lg:ml-20">
                                <div class="w-full max-w-[430px] text-left text-white md:max-w-[540px]">
                                    <h1 class="m-0 font-sans text-[32px] leading-[1.08] font-extrabold tracking-[-0.03em] text-white md:text-[40px] md:leading-[1.05]">{{ strtoupper($servicePage['title']) }}</h1>
                                    <p class="mt-3 font-sans text-[14px] leading-[1.6] font-normal text-white/90 md:text-[18px]">{{ $servicePage['hero_body'] ?? $servicePage['intro'] }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="service-detail-page-section {{ $pagePadX }} {{ $pageSectionTop }} pb-6 md:pb-8 lg:pb-10 bg-white">
                        <div class="{{ $pageContentMax }} service-detail-content-grid">
                            <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                <h2 class="m-0 font-sans text-[24px] leading-[1.25] font-semibold text-[#00223A] md:text-[32px]">{{ $servicePage['overview_title'] }}</h2>
                                <ul class="mt-3 grid list-disc gap-2 pl-[1.2em] marker:text-[#495057] md:gap-[0.35rem] lg:mt-4 lg:gap-[0.45rem]">
                                    @foreach($servicePage['overview'] as $item)
                                        <li class="font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]"><span>{{ $item }}</span></li>
                                    @endforeach
                                </ul>
                            </article>

                            @if(!empty($servicePage['feature_images']))
                                <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                    <div class="grid gap-4 md:grid-cols-2 md:gap-6">
                                        @foreach($servicePage['feature_images'] as $image)
                                            <div class="overflow-hidden rounded-[4px] border border-[#e3edf5] bg-white p-3 md:p-4">
                                                <img class="h-full w-full object-contain" src="{{ $image }}" alt="{{ $servicePage['title'] }} illustration" loading="lazy" decoding="async">
                                            </div>
                                        @endforeach
                                    </div>
                                </article>
                            @endif

                            @foreach($servicePage['sections'] as $section)
                                <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                    <h2 class="m-0 font-sans text-[24px] leading-[1.25] font-semibold text-[#00223A] md:text-[32px]">{{ $section['title'] }}</h2>
                                    @if(!empty($section['copy']))
                                        <p class="mt-3 mb-0 font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $section['copy'] }}</p>
                                    @endif
                                    @if(!empty($section['copy_blocks']))
                                        <div class="mt-3 grid gap-4 lg:mt-4 lg:gap-5">
                                            @foreach($section['copy_blocks'] as $block)
                                                <div>
                                                    <h3 class="m-0 font-sans text-[20px] leading-[1.3] font-semibold text-[#00223A] md:text-[24px]">{{ $block['heading'] }}</h3>
                                                    <p class="mt-2 mb-0 font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $block['body'] }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </article>
                            @endforeach

                            @if(!empty($servicePage['gallery_images']))
                                <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                    <div class="grid gap-4 md:grid-cols-3 md:gap-4">
                                        @foreach($servicePage['gallery_images'] as $image)
                                            <div class="overflow-hidden rounded-[4px] border border-[#e3edf5] bg-white p-3 md:p-4">
                                                <img class="h-full w-full object-contain" src="{{ $image }}" alt="{{ $servicePage['title'] }} surgical image" loading="lazy" decoding="async">
                                            </div>
                                        @endforeach
                                    </div>
                                </article>
                            @endif
                        </div>
                    </section>
                @else
                    <section class="service-detail-page-section service-detail-page-hero relative isolate h-[351px] overflow-hidden {{ $pagePadX }} py-6 md:h-[595px] md:py-8 lg:py-12">
                        <img class="absolute inset-0 -z-20 h-full w-full object-cover" src="{{ $serviceHeroImage }}" alt="{{ $servicePage['title'] }}" fetchpriority="high" decoding="async">
                        <span class="absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(8,27,42,0.82)_0%,rgba(8,27,42,0.58)_46%,rgba(8,27,42,0.22)_100%)]"></span>
                        <div class="{{ $pageContentMax }} relative flex h-full items-center">
                            <div class="ml-10 lg:ml-20">
                                <div class="w-full text-left text-white md:max-w-[420px] lg:max-w-[520px]">
                                    <p class="mb-3 font-sans text-[24px] leading-[1.2] font-normal text-white/90 md:text-[32px]">{{ $servicePage['eyebrow'] }}</p>
                                    <h1 class="m-0 w-full font-sans text-[32px] leading-[1.08] font-extrabold tracking-[-0.03em] text-white md:text-[40px] md:leading-[1.05]">{{ strtoupper($servicePage['title']).$serviceHeroSuffix }}</h1>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="service-detail-page-section {{ $pagePadX }} {{ $pageSectionTop }} pb-6 md:pb-8 lg:pb-10 bg-white">
                        <div class="{{ $pageContentMax }} service-detail-content-grid">
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
                @endif
            </main>

            @include('partials.site-footer')
        </div>
    </div>
@endsection
