<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        return view('pages.home', $this->sharedData());
    }

    public function profile(): View
    {
        $data = $this->sharedData();

        return view('pages.profile', $data + [
            'pageTitle' => 'Doctor\'s Profile',
            'pageIntro' => 'Clinical background, education, and care philosophy for Dr. Robert Hunan Purwaka.',
            'profileSections' => $this->profileSections(),
        ]);
    }

    public function services(): View
    {
        $data = $this->sharedData();

        return view('pages.services', $data + [
            'pageTitle' => 'Services',
            'pageIntro' => 'A clear overview of our main service areas with links to more detailed information.',
            'servicePages' => $this->servicePages(),
        ]);
    }

    public function service(string $slug): View
    {
        $data = $this->sharedData();
        $servicePage = collect($this->servicePages())->firstWhere('slug', $slug);

        abort_unless($servicePage, 404);

        return view('pages.service-detail', $data + [
            'servicePage' => $servicePage,
        ]);
    }

    public function contact(): View
    {
        $data = $this->sharedData();

        return view('pages.contact', $data + [
            'pageTitle' => 'Contact Us',
            'pageIntro' => 'Reach our team for appointment scheduling, questions, and follow-up support.',
        ]);
    }

    private function sharedData(): array
    {
        $services = Service::query()->latest()->get();
        $servicePages = $this->servicePages();
        $serviceMenuItems = collect($servicePages)->take(3)->map(fn (array $page) => [
            'label' => $page['title'],
            'url' => route('site.service.show', $page['slug']),
        ])->all();
        $siteSettings = $this->siteSettings();
        $whatsAppNumber = preg_replace('/\D+/', '', $siteSettings['contactPhone']);
        $whatsAppLink = $whatsAppNumber ? 'https://wa.me/'.$whatsAppNumber : 'https://wa.me/';

        return compact('services', 'servicePages', 'serviceMenuItems', 'whatsAppLink') + $siteSettings;
    }

    private function siteSettings(): array
    {
        return [
            'siteName' => 'Dr. Robert Hunan',
            'seoTitleDefault' => 'Dr. Robert Hunan | Obstetrics, Gynecology, and Minimally Invasive Surgery',
            'seoDescriptionDefault' => 'Official website of Dr. Robert Hunan Purwaka with women\'s health services, laparoscopic surgery, and appointment information.',
            'seoKeywords' => 'dr robert hunan, obstetrics, gynecology, laparoscopy, women\'s health, surabaya',
            'seoImage' => asset('assets/hero/doctor.png'),
            'doctorName' => 'dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS',
            'doctorSubtitle' => 'Obstetrician & Gynecologist',
            'doctorProfileImage' => asset('assets/hero/doctor.png'),
            'doctorProfileIntro' => 'Dr. Robert Hunan is an Obstetrician-gynecologist, specialized in Laparoscopic Surgery and Aesthetic Gynecology. He currently practices at National Hospital Surabaya, and also member of NHScope.',
            'contactPhone' => '+628121043450',
            'contactEmail' => 'roberthunan@gmail.com',
            'contactAddress' => 'Jl. Boulevard Famili Sel No.Kav. 1 Babatan, Kec. Wiyung, Surabaya, Jawa Timur 60227',
        ];
    }

    private function profileSections(): array
    {
        return [
            [
                'title' => 'Clinical Experience & Expertise',
                'intro' => 'To date, dr. Robert has handled more than 1,000 laparoscopic cases, including:',
                'items' => [
                    'Ovarian cyst treatment',
                    'Myoma uteri surgery',
                    'Hysterectomy',
                    'Endometriosis treatment',
                    'Various other gynecological laparoscopic procedures',
                ],
            ],
            [
                'title' => 'Education',
                'items' => [
                    'Faculty of Medicine Universitas Brawijaya',
                    'Obstetrics and Gynecology Specialist Education at Universitas Indonesia',
                    'Diploma of Minimal Access Surgery (Laparoscopy) | World Laparoscopy Hospital India',
                    'Fellowship in Minimally Invasive Surgery (Laparoscopy) | Link K Hospital, Singapore',
                ],
            ],
            [
                'title' => 'Training Experience',
                'items' => [
                    'AAGL 25th Annual Scientific Meeting Attended Regional Meeting Sydney Australia 2024',
                    'The 2nd Indonesian Gynecological Endoscopy Society (IGES) National Meeting Jakarta 2012',
                    '17th Annual Colposcopy Course Singapore 2012',
                    'SCOG 2012, Korean Society for Gynecologic Endoscopy 2012',
                    'Basic Laparoscopic Workshop Surabaya 2008',
                    'Workshop on Laparoscopic Tubal Occlusion with local anesthesia RS Sumber Jakarta 2011',
                    'Basic BTL skill course by POGI 2008',
                    'Intermediate Gynecologic Laparoscopic skill as a part of Aesculap workshop 2009',
                    'Intermediate Gynecologic Laparoscopic Skill as a part of Asia Pacific Conference Bali 2011',
                    'Cervical and Ovarian Cancer Management as a part of Asia Pacific Conference Bali 2011',
                    'Advanced Gynecologic Surgical Skill part of APGSB Bali 2011',
                ],
            ],
        ];
    }

    private function servicePages(): array
    {
        return [
            [
                'slug' => 'obstetrics',
                'title' => 'Obstetrics',
                'eyebrow' => 'Services',
                'intro' => 'Safe and structured support from early pregnancy through post-partum care.',
                'show_intro' => false,
                'hero_theme' => 'obstetrics',
                'overview_title' => 'Pre-Pregnancy',
                'overview' => [
                    'Pre-conception health optimisation',
                    'Pre-pregnancy counselling',
                    'Laboratory and ultrasound check',
                ],
                'sections' => [
                    [
                        'title' => 'Early Pregnancy Care',
                        'list' => [
                            'Early pregnancy scan and viability assessment',
                            'Management of early pregnancy complaints (e.g. nausea, vomiting, bleeding)',
                            'Management of early pregnancy complication (e.g. bleeding, ectopic pregnancy, recurrent miscarriage)',
                        ],
                    ],
                    [
                        'title' => 'Antenatal Care',
                        'list' => [
                            '1st trimester antenatal check-up and dating scan',
                            'First trimester screening',
                            'Management of first trimester pregnancy complaints and complication',
                            'Detailed scan and 2nd trimester pregnancy assessment',
                            'Screening and management of gestational diabetes and preeclampsia',
                            'Plan on delivery mode and 3rd trimester pregnancy',
                            'Screening and management preeclampsia and other complications in late pregnancy',
                            'Vaccinations during pregnancy',
                            'Nutritional and lifestyle guidance',
                        ],
                    ],
                    [
                        'title' => 'Labour & Delivery Planning',
                        'list' => [
                            'Vaginal birth, assisted delivery, and caesarean section counseling',
                            'The mode of delivery may differ pending individual maternal and pregnancy factors. This may be a vaginal delivery, an assisted vaginal delivery or caesarean section.',
                            'Anaesthesia and paediatric team for safe delivery',
                        ],
                    ],
                    [
                        'title' => 'Postpartum Care',
                        'list' => [
                            'Physical recovery assessment and wound care',
                            'Breastfeeding support and lactation counselling',
                            'Postnatal treatment and contraception',
                            'Emotional wellbeing and post-partum depression screening',
                            'Optimal recovery postpartum management',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'gynaecology',
                'title' => 'Gynaecology',
                'eyebrow' => 'Services',
                'intro' => 'Assessment, diagnosis, and treatment planning for common and complex gynecologic concerns.',
                'show_intro' => false,
                'hero_theme' => 'gynaecology',
                'overview_title' => 'Assessment and treatment of',
                'overview_split_columns' => false,
                'overview' => [
                    'Abnormal menstrual cycles such irregular cycles, prolonged menses, heavy menstrual bleeding, anaemia',
                    'Menstrual and acute / chronic pelvic pain',
                    'Infertility screening',
                    'Vaginal discharge',
                    'Menopausal check up',
                    'Contraception and family planning',
                    'Cervical cancer screening: PAP smear and high risk HPV test',
                    'Vaccinations: Cervical cancer HPV vaccine',
                    'Ultrasound Pelvis, STI screening',
                ],
                'sections' => [
                    [
                        'title' => 'Gynecological conditions such as:',
                        'split_columns' => true,
                        'list' => [
                            'Myoma / fibroids',
                            'Adenomyosis',
                            'Endometriosis cyst',
                            'Ovarian cyst',
                            'Endometrial polyps',
                            'Endometrial hyperplasia',
                            'Cervical polyps',
                            'Abnormal pap smears',
                            'Polycystic Ovarian Syndrome',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'minimally-invasive-surgery',
                'title' => 'Minimally Invasive Surgery',
                'eyebrow' => 'Services',
                'intro' => 'At NHScope, we specialise in minimally invasive surgical techniques, or known as LAPAROSCOPY that allow for painless surgery, minimal wound, faster recovery, better outcome using laparoscopy or robotic laparoscopy approaches.',
                'hero_suffix' => ' / PAINLESS',
                'show_intro' => true,
                'hero_theme' => 'mis',
                'overview_split_columns' => true,
                'overview_title' => 'Surgical Treatment for the Following Conditions',
                'overview' => [
                    'Myoma / fibroids',
                    'Ovarian cyst',
                    'Endometriosis cyst',
                    'Adenomyosis',
                    'Chronic pelvic pain',
                    'Abdominal / pelvic adhesion',
                    'Thickened endometrium',
                    'Endometrial hyperplasia / precancer of the uterus',
                    'Abnormal menstrual bleeding (heavy, irregular, prolonged)',
                    'Cervical and endocervical polyps',
                    'Endometrial polyps',
                    'Ectopic pregnancy',
                    'Hydrosalpinx or diseased fallopian tubes',
                    'Cervical intraepithelial neoplasia (CIN)',
                ],
                'sections' => [
                    [
                        'title' => 'Hysteroscopy (via the cervix, no abdominal incision)',
                        'list' => [
                            'Polypectomy',
                            'Myomectomy',
                            'Diagnostic hysteroscopy',
                            'Dilatation and curettage (D&C)',
                            'Adhesiolysis for intrauterine adhesions (Asherman syndrome)',
                            'Retained IUD (intrauterine device)',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'laparoscopy',
                'title' => 'Laparoscopy',
                'eyebrow' => 'Procedure',
                'intro' => 'Laparoscopy or “keyhole surgery” is a modern minimally invasive technique used to diagnose and perform surgical procedures through small incisions.',
                'hero_theme' => 'laparoscopy',
                'overview_title' => 'Key Aspects of Laparoscopy:',
                'overview' => [
                    'Procedure: Small incision, typically near the belly button, and insert a camera and specialised tools.',
                    'Visualisation: High-definition view.',
                    'Applications: Ovarian cysts, endometriosis, adhesions, myomectomy, hysterectomy.',
                    'Benefits: Less pain, shorter hospital stay, faster return to normal activities.',
                ],
                'sections' => [
                    [
                        'title' => 'Advantages of laparoscopy surgery including:',
                        'list' => [
                            'Minimal skin incision',
                            'Minimal pain',
                            'Precision, accuracy',
                            'Less blood loss and lower need for transfusion',
                            'Faster recovery time',
                        ],
                    ],
                    [
                        'title' => 'Common Gynecologic Conditions Treated',
                        'list' => [
                            'Endometriosis diagnosis and ablation',
                            'Ovarian cyst surgery',
                            'Myoma treatment',
                            'Hysterectomy',
                            'Ectopic pregnancy',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'myoma',
                'title' => 'Myoma',
                'eyebrow' => 'Condition',
                'intro' => 'Myoma, or uterine fibroids, is a benign condition in which smooth muscle cells proliferate in the uterus.',
                'hero_theme' => 'myoma',
                'overview_title' => 'Overview',
                'overview' => [
                    'Benign uterine smooth muscle growth',
                    'Can cause heavy bleeding and pelvic pressure',
                    'Treatment depends on symptoms, size, and fertility goals',
                ],
                'sections' => [
                    [
                        'title' => 'Causes of Uterine Myomas',
                        'copy' => 'The exact cause remains uncertain, but hormonal influences and genetic predisposition are linked to increased risk.',
                    ],
                    [
                        'title' => 'Symptoms of Uterine Myomas',
                        'copy' => 'Heavy bleeding, pelvic discomfort, abdominal swelling, urinary symptoms, and fertility concerns may be present.',
                    ],
                    [
                        'title' => 'How to diagnose uterine myomas?',
                        'copy' => 'Diagnosis uses clinical review, pelvic examination, and ultrasound imaging with further tests when required.',
                    ],
                    [
                        'title' => 'Treatments for Uterine Myomas',
                        'copy' => 'Observation, medication, embolisation, or surgery may be considered depending on symptoms and patient goals.',
                    ],
                    [
                        'title' => 'Surgery for myoma',
                        'list' => [
                            'Myomectomy',
                            'Hysterectomy',
                            'Laparoscopic or open procedure depending on case complexity',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'endometriosis',
                'title' => 'Endometriosis',
                'eyebrow' => 'Condition',
                'intro' => 'Endometriosis occurs when tissue similar to the uterine lining grows outside the uterus and causes inflammation and pain.',
                'hero_theme' => 'endometriosis',
                'overview_title' => 'Overview',
                'overview' => [
                    'Associated with painful periods and chronic pelvic pain',
                    'May affect fertility and quality of life',
                    'Treatment may include medication or surgery',
                ],
                'sections' => [
                    [
                        'title' => 'Symptoms',
                        'copy' => 'Painful menstruation, pelvic pain, pain during intercourse, bowel discomfort, and fatigue can occur.',
                    ],
                    [
                        'title' => 'Surgery',
                        'copy' => 'Laparoscopy may be recommended to diagnose and treat endometriosis lesions when symptoms are persistent.',
                    ],
                    [
                        'title' => 'When to see a doctor',
                        'copy' => 'Consultation is important when pain is severe, symptoms affect daily activity, or pregnancy is being planned.',
                    ],
                ],
            ],
            [
                'slug' => 'ovarian-cyst',
                'title' => 'Ovarian Cyst',
                'eyebrow' => 'Condition',
                'intro' => 'Ovarian cysts are fluid-filled sacs that can form on the ovary and may require monitoring or treatment depending on size and symptoms.',
                'hero_theme' => 'ovarian',
                'overview_title' => 'Key Aspects of Ovarian Cysts',
                'overview' => [
                    'Many cysts are benign and may resolve without treatment.',
                    'Imaging and symptoms help decide whether follow-up or surgery is needed.',
                    'Complex cysts may require more detailed evaluation.',
                ],
                'sections' => [
                    [
                        'title' => 'How are ovarian cysts diagnosed?',
                        'copy' => 'Diagnosis often includes ultrasound review, symptom assessment, and sometimes laboratory tests.',
                    ],
                    [
                        'title' => 'Treatment for Ovarian Cysts',
                        'copy' => 'Observation, medication, and laparoscopic surgery are considered based on cyst appearance and symptoms.',
                    ],
                ],
            ],
            [
                'slug' => 'hysterectomy',
                'title' => 'Hysterectomy',
                'eyebrow' => 'Procedure',
                'intro' => 'A hysterectomy is a common major surgical procedure that removes the uterus for selected gynecologic conditions.',
                'hero_theme' => 'hysterectomy',
                'overview_title' => 'Key Aspects of Hysterectomy:',
                'overview' => [
                    'Types include total and subtotal hysterectomy',
                    'Can be approached by laparoscopy, vaginal, or abdominal surgery',
                    'Recovery varies based on the technique used',
                ],
                'sections' => [
                    [
                        'title' => 'Reasons for the Procedure',
                        'copy' => 'Fibroid, adenomyosis, endometriosis, chronic pelvic pain, gynecology cancer, and uterine prolapse.',
                    ],
                ],
            ],
        ];
    }
}
