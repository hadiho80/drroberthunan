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
    $pagePadX = 'px-4 md:px-6 lg:px-10';
    $pageHeroMax = 'mx-auto w-full max-w-[1100px]';
    $pageContentMax = 'mx-auto w-full max-w-[1100px]';
    $profilePhoto = $doctorProfileImage;
    $profileIntro = $doctorProfileIntro;
@endphp

@extends('layouts.site')

@section('content')
    <div class="site-page">
        <div class="page-shell">
            @include('partials.site-header')

            <main class="site-main">
                <section class="{{ $pagePadX }} bg-[#eef6fc] py-7 md:py-10 lg:py-12">
                    <div class="{{ $pageHeroMax }} grid grid-cols-1 items-center gap-6 md:grid-cols-[240px_minmax(0,1fr)] md:gap-8 lg:grid-cols-[340px_minmax(0,1fr)] lg:gap-14">
                        <div class="mx-auto w-full max-w-[220px] overflow-hidden rounded-[10px] bg-[#dcecf7] shadow-[0_10px_24px_rgba(14,68,106,0.08)] md:max-w-none">
                            <img class="h-[264px] w-full object-cover object-top md:h-[300px] lg:h-[360px]" src="{{ $profilePhoto }}" alt="{{ $doctorName }}">
                        </div>
                        <div class="text-[#24435a]">
                            <h1 class="m-0 font-sans text-[32px] leading-[1.08] font-extrabold tracking-[-0.03em] text-[#0E446A] md:text-[40px] md:leading-[1.05] lg:max-w-[540px]">{{ $doctorName }}</h1>
                            <h3 class="mt-4 max-w-[650px] font-sans text-[24px] leading-[1.45] font-medium text-[#00223A] md:text-[32px] md:leading-[1.4]">{{ $profileIntro }}</h3>
                        </div>
                    </div>
                </section>

                <section class="{{ $pagePadX }} bg-white py-7 md:py-9 lg:py-12">
                    <div class="{{ $pageContentMax }} grid grid-cols-1 gap-4 md:gap-5 lg:gap-6">
                        @foreach($profileSections as $section)
                            <article class="rounded-[6px] border border-[#d9e7f2] bg-white px-4 py-4 shadow-[0_6px_18px_rgba(14,68,106,0.04)] md:px-5 md:py-5 lg:px-8 lg:py-6">
                                <h2 class="m-0 font-sans text-[24px] leading-[1.25] font-semibold text-[#00223A] md:text-[32px]">{{ $section['title'] }}</h2>

                                @if(!empty($section['intro']))
                                    <p class="mt-3 mb-0 font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]">{{ $section['intro'] }}</p>
                                @endif

                                <ul class="mt-3 list-disc pl-[1.2em] grid gap-2 marker:text-[#495057] md:gap-[0.35rem] lg:mt-4 lg:gap-[0.45rem]">
                                    @foreach($section['items'] as $item)
                                        <li class="font-sans text-[14px] leading-[1.65] font-normal text-[#495057] md:text-[18px]"><span>{{ $item }}</span></li>
                                    @endforeach
                                </ul>
                            </article>
                        @endforeach
                    </div>
                </section>
            </main>

            @include('partials.site-footer')
        </div>
    </div>
@endsection
