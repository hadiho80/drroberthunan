<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

    public function submitEnquiry(Request $request): RedirectResponse
    {
        $data = $this->sharedData();

        $payload = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
            'source' => ['nullable', 'string', 'max:100'],
        ]);

        $recipient = $data['contactEmail'];
        $source = $payload['source'] ?? 'website';
        $message = trim((string) ($payload['message'] ?? ''));

        $body = implode("\n", [
            'New enquiry received',
            'Source: '.$source,
            'Name: '.$payload['name'],
            'Phone: '.$payload['phone'],
            'Email: '.$payload['email'],
            '',
            'Message:',
            $message !== '' ? $message : '-',
        ]);

        Mail::raw($body, function ($mail) use ($recipient, $payload, $source): void {
            $mail->to($recipient)
                ->replyTo($payload['email'], $payload['name'])
                ->subject('Website enquiry from '.$source);
        });

        return back()->with('enquiry_status', 'Your enquiry has been sent.');
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
            'seoTitleDefault' => 'Dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS | Obstetrics, Gynecology, and Minimally Invasive Surgery in Surabaya',
            'seoDescriptionDefault' => 'Official website of dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS, obstetrician and gynecologist in Surabaya with women\'s health services, laparoscopy, minimally invasive surgery, and appointment information.',
            'seoKeywords' => 'dr robert hunan, robert hunan, dr robert hunan purwaka, dokter kandungan surabaya, obstetrician surabaya, gynecologist surabaya, laparoscopy surabaya, minimally invasive surgery surabaya, women health surabaya',
            'seoImage' => asset('assets/hero/doctor.png'),
            'doctorName' => 'dr. Robert Hunan Purwaka, Sp.OG, D.MAS, FMIS',
            'doctorSubtitle' => 'Obstetrician & Gynecologist',
            'doctorProfileImage' => asset('assets/hero/doctor-profile-hero.jpg'),
            'doctorProfileIntro' => 'Dr. Robert Hunan is an Obstetrician-gynecologist, specialized in Laparoscopic Surgery and Aesthetic Gynecology. He currently practices at National Hospital Surabaya, and also member of NHScope.',
            'clinicName' => 'National Hospital Surabaya',
            'clinicDepartment' => 'NH Scope',
            'contactPhone' => '+628121043450',
            'contactEmail' => 'roberthunan@gmail.com',
            'contactAddress' => 'Jl. Boulevard Famili Sel No.Kav. 1 Babatan, Kec. Wiyung, Surabaya, Jawa Timur 60227',
            'contactCity' => 'Surabaya',
            'contactRegion' => 'Jawa Timur',
            'contactPostalCode' => '60227',
            'contactCountry' => 'ID',
            'seoOgLocale' => 'en_US',
            'seoLang' => 'en',
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
                'custom_layout' => 'laparoscopy',
                'show_intro' => false,
                'hero_body' => 'Laparoscopy or "keyhole surgery" is a modern minimally invasive technique used to diagnose and perform surgical procedures through small incisions. It uses a thin camera and specialised tools to provide a high-definition view and allows surgery with less pain, faster recovery, and minimal scarring compared to open surgery.',
                'overview_title' => 'Key Aspects of Laparoscopy:',
                'overview' => [
                    'Procedure: Small incision, typically near the belly button, and insert a camera and specialised tools.',
                    'Visualisation: High-definition view.',
                    'Applications: Commonly used for gynecological problems (myoma / fibroid, adenomyosis, endometriosis, ovarian cysts).',
                    'Benefits: Compared to conventional open surgery (laparotomy), this method causes less pain, smaller wound and lower need for transfusion.',
                    'Recovery: Most patients can return to normal activities sooner than with traditional, larger-incision surgery.',
                ],
                'gallery_images' => [
                    asset('assets/services/laparoscopy-illustration-1.png'),
                    asset('assets/services/laparoscopy-illustration-2.png'),
                ],
                'sections' => [
                    [
                        'title' => 'Advantages of laparoscopy surgery including:',
                        'split_columns' => true,
                        'list' => [
                            'Minimal skin incision',
                            'Minimal pain',
                            'Precision, accuracy',
                            'Less blood loss and lower need for blood transfusions during and after surgery',
                            'Less healthy tissue damage',
                            'Less scar / aesthetic scar',
                            'Faster recovery time',
                            'Lower post-operative scarring',
                            'Better aesthetic results. With laparoscopy, the surgeon usually only requires small incisions around 0.5 cm or less, usually only around 3 small incisions around the abdomen. Hence, minimal scarring gives the patient less or no scar.',
                            'Reduced unwanted side effects of adhesion.',
                            'The risk of infection during laparoscopy is minimal because internal organs are not exposed much to the external environment.',
                        ],
                    ],
                    [
                        'title' => 'Common Gynecologic Conditions Treated',
                        'list' => [
                            'Endometriosis diagnosis and ablation',
                            'Ovarian cyst removal (cystectomy)',
                            'Pelvic adhesion (adhesiolysis)',
                            'Hemi salpingo-oophorectomy',
                            'Subtotal hysterectomy',
                            'Tubal patency test / fertility evaluation',
                            'Evaluation of pelvic pain and infertility',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'myoma',
                'title' => 'Myoma',
                'eyebrow' => 'Condition',
                'intro' => 'Myoma or uterine fibroids is a benign condition in which smooth muscle cells proliferate in the uterus. Uterine myomas are classified as benign tumors because they rarely transform into cancerous cells or tissues. Usually, they grow slowly over time and may not cause symptoms. However, when fibroids enlarge or become multiple, they can lead to heavy menstrual bleeding, pelvic pressure, pain, and reproductive concerns.',
                'hero_theme' => 'myoma',
                'custom_layout' => 'myoma',
                'show_intro' => false,
                'hero_body' => 'Myoma or uterine fibroids is a benign condition in which smooth muscle cells proliferate in the uterus. Uterine myomas are classified as benign tumors because they rarely transform into cancerous cells or tissues. Usually, they grow slowly over time and may not cause symptoms. However, when fibroids enlarge or become multiple, they can lead to heavy menstrual bleeding, pelvic pressure, pain, and reproductive concerns.',
                'feature_copy' => [
                    'Myoma, or uterine fibroids is a benign condition in which smooth muscle grow either inside or outside the uterus. Uterine myoma consist of muscle and fibrous tissue. Uterine myomas are classified as benign tumors, with very rare chances of cancerous changes. The size of these benign tumors can vary, ranging from as small as a marble to as large as a tennis ball, or even bigger in some cases.',
                ],
                'gallery_images' => [
                    asset('assets/services/myoma-illustration-1.png'),
                    asset('assets/services/myoma-illustration-2.png'),
                    asset('assets/services/myoma-illustration-3.png'),
                ],
                'sections' => [
                    [
                        'title' => 'Causes of Uterine Myomas',
                        'copy' => 'The exact cause of uterine myomas remains unknown to this day. However, several factors are believed to increase a person\'s risk of developing fibroids, including a family history of uterine myomas, being in the hormonal peak of a young age, especially until the age of 45, obesity or being overweight, reproductive hormone imbalances, particularly involving estrogen and progesterone, and consuming foods excessively such as red meat, or taking vitamins often that can cause specific enzymes to rise. Most cases are discovered incidentally during an ultrasound.',
                    ],
                    [
                        'title' => 'Symptoms of Uterine Myomas',
                        'copy' => 'Uterine myomas often do not trigger specific symptoms, making it difficult for individuals to recognise the condition. Regardless, some common signs include heavy menstrual bleeding, prolonged periods, frequent urination, pelvic pain, abdominal swelling or a feeling of fullness, frequent urination, which may occur due to myoma pressing against the bladder, constipation, which may occur if the myoma presses against the large intestine.',
                    ],
                    [
                        'title' => 'How to diagnose uterine myomas?',
                        'copy' => 'Several diagnostic procedures can be performed by a doctor to confirm the presence of uterine myomas, including patients\' complaints and a family history, physical examination, ultrasound (USG), Magnetic Resonance Imaging (MRI), hysteroscopy. A procedure where a thin, flexible tube equipped with a camera is inserted through the vagina to examine the inside of the uterus.',
                    ],
                    [
                        'title' => 'Treatments for Uterine Myomas',
                        'copy' => 'Several diagnostic procedures can be performed by a doctor to confirm the presence of uterine myomas, including patients\' complaints and a family history, physical examination, ultrasound (USG), Magnetic Resonance Imaging (MRI), hysteroscopy. A procedure where a thin, flexible tube equipped with a camera is inserted through the vagina to examine the inside of the uterus.',
                    ],
                    [
                        'title' => 'Surgery for myoma',
                        'list' => [
                            'The option for surgery for myoma will be discussed properly to know what is the patient need and choices of surgery. The choice are following:',
                            'Myomectomy: a surgical procedure to remove uterine myomas is usually recommended for patients with large myomas or for younger women who are planning to get pregnant.',
                            'Hysterectomy: a surgical procedure to remove the uterus. This is generally performed on patients who are no longer in their reproductive years and are experiencing symptoms that interfere with daily activities.',
                            'Robotic surgery: a minimally invasive technique that uses the robotic system to treat complex cases in a difficult to reach area.',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'endometriosis',
                'title' => 'Endometriosis',
                'eyebrow' => 'Condition',
                'intro' => 'Endometriosis is a disease where tissue similar to the lining of the uterus grows outside the uterus. This can cause pelvic pain, especially during menstrual periods, and it may also affect fertility. The exact cause of endometriosis is not fully understood, but genetics, immune system dysfunction, and retrograde menstruation are thought to play a role.',
                'hero_theme' => 'endometriosis',
                'custom_layout' => 'endometriosis',
                'show_intro' => false,
                'hero_body' => 'Endometriosis is a disease where tissue similar to the lining of the uterus grows outside the uterus. This can cause pelvic pain, especially during menstrual periods, and it may also affect fertility. The exact cause of endometriosis is not fully understood, but genetics, immune system dysfunction, and retrograde menstruation are thought to play a role.',
                'feature_copy' => [
                    'Endometriosis tissue can act like the lining inside the uterus and tends to respond to hormones through each menstrual cycle. This may result in swelling, bleeding, inflammation, irritation, and eventually scar tissue. Because this tissue is outside the uterus, the blood and inflammation cannot leave the body normally, which can lead to persistent pain or adhesions.',
                    'The disease can affect different parts of the pelvis and may involve the ovaries, fallopian tubes, bowel, bladder, or the outer surface of the uterus. Imaging and consultation help us understand the location and extent of disease before making treatment recommendations.',
                ],
                'feature_image' => asset('assets/services/endometriosis-illustration.png'),
                'sections' => [
                    [
                        'title' => 'Symptoms',
                        'copy' => 'The main symptoms of endometriosis typically are frequency or severity of menstrual bleeding. Symptoms can be worsening while the woman is on or is just before menses. Common symptoms include pelvic pain, heavy and painful menstruation, pain with intercourse, painful urination or painful bowel movements during bowel and bladder motion, and sometimes even may not show obvious symptoms at all despite the disease being present. The symptoms may also change over time and often vary based on how extensive the condition is.',
                        'list' => [
                            'Painful periods and worsening menstrual cramps',
                            'Chronic or cyclical pelvic pain',
                            'Pain during intercourse',
                            'Heavy menstrual bleeding or irregular bleeding',
                            'Painful urination or bowel movements, especially during periods',
                            'Bloating, lower abdominal discomfort, and fatigue',
                            'Difficulty with fertility, miscarriage, or recurrent ovarian cysts',
                        ],
                    ],
                    [
                        'title' => 'Surgery',
                        'copy_blocks' => [
                            [
                                'heading' => 'Laparoscopy for diagnosis and treatment',
                                'body' => 'Laparoscopy is the standard surgical option for diagnosis and treatment. During laparoscopy, small instruments and a camera are inserted through tiny incisions, allowing direct visualisation of lesions, adhesions, ovarian cysts, and other anatomical changes. The method often allows us to diagnose and treat disease in the same procedure while reducing wound size and recovery time.',
                            ],
                            [
                                'heading' => 'Why surgery may be recommended',
                                'body' => 'Surgery may be advised when symptoms are severe, when imaging suggests ovarian endometrioma, when fertility is affected, or when medication alone does not provide adequate relief. The goals may include confirming the diagnosis, removing visible disease, restoring pelvic anatomy, preserving fertility where possible, and reducing ongoing pain.',
                            ],
                        ],
                    ],
                    [
                        'title' => 'When to see a doctor',
                        'copy' => 'It is important to consult if pain is severe, progressive, or starts to affect daily activities or quality of life. Early assessment helps us distinguish endometriosis from other conditions and decide whether medication, imaging, or surgery is the next best step.',
                        'list' => [
                            'Your period pain feels different or stronger than usual',
                            'Your pain interferes with work, school, or daily activities',
                            'You have trouble conceiving or recurrent ovarian cysts',
                            'Your symptoms do not improve with over-the-counter treatment',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'ovarian-cyst',
                'title' => 'Ovarian Cyst',
                'eyebrow' => 'Condition',
                'intro' => 'Ovarian cysts are fluid-filled sacs that can form on the ovary and may require monitoring or treatment depending on size and symptoms. Many are benign and may resolve spontaneously, while others may persist, enlarge, or cause pain, torsion, or bleeding and need surgical management.',
                'hero_theme' => 'ovarian',
                'custom_layout' => 'ovarian-cyst',
                'show_intro' => false,
                'hero_body' => 'Ovarian cysts are fluid-filled sacs that can form on the ovary and may require monitoring or treatment depending on size and symptoms. Many are benign and may resolve spontaneously, while others may persist, enlarge, or cause pain, torsion, or bleeding and need surgical management.',
                'overview_title' => 'Key Aspects of Ovarian Cysts',
                'overview' => [
                    'Main Causes: The majority are functional cysts, caused by the menstrual cycle where a follicle fails to release an egg or doesn’t regress after the releasing one. Other types include endometrioma, dermoid cyst and benign cystadenoma.',
                    'Symptoms: The majority of ovarian cysts are asymptomatic. Large cysts may not cause acute symptoms, but some may trigger pain, abdominal pressure or bloating. Patients may also experience abnormal menstrual cycles, nausea and frequent urination or difficult bowel movements.',
                    'Other symptoms include: menstrual period disorders, nausea, lower abdominal discomfort, and pain during intercourse.',
                    'Risk Factors: Being overweight, at a younger hormonal age, not pregnant for long periods, history of recurrent cysts and certain hormonal conditions may increase the risk.',
                    'Treatment: Functional cysts often disappear without treatment within 6-8 weeks. Treatment for symptomatic or persistent cysts may include pain relief, observation, hormonal therapy, or laparoscopic surgery.',
                    'Diagnostic Options: Pelvic Ultrasound is often used to evaluate the size, content, and location of the cyst.',
                ],
                'feature_images' => [
                    asset('assets/services/ovarian-cyst-illustration-1.png'),
                    asset('assets/services/ovarian-cyst-illustration-2.png'),
                ],
                'gallery_images' => [
                    asset('assets/services/ovarian-cyst-photo-1.png'),
                    asset('assets/services/ovarian-cyst-photo-2.png'),
                    asset('assets/services/ovarian-cyst-photo-3.png'),
                ],
                'sections' => [
                    [
                        'title' => 'How are ovarian cysts diagnosed?',
                        'copy' => 'Ultrasound is the preferred method for investigating ovarian cysts. Routine scans are widely used, multiple internal partitions, thickness, blood supply, and the presence of solid areas can help classify a cyst. A blood test called CA125 may also be requested in selected situations to evaluate whether a cyst appears suspicious. Most patients are managed based on ultrasound findings, symptoms, age, and whether the cyst changes over time.',
                    ],
                    [
                        'title' => 'Treatment for Ovarian Cysts',
                        'copy_blocks' => [
                            [
                                'heading' => 'Management depends on age and the type of cyst',
                                'body' => 'Small asymptomatic ovarian cysts often do not require treatment and may disappear spontaneously. Most simple cysts in the reproductive years are observed with follow-up scans. Medication may be used for symptom control, while larger, complex, or persistent cysts may need surgery.',
                            ],
                            [
                                'heading' => 'Laparoscopy',
                                'body' => 'Laparoscopic surgery is the preferred treatment when the cyst persists, causes symptoms, or imaging suggests a lesion that should be removed. The key advantages are smaller incisions, reduced pain, quicker recovery, and excellent visualisation of the pelvis.',
                            ],
                            [
                                'heading' => 'Cystectomy',
                                'body' => 'In many patients, laparoscopic cystectomy is performed to remove only the cyst while preserving healthy ovarian tissue. This is usually preferred whenever possible, especially in women of reproductive age.',
                            ],
                            [
                                'heading' => 'Oophorectomy',
                                'body' => 'In selected cases, removal of the ovary may be necessary, particularly when the cyst is very large, recurrent, severely damaged, or suspicious. The decision depends on age, fertility goals, and operative findings.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'hysterectomy',
                'title' => 'Hysterectomy',
                'eyebrow' => 'Procedure',
                'intro' => 'A hysterectomy is a common major surgical procedure that involves the removal of the uterus (womb), which stops menstruation and prevents pregnancy. It is used to treat conditions like uterine fibroids, endometriosis, chronic pain, pelvic prolapse, and gynecologic cancers. It may also involve removing the cervix, ovaries, or fallopian tubes.',
                'hero_theme' => 'hysterectomy',
                'custom_layout' => 'hysterectomy',
                'show_intro' => false,
                'hero_body' => 'A hysterectomy is a common major surgical procedure that involves the removal of the uterus (womb), which stops menstruation and prevents pregnancy. It is used to treat conditions like uterine fibroids, endometriosis, chronic pain, pelvic prolapse, and gynecologic cancers. It may also involve removing the cervix, ovaries, or fallopian tubes.',
                'overview_title' => 'Key Aspects of Hysterectomy:',
                'overview' => [
                    'Types: A total hysterectomy removes the uterus and cervix, while a subtotal/supracervical hysterectomy removes only the uterus, leaving the cervix.',
                    'At National Hospital, most of the procedure is done by laparoscopy. Laparoscopy offers you better outcome, since laparoscopy is using small incision, which leads to minimal pain / painless. Small scar means faster recovery, faster healing. Laparoscopy is using high-definition laparoscope camera, to enhance the accuracy. Hence, laparoscopy is the most used procedure to do hysterectomy.',
                    'Approaches: Procedures can be done abdominally (open), vaginally, or laparoscopically (minimally invasive).',
                    'Ovaries: Removal of the ovaries (oophorectomy) may occur at the same time, which causes immediate menopause if not already reached.',
                    'Recovery: Full recovery usually takes about 2 to 4 weeks, during which heavy lifting and sexual activity should be avoided.',
                    'Alternatives: Depending on the condition, options like medication, ablation, or embolization may be considered before surgery.',
                ],
                'sections' => [
                    [
                        'title' => 'Reasons for the Procedure',
                        'copy' => 'Fibroid / myoma, endometriosis / adenomyosis, chronic pelvic pain, gynaecology cancer, uterine prolaps',
                    ],
                ],
            ],
        ];
    }
}
