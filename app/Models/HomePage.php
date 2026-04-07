<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class HomePage extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'hero_badge',
        'hero_title',
        'hero_highlight',
        'hero_description',
        'primary_cta_label',
        'primary_cta_url',
        'secondary_cta_label',
        'secondary_cta_url',
        'hero_image',
        'experience_label',
        'experience_value',
        'patients_label',
        'patients_value',
        'about_eyebrow',
        'about_title',
        'about_description',
        'quote_text',
        'quote_author',
        'doctor_profile_title',
        'doctor_profile_subtitle',
        'doctor_profile_intro',
        'doctor_profile_biography',
        'doctor_profile_experience',
        'doctor_profile_education',
        'doctor_profile_training',
        'doctor_profile_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_image',
        'contact_phone',
        'contact_email',
        'contact_address',
        'contact_page_title',
        'contact_page_intro',
        'facility_image',
    ];

    public static function defaults(): array
    {
        return [
            'site_name' => 'Dr. Robert Hunan',
            'site_tagline' => 'Layanan kesehatan yang hangat, presisi, dan profesional.',
            'hero_badge' => 'Dokter Keluarga & Konsultan Kesehatan',
            'hero_title' => 'Perawatan menyeluruh yang terasa tenang, personal, dan terpercaya.',
            'hero_highlight' => 'Untuk Anda dan keluarga',
            'hero_description' => 'Dr. Robert Hunan menghadirkan konsultasi medis dengan pendekatan manusiawi, diagnosis yang teliti, dan rencana perawatan yang jelas dari awal hingga pemulihan.',
            'primary_cta_label' => 'Buat Janji Temu',
            'primary_cta_url' => '#contact',
            'secondary_cta_label' => 'Lihat Layanan',
            'secondary_cta_url' => '#services',
            'experience_label' => 'Pengalaman klinis',
            'experience_value' => '10+ Tahun',
            'patients_label' => 'Pasien tertangani',
            'patients_value' => '5.000+',
            'about_eyebrow' => 'Tentang Dokter',
            'about_title' => 'Pendampingan medis yang memberi rasa aman sejak konsultasi pertama.',
            'about_description' => 'Setiap pasien datang dengan cerita yang berbeda. Karena itu, pendekatan pelayanan dibangun lewat komunikasi yang jernih, keputusan medis yang berbasis data, dan perhatian pada kualitas hidup pasien sehari-hari.',
            'quote_text' => 'Kesehatan terbaik lahir dari diagnosis yang tepat, penjelasan yang jujur, dan hubungan dokter-pasien yang saling percaya.',
            'quote_author' => 'Dr. Robert Hunan',
            'doctor_profile_title' => 'dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS',
            'doctor_profile_subtitle' => 'Obstetrician & Gynecologist | Laparoscopic Surgery | Aesthetic Gynecology',
            'doctor_profile_intro' => 'Dr. Robert Hunan is an Obstetrician-gynecologist, specialized in Laparoscopic Surgery and Aesthetic Gynecology. He currently practices at National Hospital Surabaya, and also member of NHScope.',
            'doctor_profile_biography' => 'Dr. Robert Hunan Purwaka is known for a calm, structured consultation style that helps patients understand their condition clearly and move forward with confidence. His care combines evidence-based treatment planning, minimally invasive surgical expertise, and a strong focus on patient comfort from diagnosis through recovery.',
            'doctor_profile_experience' => implode("\n", [
                'Focused women\'s health care with patient-first communication.',
                'Experienced in minimally invasive gynecologic procedures.',
                'Comprehensive consultation for preventive and ongoing care.',
            ]),
            'doctor_profile_education' => implode("\n", [
                'Medical doctor and specialist training in obstetrics and gynecology.',
                'Continuous professional development in laparoscopy and endoscopy.',
            ]),
            'doctor_profile_training' => implode("\n", [
                'Hands-on laparoscopic procedure planning and post-operative care.',
                'Integrated care coordination with hospital teams and diagnostics.',
            ]),
            'seo_title' => 'Dr. Robert Hunan | Layanan Dokter Profesional',
            'seo_description' => 'Website resmi Dr. Robert Hunan untuk konsultasi, informasi layanan, dan profil dokter dengan pengalaman klinis yang terpercaya.',
            'seo_keywords' => 'dokter, konsultasi kesehatan, layanan medis, dr robert hunan',
            'contact_page_title' => 'CONTACT US',
            'contact_page_intro' => 'Reach our team for appointment scheduling, questions, and follow-up support.',
        ];
    }

    public function profileSections(): array
    {
        return [
            [
                'title' => 'Clinical Experience & Expertise',
                'items' => $this->splitSection($this->doctor_profile_experience, Arr::get(self::defaults(), 'doctor_profile_experience')),
            ],
            [
                'title' => 'Education',
                'items' => $this->splitSection($this->doctor_profile_education, Arr::get(self::defaults(), 'doctor_profile_education')),
            ],
            [
                'title' => 'Training Experience',
                'items' => $this->splitSection($this->doctor_profile_training, Arr::get(self::defaults(), 'doctor_profile_training')),
            ],
        ];
    }

    private function splitSection(?string $value, string $fallback): array
    {
        return collect(preg_split('/\r\n|\r|\n/', trim($value ?: $fallback)) ?: [])
            ->map(fn (?string $item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();
    }
}
