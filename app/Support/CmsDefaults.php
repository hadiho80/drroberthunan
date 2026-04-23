<?php

namespace App\Support;

class CmsDefaults
{
    public static function siteSettings(): array
    {
        return [
            'site_name' => 'Dr. Robert Hunan',
            'seo_title_default' => 'Dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS | Obstetrics, Gynecology, and Minimally Invasive Surgery in Surabaya',
            'seo_description_default' => 'Official website of dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS, obstetrician and gynecologist in Surabaya with women\'s health services, laparoscopy, minimally invasive surgery, and appointment information.',
            'seo_keywords' => 'dr robert hunan, robert hunan, dr robert hunan purwaka, dokter kandungan surabaya, obstetrician surabaya, gynecologist surabaya, laparoscopy surabaya, minimally invasive surgery surabaya, women health surabaya',
            'seo_image' => 'assets/hero/doctor.png',
            'seo_og_locale' => 'en_US',
            'seo_lang' => 'en',
            'doctor_name' => 'dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS',
            'doctor_subtitle' => 'Obstetrician & Gynecologist',
            'clinic_name' => 'National Hospital Surabaya',
            'clinic_department' => 'NH Scope',
            'contact_phone' => '+628121043450',
            'contact_email' => 'roberthunan@gmail.com',
            'contact_address' => 'Jl. Boulevard Famili Sel No.Kav. 1 Babatan, Kec. Wiyung, Surabaya, Jawa Timur 60227',
            'contact_city' => 'Surabaya',
            'contact_region' => 'Jawa Timur',
            'contact_postal_code' => '60227',
            'contact_country' => 'ID',
            'whatsapp_link' => 'https://wa.me/628121043450',
            'insurance_link' => 'https://national-hospital.com/id/mitra/mitra-asuransi?t=1774324454',
            'google_maps_link' => null,
            'instagram_link' => null,
            'facebook_link' => null,
        ];
    }

    public static function homepage(): array
    {
        return [
            'hero_title' => 'Tailored Care for Your Unique Journey',
            'hero_description' => 'Committed to excellence, we combine compassionate, evidence-based treatments with the highest safety standards, ensuring gentle and effective care.',
            'hero_primary_cta_label' => 'How We Can Help',
            'hero_primary_cta_url' => '#contact-section',
            'hero_image' => 'assets/hero/doctor.png',
            'doctor_intro_title' => 'Meet dr. Robert Hunan Purwaka, Sp.OG, D.MAS, F.MIS',
            'doctor_intro_body' => 'Dr. Robert Hunan is an obstetrician-gynaecologist specializing in laparoscopic surgery. He currently practices at National Hospital Surabaya and is also a member of NHScope.',
            'doctor_intro_stat' => 'To date, Dr. Robert has handled more than 1,200 laparoscopic cases.',
            'doctor_intro_cta_label' => 'Learn more about dr. Robert',
            'doctor_intro_cta_url' => '/doctor-profile',
            'doctor_intro_image' => 'assets/hero/meet-doctor-intro.jpg',
            'about_title' => 'About NHScope',
            'about_body' => 'NHScope is a group of compassionate doctors focusing on endoscopic surgery. We are a team with expertise in various fields: gynaecology, digestive surgery, urology, otorhinolaryngology and orthopaedic surgeon.',
            'about_secondary_body' => 'TOGETHER WE CAN, and we will provide the best treatment at National Hospital Surabaya.',
            'about_cta_label' => 'Find Out More',
            'about_cta_url' => 'https://drive.google.com/file/d/1YCi7xpGNYxXPTS3yY91W1FJXyJW09xBF/view?usp=sharing',
            'about_image' => 'assets/hero/about-nh-scope.png',
            'services_title' => 'Our Services',
            'highlights_title' => 'Highlights',
            'highlight_bottom_image' => 'https://youtu.be/vAhcd0PcFnY',
            'contact_title' => 'Contact Us',
            'contact_image' => 'assets/contact/contact-us-home.jpg',
        ];
    }

