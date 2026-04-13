<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingsController extends Controller
{
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
            'seo_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $settings = SiteSetting::singleton();

        if ($request->hasFile('seo_image')) {
            $data['seo_image'] = $request->file('seo_image')->store('seo', 'public');
        } else {
            unset($data['seo_image']);
        }

        $settings->fill($data)->save();

        return back()->with('status', 'Site settings berhasil diperbarui.');
    }
}
