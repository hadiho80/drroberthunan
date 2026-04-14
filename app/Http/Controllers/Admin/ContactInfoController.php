<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactInfoController extends Controller
{
    public function index(): View
    {
        return view('admin.contact-info', [
            'contact' => ContactInfo::query()->with('schedules')->firstOr(fn () => ContactInfo::singleton()->load('schedules')),
            'scheduleRows' => $this->scheduleRows(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            // 'page_intro' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'whatsapp_link' => ['nullable', 'string', 'max:255'],
            'schedule_heading' => ['required', 'string', 'max:255'],
            'ask_label' => ['required', 'string', 'max:255'],
            'contact_image' => ['nullable', 'image', 'max:4096'],
            'schedule_rows' => ['nullable', 'string'],
        ]);

        $contact = ContactInfo::query()->with('schedules')->firstOr(fn () => ContactInfo::singleton()->load('schedules'));

        if ($request->hasFile('contact_image')) {
            $data['contact_image'] = $request->file('contact_image')->store('contact', 'public');
        } else {
            unset($data['contact_image']);
        }

        $contact->fill(collect($data)->except('schedule_rows')->all())->save();

        $contact->schedules()->delete();

        foreach ($this->parseScheduleRows($data['schedule_rows'] ?? '') as $index => $row) {
            $contact->schedules()->create($row + ['sort_order' => ($index + 1) * 10]);
        }

        return back()->with('status', 'Contact info berhasil diperbarui.');
    }

    private function scheduleRows(): string
    {
        return ContactInfo::singleton()->schedules
            ->map(fn ($schedule) => implode('|', [
                $schedule->day_label,
                $schedule->time_label,
                $schedule->opens_at,
                $schedule->closes_at,
            ]))
            ->implode("\n");
    }

    private function parseScheduleRows(string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $value) ?: [])
            ->map(fn ($line) => array_map('trim', explode('|', $line)))
            ->filter(fn ($parts) => count($parts) >= 2 && $parts[0] !== '' && $parts[1] !== '')
            ->map(fn ($parts) => [
                'day_label' => $parts[0],
                'time_label' => $parts[1],
                'opens_at' => $parts[2] ?? null,
                'closes_at' => $parts[3] ?? null,
            ])
            ->values()
            ->all();
    }
}
