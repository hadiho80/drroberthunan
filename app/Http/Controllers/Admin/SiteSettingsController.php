<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\CmsMediaManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingsController extends Controller
{
    public function __construct(private readonly CmsMediaManager $media)
    {
    }

    public function index(): View
    {
        return view('admin.site-settings', [
            'settings' => SiteSetting::singleton(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'doctor_name' => ['required', 'string', 'max:255'],
            'doctor_subtitle' => ['nullable', 'string', 'max:255'],
            'clinic_name' => ['required', 'string', 'max:255'],
            'clinic_department' => ['nullable', 'string', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_address' => ['nullable', 'string', 'max:255'],
            'contact_city' => ['nullable', 'string', 'max:255'],
            'contact_region' => ['nullable', 'string', 'max:255'],
            'contact_postal_code' => ['nullable', 'string', 'max:20'],
            'contact_country' => ['nullable', 'string', 'max:10'],
            'whatsapp_link' => ['nullable', 'url', 'max:255'],
            'insurance_link' => ['nullable', 'url', 'max:255'],
            'google_maps_link' => ['nullable', 'url', 'max:255'],
            'instagram_link' => ['nullable', 'url', 'max:255'],
            'facebook_link' => ['nullable', 'url', 'max:255'],
            'seo_title_default' => ['required', 'string', 'max:255'],
            'seo_description_default' => ['required', 'string', 'max:320'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'seo_lang' => ['required', 'string', 'max:10'],
            'seo_og_locale' => ['required', 'string', 'max:10'],
            'seo_image' => $this->media->imageRules(),
            'home_slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'home_is_published' => ['nullable', 'boolean'],
            'home_seo_title' => ['nullable', 'string', 'max:255'],
            'home_seo_description' => ['nullable', 'string', 'max:320'],
            'home_seo_keywords' => ['nullable', 'string', 'max:500'],
            'home_og_image' => $this->media->imageRules(),
            'profile_slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'profile_is_published' => ['nullable', 'boolean'],
            'profile_seo_title' => ['nullable', 'string', 'max:255'],
            'profile_seo_description' => ['nullable', 'string', 'max:320'],
            'profile_seo_keywords' => ['nullable', 'string', 'max:500'],
            'profile_og_image' => $this->media->imageRules(),
            'services_slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'services_is_published' => ['nullable', 'boolean'],
            'services_seo_title' => ['nullable', 'string', 'max:255'],
            'services_seo_description' => ['nullable', 'string', 'max:320'],
            'services_seo_keywords' => ['nullable', 'string', 'max:500'],
            'services_og_image' => $this->media->imageRules(),
            'contact_slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'contact_is_published' => ['nullable', 'boolean'],
            'contact_seo_title' => ['nullable', 'string', 'max:255'],
            'contact_seo_description' => ['nullable', 'string', 'max:320'],
            'contact_seo_keywords' => ['nullable', 'string', 'max:500'],
            'contact_og_image' => $this->media->imageRules(),
        ]);

        $settings = SiteSetting::singleton();

        $data['seo_image'] = $this->media->replaceImage($request, 'seo_image', 'cms/seo', $settings->seo_image);
        $data['home_og_image'] = $this->media->replaceImage($request, 'home_og_image', 'cms/seo', $settings->home_og_image);
        $data['profile_og_image'] = $this->media->replaceImage($request, 'profile_og_image', 'cms/seo', $settings->profile_og_image);
        $data['services_og_image'] = $this->media->replaceImage($request, 'services_og_image', 'cms/seo', $settings->services_og_image);
        $data['contact_og_image'] = $this->media->replaceImage($request, 'contact_og_image', 'cms/seo', $settings->contact_og_image);
        $data['home_is_published'] = $request->boolean('home_is_published');
        $data['profile_is_published'] = $request->boolean('profile_is_published');
        $data['services_is_published'] = $request->boolean('services_is_published');
        $data['contact_is_published'] = $request->boolean('contact_is_published');

        $settings->fill($data)->save();

        return back()->with('status', 'Site settings berhasil diperbarui.');
    }
}
