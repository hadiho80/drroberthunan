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
            'image' => asset('assets/highlights/obstetrics.png'),
        ],
        [
            'title' => 'Gynecology',
            'url' => route('site.service.show', 'gynaecology'),
            'image' => asset('assets/highlights/gynecology.png'),
        ],
        [
            'title' => 'Minimally invasive surgery',
            'url' => route('site.service.show', 'minimally-invasive-surgery'),
            'image' => asset('assets/highlights/minimally-invasive-surgery.png'),
        ],
        [
            'title' => 'NHScope',
            'url' => route('site.profile'),
            'image' => asset('assets/highlights/nhscope.png'),
        ],
        [
            'title' => 'Laparoscopy',
            'url' => route('site.service.show', 'laparoscopy'),
            'image' => asset('assets/highlights/laparoscopy.png'),
        ],
        [
            'title' => 'Myoma',
            'url' => route('site.service.show', 'myoma'),
            'image' => asset('assets/highlights/myoma.png'),
        ],
        [
            'title' => 'Endometriosis',
            'url' => route('site.service.show', 'endometriosis'),
            'image' => asset('assets/highlights/endometriosis.png'),
        ],
        [
            'title' => 'Ovarian cyst',
            'url' => route('site.service.show', 'ovarian-cyst'),
            'image' => asset('assets/highlights/ovarian-cyst.png'),
        ],
        [
            'title' => 'Hysterectomy',
            'url' => route('site.service.show', 'hysterectomy'),
            'image' => asset('assets/highlights/hysterectomy.png'),
        ],
    ];
    $homeSectionPadX = 'px-[10px] md:px-[22px] lg:px-16';
    $homeSectionPadTop = 'pt-6 md:pt-8 lg:pt-10';
    $homeSectionPadBottom = 'pb-6 md:pb-8 lg:pb-10';
    $homeSectionClass = $homeSectionPadX.' '.$homeSectionPadTop.' '.$homeSectionPadBottom.' bg-white';
    $homeContentMax = 'mx-auto w-full max-w-[1090px]';
    $sectionTitleClass = "mb-4 text-center text-[0.78rem] leading-[1.12] font-extrabold text-[#0E446A] [font-family:'DM_Sans',sans-serif] md:mb-[18px] md:text-[1.12rem] md:leading-[1.08] lg:mb-[22px] lg:text-[1.85rem] lg:leading-[1.08]";
    $sectionTitleLeftClass = "mb-4 text-left text-[0.78rem] leading-[1.12] font-extrabold text-[#0E446A] [font-family:'DM_Sans',sans-serif] md:mb-[18px] md:text-[1.12rem] md:leading-[1.08] lg:mb-[22px] lg:text-[1.85rem] lg:leading-[1.08]";
    $sectionSubtitleClass = "m-0 text-[0.72rem] leading-[1.26] font-semibold text-[#00223A] [font-family:'DM_Sans',sans-serif] md:text-[0.68rem] md:leading-[1.22] lg:text-[0.82rem] lg:leading-[1.28]";
    $sectionBodyClass = "m-0 text-[0.54rem] leading-[1.62] font-normal text-[#495057] [font-family:'DM_Sans',sans-serif] md:text-[0.58rem] md:leading-[1.62] lg:text-[0.7rem] lg:leading-[1.72]";
    $contactFieldClass = "w-full rounded-[3px] border border-[var(--site-line)] bg-white px-2 py-[6px] text-[0.56rem] font-normal text-[#495057] [font-family:'DM_Sans',sans-serif] placeholder:text-[#495057] md:rounded-[4px] md:px-[9px] md:py-2 md:text-[0.66rem] lg:px-[10px] lg:py-2 lg:text-[0.82rem]";
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
                                <a href="{{ route('site.services') }}" class="button-primary">How We Can Help</a>
                            </div>
                        </div>
                        <div class="home-hero-visual">
                            <div class="hero-logo-card hero-logo-card-scope">
                                <img src="{{ asset('assets/branding/nhscope-logo-dark.png') }}" alt="NH Scope">
                            </div>
                            <div class="hero-logo-card hero-logo-card-hospital">
                                <img src="{{ asset('assets/branding/national-hospital-logo.png') }}" alt="National Hospital">
                            </div>
                            <div class="home-hero-image">
                                <img src="{{ asset('assets/hero/doctor.png') }}" alt="{{ $siteName }}">
                            </div>
                        </div>
                    </div>
                </section>

                <section class="doctor-intro-section">
                    <div class="doctor-intro-inner {{ $homeContentMax }}">
                        <div class="doctor-intro-photo">
                            <img src="{{ asset('assets/hero/doctor.png') }}" alt="{{ $doctorName }}">
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

                <section class="{{ $homeSectionPadX }} {{ $homeSectionPadTop }} {{ $homeSectionPadBottom }} bg-white">
                    <div class="{{ $homeContentMax }} grid grid-cols-1 gap-[14px] md:grid-cols-[minmax(0,240px)_minmax(0,1fr)] md:items-center md:gap-[20px] lg:grid-cols-[minmax(280px,430px)_minmax(300px,500px)] lg:justify-center lg:gap-9">
                        <article class="grid content-start gap-3 md:gap-[12px] lg:gap-[18px]">
                            <h2 class="{{ $sectionSubtitleClass }} md:text-[0.96rem] md:leading-[1.12] lg:text-[1.9rem] lg:leading-[1.08]">About NH Scope</h2>
                            <p class="{{ $sectionBodyClass }} md:text-[0.62rem] md:leading-[1.62] lg:text-[0.86rem] lg:leading-[1.7]">NH scope is a group of compassionate doctors, focus on endoscopic surgery. We are a team with various expertise : gynaecology, digestive surgery, urology, otorinolaringology and orthopedic surgeon.</p>
                            <p class="{{ $sectionBodyClass }} md:text-[0.62rem] md:leading-[1.62] lg:text-[0.86rem] lg:leading-[1.7]">TOGETHER WE CAN and we will provide the best treatment at National Hospital Surabaya</p>
                            <a href="{{ route('site.profile') }}" class="button-primary w-fit justify-self-start min-h-[24px] px-[10px] text-[0.5rem] md:min-h-[26px] md:px-[12px] md:text-[0.5rem] lg:min-h-[34px] lg:px-4 lg:text-[0.72rem]">Find Out More</a>
                        </article>
                        <article class="w-full min-h-[172px] overflow-hidden rounded-[12px] md:min-h-[206px] md:rounded-[10px] lg:max-w-[500px] lg:min-h-[278px] lg:justify-self-start lg:rounded-[14px]">
                            <img class="h-full w-full object-cover object-center" src="{{ asset('assets/hero/about-nh-scope.png') }}" alt="NH Scope doctors">
                        </article>
                    </div>
                </section>

                <section class="{{ $homeSectionClass }}">
                    <h2 class="{{ $sectionTitleClass }}">Our Services</h2>
                    <div class="{{ $homeContentMax }} grid max-w-[286px] grid-cols-1 gap-[14px] md:max-w-full md:grid-cols-1 md:gap-[12px] lg:grid-cols-3 lg:gap-[18px]">
                        @foreach($serviceCards as $item)
                            <a href="{{ $item['url'] }}" class="grid min-h-[100px] content-start gap-[8px] rounded-[5px] border border-[#D3E2EE] bg-white px-[13px] pt-[12px] pb-[12px] shadow-[0_4px_12px_rgba(14,68,106,0.06)] transition-transform duration-200 ease-out hover:-translate-y-0.5 hover:border-[#B8D0E2] hover:shadow-[0_12px_24px_rgba(14,68,106,0.1)] md:min-h-[90px] md:px-[14px] md:pt-[14px] md:pb-[14px] lg:min-h-[144px] lg:gap-[12px] lg:rounded-[4px] lg:px-[14px] lg:pt-[15px] lg:pb-[16px]">
                                <span class="mb-0 inline-flex h-6 w-6 items-center justify-start bg-transparent md:mb-[2px] md:h-[22px] md:w-[22px] lg:mb-0 lg:h-[24px] lg:w-[24px]" aria-hidden="true">
                                    <img class="h-[22px] w-[22px] object-contain md:h-[18px] md:w-[18px] lg:h-[18px] lg:w-[18px]" src="{{ $item['icon'] }}" alt="">
                                </span>
                                <h3 class="{{ $sectionSubtitleClass }}">{{ $item['label'] }}</h3>
                                <p class="{{ $sectionBodyClass }} md:max-w-[320px] md:text-[0.52rem] md:leading-[1.62]">{{ $item['copy'] }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="{{ $homeSectionClass }}">
                    <h2 class="{{ $sectionTitleClass }}">Highlights</h2>
                    <div class="{{ $homeContentMax }} grid max-w-[286px] grid-cols-1 overflow-hidden rounded-[12px] md:max-w-full md:grid-cols-3 lg:rounded-[10px]">
                        @foreach($highlightItems as $item)
                            <a href="{{ $item['url'] }}" class="relative flex min-h-[120px] items-end justify-center overflow-hidden px-2 py-[10px] text-center text-[0.68rem] text-white md:min-h-[136px] md:px-[10px] md:py-3 md:text-[0.82rem] lg:min-h-[152px] lg:px-[12px] lg:py-3 lg:text-[0.82rem]">
                                <img class="absolute inset-0 h-full w-full object-cover" src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                                <span class="absolute inset-0 bg-[linear-gradient(180deg,rgba(14,68,106,0.08)_0%,rgba(14,68,106,0.46)_100%)]"></span>
                                <span class="relative max-w-[90%] font-bold [font-family:'DM_Sans',sans-serif] leading-[1.2] [text-shadow:0_2px_10px_rgba(8,30,48,0.28)]">{{ $item['title'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="{{ $homeSectionClass }}">
                    <div class="{{ $homeContentMax }} max-w-[286px] overflow-hidden rounded-[12px] md:max-w-full lg:rounded-[6px]">
                        <img class="block w-full aspect-[335/177] object-cover [filter:contrast(1.03)_saturate(1.04)]" src="{{ asset('assets/highlights/highlight-bottom.png') }}" alt="NH Scope highlight">
                    </div>
                </section>

                <section class="{{ $homeSectionPadX }} {{ $homeSectionPadTop }} {{ $homeSectionPadBottom }} bg-[#eef7ff]">
                    <div class="{{ $homeContentMax }} max-w-[286px] bg-[#eef7ff] md:max-w-full">
                        <h2 class="{{ $sectionTitleLeftClass }}">Contact Us</h2>
                        <div class="grid grid-cols-1 gap-4 md:gap-5 lg:grid-cols-[minmax(0,1fr)_244px] lg:items-start lg:gap-[30px]">
                            <form class="grid gap-[8px] md:gap-[10px] lg:gap-3" action="#">
                                <input class="{{ $contactFieldClass }}" type="text" placeholder="Name *">
                                <input class="{{ $contactFieldClass }}" type="text" placeholder="Phone No. *">
                                <input class="{{ $contactFieldClass }}" type="email" placeholder="Email *">
                                <textarea class="{{ $contactFieldClass }} min-h-[120px] resize-none md:min-h-[160px] lg:min-h-[92px]" rows="6" placeholder="Message"></textarea>
                                <div>
                                    <button type="submit" class="button-primary min-h-[30px] min-w-[102px] px-3 text-[0.58rem] md:min-h-[36px] md:min-w-[140px] md:px-[18px] md:text-[0.76rem] lg:min-h-[36px] lg:min-w-[142px] lg:px-[18px] lg:text-[0.82rem]">Send An Enquiry</button>
                                </div>
                            </form>
                            <div class="overflow-hidden rounded-[12px] md:rounded-[14px] lg:rounded-[10px]">
                                <img class="block w-full aspect-[1/0.82] object-cover md:aspect-[1/0.74] lg:aspect-[1/1.08]" src="{{ asset('assets/contact/contact-us-home.png') }}" alt="National Hospital building">
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            @include('partials.site-footer')
        </div>

        <a href="{{ $whatsAppLink }}" class="floating-whatsapp" target="_blank" rel="noreferrer" aria-label="Chat via WhatsApp">
            <img src="{{ asset('assets/footer/icon-wa.png') }}" alt="">
            <span>WhatsApp</span>
        </a>
    </div>
@endsection
