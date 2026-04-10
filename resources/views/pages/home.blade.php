@php
    $seoTitle = $seoTitleDefault;
    $seoDescription = $seoDescriptionDefault;
    $structuredData = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Physician',
        'name' => $siteName,
        'description' => $seoDescription,
        'url' => url('/'),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $serviceCards = [
        [
            'label' => 'Obstetrics',
            'url' => route('site.service.show', 'obstetrics'),
            'icon' => asset('assets/services/obstetrics-icon.png'),
            'copy' => 'Comprehensive pregnancy care, antenatal check-ups, and delivery planning with a gentle, evidence-based approach.',
        ],
        [
            'label' => 'Gynaecology',
            'url' => route('site.service.show', 'gynaecology'),
            'icon' => asset('assets/services/gynaecology-icon.png'),
            'copy' => 'Assessment and treatment for women\'s health concerns, from routine reviews to more complex gynecologic conditions.',
        ],
        [
            'label' => 'Minimally Invasive Surgery',
            'url' => route('site.service.show', 'minimally-invasive-surgery'),
            'icon' => asset('assets/services/minimally-invasive-surgery-icon.png'),
            'copy' => 'Advanced laparoscopic procedures designed for precision, smaller incisions, and a more comfortable recovery.',
        ],
    ];
    $highlightItems = [
        [
            'title' => 'Obstetrics',
            'url' => route('site.service.show', 'obstetrics'),
            'image' => asset('assets/highlights/obstetrics-latest.jpg'),
        ],
        [
            'title' => 'Gynecology',
            'url' => route('site.service.show', 'gynaecology'),
            'image' => asset('assets/highlights/gynaecology-latest.jpg'),
        ],
        [
            'title' => 'Minimally invasive surgery',
            'url' => route('site.service.show', 'minimally-invasive-surgery'),
            'image' => asset('assets/highlights/minimally-invasive-surgery-latest.png'),
        ],
        [
            'title' => 'NHScope',
            'url' => 'https://drive.google.com/file/d/1YCi7xpGNYxXPTS3yY91W1FJXyJW09xBF/view?usp=sharing',
            'image' => asset('assets/highlights/nhscope-latest.jpg'),
        ],
        [
            'title' => 'Laparoscopy',
            'url' => route('site.service.show', 'laparoscopy'),
            'image' => asset('assets/highlights/laparoscopy-latest.png'),
        ],
        [
            'title' => 'Myoma',
            'url' => route('site.service.show', 'myoma'),
            'image' => asset('assets/highlights/myoma-latest.jpg'),
        ],
        [
            'title' => 'Endometriosis',
            'url' => route('site.service.show', 'endometriosis'),
            'image' => asset('assets/highlights/endometriosis-latest.jpg'),
        ],
        [
            'title' => 'Ovarian cyst',
            'url' => route('site.service.show', 'ovarian-cyst'),
            'image' => asset('assets/highlights/ovarian-cyst-latest.jpg'),
        ],
        [
            'title' => 'Hysterectomy',
            'url' => route('site.service.show', 'hysterectomy'),
            'image' => asset('assets/highlights/hysterectomy-latest.jpg'),
        ],
    ];
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
                    <div class="home-hero-background"></div>
                    <div class="home-hero-layout {{ $homeContentMax }}">
                        <div class="home-hero-copy">
                            <h1>Tailored Care for Your Unique Journey</h1>
                            <p>Committed to excellence, we combine compassionate, evidence-based treatments with the highest safety standards, ensuring gentle and effective care.</p>
                            <div class="hero-actions">
                                <a href="#contact-section" class="button-primary">How We Can Help</a>
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
                                <img src="{{ asset('assets/hero/doctor.png') }}" alt="{{ $siteName }}" fetchpriority="high" decoding="async">
                            </div>
                        </div>
                    </div>
                </section>

                <section class="doctor-intro-section">
                    <div class="doctor-intro-inner {{ $homeContentMax }}">
                        <div class="doctor-intro-photo">
                            <img src="{{ asset('assets/hero/meet-doctor-intro.jpg') }}" alt="{{ $doctorName }}" loading="lazy" decoding="async">
                        </div>
                        <div class="doctor-intro-copy">
                            <h2>Meet dr. Robert Hunan Purwaka, Sp.OG, D.MAS, F.MIS</h2>
                            <p>dr. Robert Hunan is an Obstetrician-gynecologist, specialized in Laparoscopic Surgery and Aesthetic Gynaecology. He currently practices at National Hospital Surabaya, and also member of NHScope.</p>
                            <p>Until now, dr. Robert has handled more than 1,200 laparoscopic cases.</p>
                            <div class="hero-actions">
                                <a href="{{ route('site.profile') }}" class="button-primary">Learn more about dr. Robert</a>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="about-nh-section {{ $homeSectionPadX }} {{ $homeSectionPadTop }} {{ $homeSectionPadBottom }} bg-white">
                    <div class="about-nh-grid {{ $homeContentMax }} grid grid-cols-1 gap-[14px] md:grid-cols-[minmax(0,240px)_minmax(0,1fr)] md:items-center md:gap-[20px] lg:grid-cols-[minmax(320px,470px)_minmax(360px,1fr)] lg:justify-center lg:gap-12">
                        <article class="about-nh-copy grid content-start gap-3 md:gap-[12px] lg:gap-[18px]">
                            <h2 class="{{ $sectionSubtitleClass }} md:text-[1.02rem] md:leading-[1.16] lg:text-[2.2rem] lg:leading-[1.08]">About NH Scope</h2>
                            <p class="{{ $sectionBodyClass }} md:text-[0.76rem] md:leading-[1.68] lg:text-[0.96rem] lg:leading-[1.76]">NH scope is a group of compassionate doctors, focus on endoscopic surgery. We are a team with various expertise : gynaecology, digestive surgery, urology, otorinolaringology and orthopedic surgeon.</p>
                            <p class="{{ $sectionBodyClass }} md:text-[0.76rem] md:leading-[1.68] lg:text-[0.96rem] lg:leading-[1.76]">TOGETHER WE CAN and we will provide the best treatment at National Hospital Surabaya</p>
                            <a href="https://drive.google.com/file/d/1YCi7xpGNYxXPTS3yY91W1FJXyJW09xBF/view?usp=sharing" class="button-primary w-fit justify-self-start min-h-[24px] px-[10px] text-[0.5rem] md:min-h-[36px] md:px-[18px] md:text-[0.78rem] lg:min-h-[46px] lg:px-5 lg:text-[0.9rem]">Find Out More</a>
                        </article>
                        <article class="about-nh-media w-full min-h-[172px] overflow-hidden rounded-[12px] md:min-h-[206px] md:rounded-[10px] lg:max-w-[560px] lg:min-h-[320px] lg:justify-self-start lg:rounded-[16px]">
                            <img class="h-full w-full object-cover object-center" src="{{ asset('assets/hero/about-nh-scope.png') }}" alt="NH Scope doctors" loading="lazy" decoding="async">
                        </article>
                    </div>
                </section>

                <section class="our-service-section {{ $homeSectionClass }}">
                    <h2 class="{{ $sectionTitleClass }}">Our Services</h2>
                    <div class="{{ $homeContentMax }} grid max-w-[286px] grid-cols-1 gap-[14px] md:max-w-full md:grid-cols-1 md:gap-[12px] lg:grid-cols-3 lg:gap-6">
                        @foreach($serviceCards as $item)
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
                    <h2 class="{{ $sectionTitleClass }}">Highlights</h2>
                    <div class="{{ $homeContentMax }} grid max-w-[286px] grid-cols-1 overflow-hidden rounded-[12px] md:max-w-full md:grid-cols-3 lg:rounded-[14px]">
                        @foreach($highlightItems as $item)
                            <a href="{{ $item['url'] }}" class="relative flex min-h-[120px] items-end justify-center overflow-hidden px-2 py-[10px] text-center text-[0.68rem] text-white md:min-h-[136px] md:px-[10px] md:py-3 md:text-[0.96rem] lg:min-h-[188px] lg:px-4 lg:py-4 lg:text-[1rem]">
                                <img class="absolute inset-0 h-full w-full object-cover" src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy" decoding="async">
                                <span class="absolute inset-0 bg-[linear-gradient(180deg,rgba(14,68,106,0.08)_0%,rgba(14,68,106,0.46)_100%)]"></span>
                                <span class="relative max-w-[90%] font-bold [font-family:'DM_Sans',sans-serif] leading-[1.2] [text-shadow:0_2px_10px_rgba(8,30,48,0.28)]">{{ $item['title'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="highlight-bottom-section {{ $homeSectionPadTop }} {{ $homeSectionPadBottom }} bg-white">
                    <div class="{{ $homeContentMax }} max-w-[286px] overflow-hidden rounded-[12px] md:max-w-full lg:rounded-[10px]">
                        <img class="block w-full aspect-[335/177] object-cover [filter:contrast(1.03)_saturate(1.04)]" src="{{ asset('assets/highlights/highlight-bottom.png') }}" alt="NH Scope highlight" loading="lazy" decoding="async">
                    </div>
                </section>

                <section id="contact-section" class="contact-section {{ $homeSectionPadTop }} {{ $homeSectionPadBottom }} bg-[#eef7ff]">
                    <div class="{{ $homeContentMax }} max-w-[286px] bg-[#eef7ff] md:max-w-full">
                        <h2 class="{{ $sectionTitleLeftClass }}">Contact Us</h2>
                        @if(session('enquiry_status'))
                            <div class="mb-4 rounded-[6px] border border-[#b8d6ea] bg-white px-4 py-3 font-sans text-[14px] leading-[1.6] font-medium text-[#0E446A] md:mb-5 md:text-[16px]">
                                {{ session('enquiry_status') }}
                            </div>
                        @endif
                        <div class="grid grid-cols-1 gap-4 md:gap-5 lg:grid-cols-[minmax(0,1fr)_320px] lg:items-start lg:gap-10">
                            <form class="grid gap-[8px] md:gap-[12px] lg:gap-4" action="{{ route('site.enquiry.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="source" value="home page">
                                <input class="{{ $contactFieldClass }}" type="text" name="name" placeholder="Name *" required>
                                <input class="{{ $contactFieldClass }}" type="text" name="phone" placeholder="Phone No. *" required>
                                <input class="{{ $contactFieldClass }}" type="email" name="email" placeholder="Email *" required>
                                <textarea class="{{ $contactFieldClass }} min-h-[120px] resize-none md:min-h-[160px] lg:min-h-[128px]" rows="6" name="message" placeholder="Message"></textarea>
                                <div>
                                    <button type="submit" class="button-primary min-h-[30px] min-w-[102px] px-3 text-[0.58rem] md:min-h-[40px] md:min-w-[160px] md:px-[20px] md:text-[0.82rem] lg:min-h-[48px] lg:min-w-[188px] lg:px-[22px] lg:text-[0.92rem]">Send An Enquiry</button>
                                </div>
                            </form>
                            <div class="overflow-hidden rounded-[12px] md:rounded-[14px] lg:rounded-[14px]">
                                <img class="block w-full aspect-[1/0.82] object-cover md:aspect-[1/0.74] lg:aspect-[1/1.08]" src="{{ asset('assets/contact/contact-us-home.png') }}" alt="National Hospital building" loading="lazy" decoding="async">
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            @include('partials.site-footer')
        </div>

    </div>
@endsection