    public static function homepageContactForm(): array
    {
        return [
            'contact_success_message' => 'Your enquiry has been sent.',
            'contact_name_placeholder' => 'Name *',
            'contact_phone_placeholder' => 'Phone No. *',
            'contact_email_placeholder' => 'Email *',
            'contact_message_placeholder' => 'Message',
            'contact_button_label' => 'Send An Enquiry',
        ];
    }

    public static function homepageServiceCards(): array
    {
        return [
            ['service_slug' => 'obstetrics', 'sort_order' => 10],
            ['service_slug' => 'gynaecology', 'sort_order' => 20],
            ['service_slug' => 'minimally-invasive-surgery', 'sort_order' => 30],
        ];
    }

    public static function homepageHighlights(): array
    {
        return [
            ['title' => 'Obstetrics', 'url' => '/services/obstetrics', 'image' => 'assets/highlights/obstetrics-latest.jpg', 'sort_order' => 10],
            ['title' => 'Gynecology', 'url' => '/services/gynaecology', 'image' => 'assets/highlights/gynaecology-latest.jpg', 'sort_order' => 20],
            ['title' => 'Minimally invasive surgery', 'url' => '/services/minimally-invasive-surgery', 'image' => 'assets/highlights/minimally-invasive-surgery-latest.png', 'sort_order' => 30],
            ['title' => 'NHScope', 'url' => 'https://drive.google.com/file/d/1YCi7xpGNYxXPTS3yY91W1FJXyJW09xBF/view?usp=sharing', 'image' => 'assets/highlights/nhscope-latest.jpg', 'sort_order' => 40],
            ['title' => 'Laparoscopy', 'url' => '/services/laparoscopy', 'image' => 'assets/highlights/laparoscopy-latest.png', 'sort_order' => 50],
            ['title' => 'Myoma', 'url' => '/services/myoma', 'image' => 'assets/highlights/myoma-latest.jpg', 'sort_order' => 60],
            ['title' => 'Endometriosis', 'url' => '/services/endometriosis', 'image' => 'assets/highlights/endometriosis-latest.jpg', 'sort_order' => 70],
            ['title' => 'Ovarian cyst', 'url' => '/services/ovarian-cyst', 'image' => 'assets/highlights/ovarian-cyst-latest.jpg', 'sort_order' => 80],
            ['title' => 'Hysterectomy', 'url' => '/services/hysterectomy', 'image' => 'assets/highlights/hysterectomy-latest.jpg', 'sort_order' => 90],
        ];
    }

    public static function doctorProfile(): array
    {
        return [
            'title' => 'dr. Robert Hunan Purwaka, Sp.OG, D.MAS, F.MIS',
            'subtitle' => 'Dr. Robert Hunan is an Obstetrician-gynecologist, specialized in <strong>Laparoscopic Surgery</strong> and <strong>Aesthetic Gynaecology</strong>. He currently practices at <strong>National Hospital Surabaya</strong>, and also member of NHScope.',
            'intro' => 'Dr. Robert Hunan is an Obstetrician-gynecologist, specialized in Laparoscopic Surgery and Aesthetic Gynaecology. He currently practices at National Hospital Surabaya, and also member of NHScope.',
            'biography' => 'Dr. Robert Hunan Purwaka is known for a calm, structured consultation style that helps patients understand their condition clearly and move forward with confidence. His care combines evidence-based treatment planning, minimally invasive surgical expertise, and a strong focus on patient comfort from diagnosis through recovery.',
            'image' => 'assets/hero/doctor-profile-hero.jpg',
        ];
    }

