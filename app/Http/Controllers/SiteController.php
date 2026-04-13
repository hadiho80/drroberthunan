<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Support\CmsData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function __construct(private readonly CmsData $cms)
    {
    }

    public function home(): View
    {
        return view('pages.home', $this->sharedData() + [
            'homepage' => $this->homepagePayload(),
            'featuredServices' => $this->featuredServices(),
            'highlightItems' => $this->homepageHighlights(),
        ]);
    }

    public function profile(): View
    {
        $data = $this->sharedData();
        $profile = $this->doctorProfilePayload();

        return view('pages.profile', $data + [
            'pageTitle' => $profile['title'],
            'pageIntro' => $profile['subtitle'],
            'profileSections' => $profile['sections'],
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
        $contact = $this->contactPayload();

        return view('pages.contact', $data + [
            'pageTitle' => $contact['page_title'],
            'pageIntro' => $contact['page_intro'],
            'contactSchedules' => $contact['schedules'],
            'scheduleHeading' => $contact['schedule_heading'],
            'askLabel' => $contact['ask_label'],
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
        $services = $this->cms->services();
        $siteSettings = $this->siteSettingsPayload();
        $doctorProfile = $this->doctorProfilePayload();
        $contact = $this->contactPayload();
        $servicePages = $this->servicePages();
        $serviceMenuItems = collect($servicePages)->take(3)->map(fn (array $page) => [
            'label' => $page['title'],
            'url' => route('site.service.show', $page['slug']),
        ])->all();
        $whatsAppLink = $siteSettings['whatsapp_link']
            ?: ((preg_replace('/\D+/', '', $siteSettings['contact_phone'] ?? '') !== '')
                ? 'https://wa.me/'.preg_replace('/\D+/', '', $siteSettings['contact_phone'])
                : 'https://wa.me/');

        return [
            'services' => $services,
            'servicePages' => $servicePages,
            'serviceMenuItems' => $serviceMenuItems,
            'whatsAppLink' => $whatsAppLink,
            'siteName' => $siteSettings['site_name'],
            'seoTitleDefault' => $siteSettings['seo_title_default'],
            'seoDescriptionDefault' => $siteSettings['seo_description_default'],
            'seoKeywords' => $siteSettings['seo_keywords'],
            'seoImage' => $this->cms->mediaUrl($siteSettings['seo_image']),
            'doctorName' => $siteSettings['doctor_name'],
            'doctorSubtitle' => $siteSettings['doctor_subtitle'],
            'doctorProfileImage' => $this->cms->mediaUrl($doctorProfile['image']),
            'doctorProfileIntro' => $doctorProfile['intro'],
            'clinicName' => $siteSettings['clinic_name'],
            'clinicDepartment' => $siteSettings['clinic_department'],
            'contactPhone' => $siteSettings['contact_phone'],
            'contactEmail' => $siteSettings['contact_email'],
            'contactAddress' => $siteSettings['contact_address'],
            'contactCity' => $siteSettings['contact_city'],
            'contactRegion' => $siteSettings['contact_region'],
            'contactPostalCode' => $siteSettings['contact_postal_code'],
            'contactCountry' => $siteSettings['contact_country'],
            'contactSchedules' => $contact['schedules'],
            'contactScheduleSchema' => $contact['schedule_schema'],
            'scheduleHeading' => $contact['schedule_heading'],
            'askLabel' => $contact['ask_label'],
            'insuranceLink' => $siteSettings['insurance_link'],
            'googleMapsLink' => $siteSettings['google_maps_link'],
            'instagramLink' => $siteSettings['instagram_link'],
            'facebookLink' => $siteSettings['facebook_link'],
            'seoOgLocale' => $siteSettings['seo_og_locale'],
            'seoLang' => $siteSettings['seo_lang'],
        ];
    }

    private function homepagePayload(): array
    {
        $homepage = $this->cms->homepage();

        return [
            'hero_title' => $homepage->hero_title,
            'hero_description' => $homepage->hero_description,
            'hero_primary_cta_label' => $homepage->hero_primary_cta_label,
            'hero_primary_cta_url' => $this->cms->appUrl($homepage->hero_primary_cta_url),
            'hero_image' => $this->cms->mediaUrl($homepage->hero_image),
            'doctor_intro_title' => $homepage->doctor_intro_title,
            'doctor_intro_body' => $homepage->doctor_intro_body,
            'doctor_intro_stat' => $homepage->doctor_intro_stat,
            'doctor_intro_cta_label' => $homepage->doctor_intro_cta_label,
            'doctor_intro_cta_url' => $this->cms->appUrl($homepage->doctor_intro_cta_url),
            'doctor_intro_image' => $this->cms->mediaUrl($homepage->doctor_intro_image),
            'about_title' => $homepage->about_title,
            'about_body' => $homepage->about_body,
            'about_secondary_body' => $homepage->about_secondary_body,
            'about_cta_label' => $homepage->about_cta_label,
            'about_cta_url' => $this->cms->appUrl($homepage->about_cta_url),
            'about_image' => $this->cms->mediaUrl($homepage->about_image),
            'services_title' => $homepage->services_title,
            'highlights_title' => $homepage->highlights_title,
            'highlight_bottom_image' => $this->cms->mediaUrl($homepage->highlight_bottom_image),
            'contact_title' => $homepage->contact_title,
            'contact_image' => $this->cms->mediaUrl($homepage->contact_image),
        ];
    }

    private function homepageHighlights(): array
    {
        return $this->cms->homepage()->highlights->map(fn ($item) => [
            'title' => $item->title,
            'url' => $this->cms->appUrl($item->url),
            'image' => $this->cms->mediaUrl($item->image),
        ])->all();
    }

    private function featuredServices(): array
    {
        return $this->cms->services()
            ->where('is_featured', true)
            ->take(3)
            ->map(fn (Service $service) => [
                'label' => $service->title,
                'url' => route('site.service.show', $service->slug),
                'icon' => $this->cms->mediaUrl($service->card_icon),
                'copy' => $service->card_description ?: $service->intro,
            ])
            ->values()
            ->all();
    }

    private function siteSettingsPayload(): array
    {
        return $this->cms->siteSettings()->toArray();
    }

    private function doctorProfilePayload(): array
    {
        $profile = $this->cms->doctorProfile();

        return [
            'title' => $profile->title,
            'subtitle' => $profile->subtitle,
            'intro' => $profile->intro,
            'biography' => $profile->biography,
            'image' => $profile->image,
            'sections' => $profile->sections->map(fn ($section) => [
                'title' => $section->title,
                'intro' => $section->intro,
                'items' => $section->items ?? [],
            ])->all(),
        ];
    }

    private function contactPayload(): array
    {
        $contact = $this->cms->contactInfo();
        $groupedSchedules = $contact->schedules
            ->groupBy('day_label')
            ->map(function ($items, $day) {
                $items = $items->values();

                return [
                    'day' => $day,
                    'time' => $items->pluck('time_label')->implode(' / '),
                    'slots' => $items->map(fn ($schedule) => [
                        'opens_at' => $schedule->opens_at,
                        'closes_at' => $schedule->closes_at,
                    ])->all(),
                ];
            })
            ->values()
            ->all();

        return [
            'page_title' => $contact->page_title,
            'page_intro' => $contact->page_intro,
            'schedule_heading' => $contact->schedule_heading,
            'ask_label' => $contact->ask_label,
            'schedules' => $groupedSchedules,
            'schedule_schema' => $contact->schedules->map(fn ($schedule) => [
                'day' => $schedule->day_label,
                'time' => $schedule->time_label,
                'opens_at' => $schedule->opens_at,
                'closes_at' => $schedule->closes_at,
            ])->all(),
        ];
    }

    private function servicePages(): array
    {
        return $this->cms->services()->map(function (Service $service) {
            return [
                'slug' => $service->slug,
                'title' => $service->title,
                'eyebrow' => $service->eyebrow,
                'intro' => $service->intro,
                'show_intro' => $service->show_intro,
                'hero_suffix' => $service->hero_suffix,
                'hero_body' => $service->hero_body,
                'custom_layout' => $service->custom_layout,
                'overview_title' => $service->overview_title,
                'overview_split_columns' => $service->overview_split_columns,
                'overview' => $service->overview_items ?? [],
                'gallery_images' => collect($service->gallery_images ?? [])->map(fn ($image) => $this->cms->mediaUrl($image))->all(),
                'feature_image' => $this->cms->mediaUrl($service->feature_image),
                'feature_images' => collect($service->feature_images ?? [])->map(fn ($image) => $this->cms->mediaUrl($image))->all(),
                'feature_copy' => $service->feature_copy ?? [],
                'hero_image' => $this->cms->mediaUrl($service->hero_image),
                'card_image' => $this->cms->mediaUrl($service->card_image),
                'highlight_image' => $this->cms->mediaUrl($service->highlight_image),
                'sections' => $service->sections->map(fn ($section) => [
                    'title' => $section->title,
                    'copy' => $section->copy,
                    'list' => $section->list_items ?? [],
                    'copy_blocks' => $section->copy_blocks ?? [],
                    'split_columns' => $section->split_columns,
                ])->all(),
            ];
        })->all();
    }
}
