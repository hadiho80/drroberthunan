<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomePageController extends Controller
{
    public function index(): View
    {
        return view('admin.homepage', [
            'homepage' => $this->homepage(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'hero_badge' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_highlight' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['required', 'string'],
            'primary_cta_label' => ['nullable', 'string', 'max:255'],
            'primary_cta_url' => ['nullable', 'string', 'max:255'],
            'secondary_cta_label' => ['nullable', 'string', 'max:255'],
            'secondary_cta_url' => ['nullable', 'string', 'max:255'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
            'experience_label' => ['nullable', 'string', 'max:255'],
            'experience_value' => ['nullable', 'string', 'max:255'],
            'patients_label' => ['nullable', 'string', 'max:255'],
            'patients_value' => ['nullable', 'string', 'max:255'],
            'about_eyebrow' => ['nullable', 'string', 'max:255'],
            'about_title' => ['required', 'string', 'max:255'],
            'about_description' => ['required', 'string'],
            'quote_text' => ['nullable', 'string'],
            'quote_author' => ['nullable', 'string', 'max:255'],
            'doctor_profile_title' => ['nullable', 'string', 'max:255'],
            'doctor_profile_subtitle' => ['nullable', 'string', 'max:255'],
            'doctor_profile_intro' => ['nullable', 'string'],
            'doctor_profile_biography' => ['nullable', 'string'],
            'doctor_profile_experience' => ['nullable', 'string'],
            'doctor_profile_education' => ['nullable', 'string'],
            'doctor_profile_training' => ['nullable', 'string'],
            'doctor_profile_image' => ['nullable', 'image', 'max:4096'],
            'seo_title' => ['required', 'string', 'max:255'],
            'seo_description' => ['required', 'string', 'max:320'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'seo_image' => ['nullable', 'image', 'max:4096'],
            'contact_phone' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_address' => ['nullable', 'string', 'max:255'],
            'contact_page_title' => ['nullable', 'string', 'max:255'],
            'contact_page_intro' => ['nullable', 'string'],
            'facility_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $homepage = $this->homepage();

        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('homepage', 'public');
        } else {
            unset($validated['hero_image']);
        }

        if ($request->hasFile('seo_image')) {
            $validated['seo_image'] = $request->file('seo_image')->store('seo', 'public');
        } else {
            unset($validated['seo_image']);
        }

        if ($request->hasFile('doctor_profile_image')) {
            $validated['doctor_profile_image'] = $request->file('doctor_profile_image')->store('profile', 'public');
        } else {
            unset($validated['doctor_profile_image']);
        }

        if ($request->hasFile('facility_image')) {
            $validated['facility_image'] = $request->file('facility_image')->store('facility', 'public');
        } else {
            unset($validated['facility_image']);
        }

        $homepage->fill($validated)->save();

        return back()->with('status', 'Konten homepage berhasil diperbarui.');
    }

    private function homepage(): HomePage
    {
        return HomePage::query()->firstOrCreate([], HomePage::defaults());
    }
}