    public static function doctorProfileSections(): array
    {
        return [
            [
                'key' => 'experience',
                'title' => 'Clinical Experience & Expertise',
                'intro' => 'To date, Dr. Robert has handled more than 1,200 laparoscopic cases, including:',
                'items' => ['Ovarian cyst treatment', 'Myoma uteri surgery', 'Hysterectomy', 'Endometriosis treatment', 'Various other gynecological laparoscopic procedures'],
                'sort_order' => 10,
            ],
            [
                'key' => 'education',
                'title' => 'Education',
                'intro' => null,
                'items' => ['Faculty of Medicine Universitas Brawijaya', 'Obstetrics and Gynecology Specialist Education at Universitas Indonesia'],
                'sort_order' => 20,
            ],
            [
                'key' => 'training',
                'title' => 'Training & International Experience',
                'intro' => null,
                'items' => ['Fellow of Minimally Access Surgery, World Laparoscopy Hospital, India', 'Diploma of Minimally Access Surgery, World Laparoscopy Hospital, India', 'Fellow of Minimally Invasive Surgery, KK Women\'s and Children\'s Hospital, Singapore', 'Fellow of Endoscopic Gynecology Reproductive & Fertility - Indonesian Medical Council', 'Advanced Course in Gynecological Endometriosis Surgery, ASIAN IRCAD - Taiwan', 'Clinical Associate, KK Women\'s and Children\'s Hospital, Singapore (2012)', 'Senior Clinical Associate, KK Women\'s and Children\'s Hospital, Singapore (2013)'],
                'sort_order' => 30,
            ],
            [
                'key' => 'organization',
                'title' => 'Organization',
                'intro' => null,
                'items' => ['Member of International Society for Gynecologic Endoscopy (ISGE)', 'Member of Asia Pacific Association of Gynecologic Endoscopy (APAGE)', 'Member of Singapore - Minimally Invasive Surgery (SG-MIS)', 'Member of Indonesian Gynecologic Endoscopy Society (IGES)', 'Member of IDI (Ikatan Dokter Indonesia)', 'Member of POGI (Perhimpunan Obstetri Ginekologi Indonesia)'],
                'sort_order' => 40,
            ],
            [
                'key' => 'seminars',
                'title' => 'Seminar & Workshops',
                'intro' => null,
                'items' => ['2025, Robotic Surgery Training Edge Medical, Beijing, China', '2025, The XII Indonesian Gynecological Endoscopy Society (IGES), Indonesia', '2025, The 14th Congress of the Asia Pacific Initiative on Reproduction (ASPIRE), Singapore', '2024, Asian Society of Gynecologic Oncology, Indonesia', '2024, Workshop Stem Cell batch XXII, Indonesia', '2023, The 11th Asian Congress on Endometriosis, Philippines', '2021, Instructor on Wet lab suturing, 9th IGES, November 4th, 2021'],
                'sort_order' => 50,
            ],
        ];
    }

    public static function contactInfo(): array
    {
        return [
            'page_title' => 'Contact Us',
            'page_intro' => 'Reach our team for appointment scheduling, questions, and follow-up support.',
            'schedule_heading' => 'dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS\'s Schedule',
            'ask_label' => 'Ask Me A Question:',
        ];
    }

    public static function contactPublicFields(): array
    {
        return [
            'phone' => '+628121043450',
            'email' => 'roberthunan@gmail.com',
            'address' => 'Jl. Boulevard Famili Sel No.Kav. 1 Babatan, Kec. Wiyung, Surabaya, Jawa Timur 60227',
            'whatsapp_link' => 'https://wa.me/628121043450',
            'contact_image' => null,
        ];
    }

    public static function contactSchedules(): array
    {
        return [
            ['day_label' => 'Monday', 'time_label' => '17:00 - 20:00', 'opens_at' => '17:00', 'closes_at' => '20:00', 'sort_order' => 10],
            ['day_label' => 'Tuesday', 'time_label' => '09:00 - 12:00', 'opens_at' => '09:00', 'closes_at' => '12:00', 'sort_order' => 20],
            ['day_label' => 'Wednesday', 'time_label' => '17:00 - 20:00', 'opens_at' => '17:00', 'closes_at' => '20:00', 'sort_order' => 30],
            ['day_label' => 'Thursday', 'time_label' => '09:00 - 12:00', 'opens_at' => '09:00', 'closes_at' => '12:00', 'sort_order' => 40],
            ['day_label' => 'Friday', 'time_label' => '09:00 - 12:00', 'opens_at' => '09:00', 'closes_at' => '12:00', 'sort_order' => 50],
            ['day_label' => 'Friday', 'time_label' => '17:00 - 20:00', 'opens_at' => '17:00', 'closes_at' => '20:00', 'sort_order' => 60],
            ['day_label' => 'Sunday', 'time_label' => '09:00 - 13:00', 'opens_at' => '09:00', 'closes_at' => '13:00', 'sort_order' => 70],
        ];
    }
}
