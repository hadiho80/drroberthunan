@php
    $seoTitle = $seoTitleDefault.' | '.$pageTitle;
    $seoDescription = $pageIntro;
    $structuredData = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Physician',
        'name' => $siteName,
        'description' => $pageIntro,
        'url' => url()->current(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $pagePadX = 'px-[10px] md:px-6 lg:px-16';
    $pageSectionTop = 'pt-[14px] md:pt-6 lg:pt-7';
    $pageContentMax = 'mx-auto w-full max-w-[860px]';
    $profilePhoto = $doctorProfileImage;
    $profileIntro = $doctorProfileIntro;
@endphp

@extends('layouts.site')

@section('content')
    <div class="site-page">
        <div class="page-shell">
            @include('partials.site-header')

            <main class="site-main">
                <section class="{{ $pagePadX }} {{ $pageSectionTop }} bg-white">
                    <div class="{{ $pageContentMax }} grid grid-cols-1 gap-[14px] md:grid-cols-[112px_minmax(0,1fr)] md:items-start md:gap-[18px] lg:grid-cols-[156px_minmax(0,1fr)] lg:gap-[24px]">
                        <div class="mx-auto w-[104px] overflow-hidden rounded-[4px] border border-[#d9e7f2] bg-[#f7fbff] md:mx-0 md:w-full">
                            <img class="h-[116px] w-full object-cover object-top md:h-[120px] lg:h-[158px]" src="{{ $profilePhoto }}" alt="{{ $doctorName }}">
                        </div>
                        <div class="md:pt-[2px]">
                            <p class="mb-[6px] text-[0.5rem] font-extrabold uppercase tracking-[0.12em] text-[#1971c2] md:mb-[8px] md:text-[0.56rem] lg:mb-[10px] lg:text-[0.72rem]">Doctor's Profile</p>
                            <h1 class="m-0 text-[0.82rem] leading-[1.12] font-extrabold tracking-[-0.03em] text-[#0e446a] md:text-[0.82rem] md:leading-[1.14] lg:text-[1.32rem] lg:leading-[1.1]">{{ $doctorName }}</h1>
                            <p class="mt-[6px] text-[0.52rem] leading-[1.45] font-semibold text-[#212529] md:text-[0.46rem] md:leading-[1.45] lg:mt-[8px] lg:text-[0.7rem] lg:leading-[1.48]">{{ $doctorSubtitle }}</p>
                            <p class="mt-[8px] text-[0.54rem] leading-[1.56] text-[#495057] md:mt-[8px] md:text-[0.46rem] md:leading-[1.62] lg:mt-[10px] lg:max-w-[540px] lg:text-[0.72rem] lg:leading-[1.72]">{{ $profileIntro }}</p>
                        </div>
                    </div>
                </section>

                <section class="{{ $pagePadX }} pt-[18px] pb-6 md:pt-[18px] md:pb-8 lg:pt-[22px] lg:pb-10 bg-white">
                    <div class="{{ $pageContentMax }} grid grid-cols-1 gap-[12px] md:gap-[12px] lg:gap-[14px]">
                        @foreach($profileSections as $section)
                            <article class="rounded-[3px] border border-[#d9e7f2] bg-white px-[12px] py-[10px] md:px-[14px] md:py-[12px] lg:px-[20px] lg:py-[16px]">
                                <h2 class="mb-[8px] text-[0.64rem] leading-[1.2] font-extrabold text-[#0e446a] md:mb-[8px] md:text-[0.5rem] lg:mb-[10px] lg:text-[0.82rem]">{{ $section['title'] }}</h2>
                                <div class="grid gap-[5px] text-[0.52rem] leading-[1.48] text-[#495057] md:gap-[5px] md:text-[0.45rem] md:leading-[1.55] lg:gap-[7px] lg:text-[0.7rem] lg:leading-[1.68]">
                                    @foreach($section['items'] as $item)
                                        <p class="m-0">{{ $item }}</p>
                                    @endforeach
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            </main>

            @include('partials.site-footer')
        </div>
    </div>
@endsection
