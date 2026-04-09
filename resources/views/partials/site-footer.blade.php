<footer class="site-footer">
    <div class="mx-auto w-full max-w-[1440px]">
        <div class="footer-main-grid grid grid-cols-2 gap-x-5 gap-y-5 md:grid-cols-[1.18fr_0.72fr_0.82fr] md:gap-x-[18px] md:gap-y-[18px] lg:grid-cols-[1.15fr_0.72fr_0.82fr_1.24fr] lg:gap-x-10 lg:gap-y-4">
            <div class="footer-brand-block col-span-2 gap-[10px] md:col-span-1 md:gap-[10px] lg:col-span-1 lg:gap-[14px]">
                <img class="footer-logo footer-logo-hospital w-[142px] md:w-[122px] lg:w-[160px]" src="{{ asset('assets/footer/national-hospital-footer.png') }}" alt="National Hospital logo">
                <img class="footer-logo footer-logo-scope w-[168px] md:w-[146px] lg:w-[182px]" src="{{ asset('assets/footer/nhscope-footer.png') }}" alt="NH Scope logo">
                <p class="max-w-[216px] text-[0.58rem] leading-[1.58] font-normal text-white/88 [font-family:'DM_Sans',sans-serif] md:max-w-[148px] md:text-[0.5rem] md:leading-[1.58] lg:max-w-[228px] lg:text-[0.64rem] lg:leading-[1.72]">{{ $contactAddress }}</p>
            </div>

            <div>
                <h3 class="mb-[10px] text-[0.66rem] font-extrabold text-white [font-family:'DM_Sans',sans-serif] md:mb-[8px] md:text-[0.56rem] lg:mb-3 lg:text-[0.68rem]">Quick Links</h3>
                <ul class="m-0 grid list-none gap-[8px] p-0 md:gap-[7px] lg:gap-[10px]">
                    <li><a class="text-[0.58rem] leading-[1.3] font-normal text-white/88 [font-family:'DM_Sans',sans-serif] transition-opacity hover:opacity-100 md:text-[0.5rem] lg:text-[0.64rem]" href="{{ route('site.home') }}">Home</a></li>
                    <li><a class="text-[0.58rem] leading-[1.3] font-normal text-white/88 [font-family:'DM_Sans',sans-serif] transition-opacity hover:opacity-100 md:text-[0.5rem] lg:text-[0.64rem]" href="{{ route('site.profile') }}">Doctor's Profile</a></li>
                    <li><a class="text-[0.58rem] leading-[1.3] font-normal text-white/88 [font-family:'DM_Sans',sans-serif] transition-opacity hover:opacity-100 md:text-[0.5rem] lg:text-[0.64rem]" href="https://national-hospital.com/id/mitra/mitra-asuransi?t=1774324454" target="_blank" rel="noreferrer">Insurance</a></li>
                    <li><a class="text-[0.58rem] leading-[1.3] font-normal text-white/88 [font-family:'DM_Sans',sans-serif] transition-opacity hover:opacity-100 md:text-[0.5rem] lg:text-[0.64rem]" href="{{ route('site.contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <div>
                <h3 class="mb-[10px] text-[0.66rem] font-extrabold text-white [font-family:'DM_Sans',sans-serif] md:mb-[8px] md:text-[0.56rem] lg:mb-3 lg:text-[0.68rem]">Services</h3>
                <ul class="m-0 grid list-none gap-[8px] p-0 md:gap-[7px] lg:gap-[10px]">
                    @foreach($serviceMenuItems as $item)
                        <li><a class="text-[0.58rem] leading-[1.3] font-normal text-white/88 [font-family:'DM_Sans',sans-serif] transition-opacity hover:opacity-100 md:text-[0.5rem] lg:text-[0.64rem]" href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer-contact-block col-span-2 gap-[10px] md:col-span-3 md:gap-[8px] lg:col-span-1 lg:gap-[10px]">
                <h3 class="mb-0 text-[0.66rem] font-extrabold text-white [font-family:'DM_Sans',sans-serif] md:text-[0.56rem] lg:text-[0.68rem]">Contact Us</h3>
                <p class="footer-doctor-line max-w-[240px] text-[0.58rem] leading-[1.5] font-semibold text-white [font-family:'DM_Sans',sans-serif] md:max-w-none md:text-[0.52rem] lg:max-w-[250px] lg:text-[0.62rem] lg:leading-[1.58]">dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS Schedule</p>
                <ul class="m-0 grid gap-0 p-0 list-none">
                    <li class="footer-schedule-row border-b border-white/16 py-[6px] md:py-[5px] lg:py-[6px]"><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">Monday</span><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">17:00 - 20:00</span></li>
                    <li class="footer-schedule-row border-b border-white/16 py-[6px] md:py-[5px] lg:py-[6px]"><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">Tuesday</span><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">09:00 - 12:00</span></li>
                    <li class="footer-schedule-row border-b border-white/16 py-[6px] md:py-[5px] lg:py-[6px]"><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">Wednesday</span><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">17:00 - 20:00</span></li>
                    <li class="footer-schedule-row border-b border-white/16 py-[6px] md:py-[5px] lg:py-[6px]"><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">Thursday</span><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">09:00 - 12:00</span></li>
                    <li class="footer-schedule-row border-b border-white/16 py-[6px] md:py-[5px] lg:py-[6px]"><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">Friday</span><span class="text-[0.58rem] text-right text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">09:00 - 12:00 / 17:00 - 20:00</span></li>
                    <li class="footer-schedule-row py-[6px] md:py-[5px] lg:py-[6px]"><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">Sunday</span><span class="text-[0.58rem] text-white/88 [font-family:'DM_Sans',sans-serif] md:text-[0.5rem] lg:text-[0.64rem]">09:00 - 13:00</span></li>
                </ul>
                <div class="footer-ask-row mt-1 gap-[10px]">
                    <span class="text-[0.6rem] font-semibold text-white [font-family:'DM_Sans',sans-serif] md:text-[0.52rem] lg:text-[0.64rem]">Ask Me A Question:</span>
                    <a href="mailto:{{ $contactEmail }}" aria-label="Email">
                        <span class="footer-icon-button">
                            <img class="footer-contact-icon footer-contact-icon-mail" src="{{ asset('assets/footer/icon-mail.png') }}" alt="">
                        </span>
                    </a>
                    <a href="{{ $whatsAppLink }}" target="_blank" rel="noreferrer" aria-label="WhatsApp">
                        <span class="footer-icon-button">
                            <img class="footer-contact-icon footer-contact-icon-wa" src="{{ asset('assets/footer/icon-wa.png') }}" alt="">
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
