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
            'doctor_intro_body' => 'dr. Robert Hunan is an Obstetrician-gynecologist, specialized in Laparoscopic Surgery and Aesthetic Gynaecology. He currently practices at National Hospital Surabaya, and also member of NHScope.',
            'doctor_intro_stat' => 'Until now, dr. Robert has handled more than 1,200 laparoscopic cases.',
            'doctor_intro_cta_label' => 'Learn more about dr. Robert',
            'doctor_intro_cta_url' => '/doctor-profile',
            'doctor_intro_image' => 'assets/hero/meet-doctor-intro.jpg',
            'about_title' => 'About NH Scope',
            'about_body' => 'NH scope is a group of compassionate doctors, focus on endoscopic surgery. We are a team with various expertise : gynaecology, digestive surgery, urology, otorinolaringology and orthopedic surgeon.',
            'about_secondary_body' => 'TOGETHER WE CAN and we will provide the best treatment at National Hospital Surabaya',
            'about_cta_label' => 'Find Out More',
            'about_cta_url' => 'https://drive.google.com/file/d/1YCi7xpGNYxXPTS3yY91W1FJXyJW09xBF/view?usp=sharing',
            'about_image' => 'assets/hero/about-nh-scope.png',
            'services_title' => 'Our Services',
            'highlights_title' => 'Highlights',
            'highlight_bottom_image' => 'assets/highlights/highlight-bottom.png',
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
            'title' => 'Doctor\'s Profile',
            'subtitle' => 'Clinical background, education, and care philosophy for Dr. Robert Hunan Purwaka.',
            'intro' => 'Dr. Robert Hunan is an Obstetrician-gynecologist, specialized in Laparoscopic Surgery and Aesthetic Gynecology. He currently practices at National Hospital Surabaya, and also member of NHScope.',
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
                'intro' => 'To date, dr. Robert has handled more than 1,000 laparoscopic cases, including:',
                'items' => ['Ovarian cyst treatment', 'Myoma uteri surgery', 'Hysterectomy', 'Endometriosis treatment', 'Various other gynecological laparoscopic procedures'],
                'sort_order' => 10,
            ],
            [
                'key' => 'education',
                'title' => 'Education',
                'intro' => null,
                'items' => ['Faculty of Medicine Universitas Brawijaya', 'Obstetrics and Gynecology Specialist Education at Universitas Indonesia', 'Diploma of Minimal Access Surgery (Laparoscopy) | World Laparoscopy Hospital India', 'Fellowship in Minimally Invasive Surgery (Laparoscopy) | Link K Hospital, Singapore'],
                'sort_order' => 20,
            ],
            [
                'key' => 'training',
                'title' => 'Training Experience',
                'intro' => null,
                'items' => ['AAGL 25th Annual Scientific Meeting Attended Regional Meeting Sydney Australia 2024', 'The 2nd Indonesian Gynecological Endoscopy Society (IGES) National Meeting Jakarta 2012', '17th Annual Colposcopy Course Singapore 2012', 'SCOG 2012, Korean Society for Gynecologic Endoscopy 2012', 'Basic Laparoscopic Workshop Surabaya 2008', 'Workshop on Laparoscopic Tubal Occlusion with local anesthesia RS Sumber Jakarta 2011', 'Basic BTL skill course by POGI 2008', 'Intermediate Gynecologic Laparoscopic skill as a part of Aesculap workshop 2009', 'Intermediate Gynecologic Laparoscopic Skill as a part of Asia Pacific Conference Bali 2011', 'Cervical and Ovarian Cancer Management as a part of Asia Pacific Conference Bali 2011', 'Advanced Gynecologic Surgical Skill part of APGSB Bali 2011'],
                'sort_order' => 30,
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
