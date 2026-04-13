<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorProfileController extends Controller
{
    public function index(): View
    {
        return view('admin.doctor-profile', [
            'profile' => DoctorProfile::query()->with('sections')->firstOr(fn () => DoctorProfile::singleton()->load('sections')),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'intro' => ['required', 'string'],
            'biography' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'experience_intro' => ['nullable', 'string'],
            'experience_items' => ['nullable', 'string'],
            'education_items' => ['nullable', 'string'],
            'training_items' => ['nullable', 'string'],
        ]);

        $profile = DoctorProfile::query()->with('sections')->firstOr(fn () => DoctorProfile::singleton()->load('sections'));

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('profile', 'public');
        } else {
            unset($data['image']);
        }

        $profile->fill(collect($data)->except([
            'experience_intro',
            'experience_items',
            'education_items',
            'training_items',
        ])->all())->save();

        $sections = $profile->sections->keyBy('key');

        $this->updateSection(
            $sections->get('experience'),
            [
                'doctor_profile_id' => $profile->id,
                'key' => 'experience',
                'title' => 'Clinical Experience & Expertise',
                'intro' => $data['experience_intro'],
                'items' => $this->lines($data['experience_items']),
                'sort_order' => 10,
            ]
        );
        $this->updateSection(
            $sections->get('education'),
            [
                'doctor_profile_id' => $profile->id,
                'key' => 'education',
                'title' => 'Education',
                'intro' => null,
                'items' => $this->lines($data['education_items']),
                'sort_order' => 20,
            ]
        );
        $this->updateSection(
            $sections->get('training'),
            [
                'doctor_profile_id' => $profile->id,
                'key' => 'training',
                'title' => 'Training Experience',
                'intro' => null,
                'items' => $this->lines($data['training_items']),
                'sort_order' => 30,
            ]
        );

        return back()->with('status', 'Doctor profile berhasil diperbarui.');
    }

    private function updateSection($section, array $payload): void
    {
        if ($section) {
            $section->update($payload);

            return;
        }

        DoctorProfile::singleton()->sections()->create($payload);
    }

    private function lines(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value) ?: [])
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();
    }
}
