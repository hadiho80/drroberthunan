<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageContent;
use App\Models\Service;
use App\Support\CmsMediaManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomePageController extends Controller
{
    public function __construct(private readonly CmsMediaManager $media)
    {
    }

    public function index(): View
    {
        return view('admin.homepage', [
            'homepage' => HomepageContent::query()
                ->with(['highlights', 'serviceCards'])
                ->firstOr(fn () => HomepageContent::singleton()->load(['highlights', 'serviceCards'])),
            'highlightsText' => $this->highlightsText(),
            'services' => Service::query()->orderBy('sort_order')->orderBy('title')->get(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_description' => ['required', 'string'],
            'hero_primary_cta_label' => ['nullable', 'string', 'max:255'],
            'hero_primary_cta_url' => ['nullable', 'string', 'max:255'],
            'hero_image' => $this->media->imageRules(),
            'doctor_intro_title' => ['nullable', 'string', 'max:255'],
            'doctor_intro_body' => ['nullable', 'string'],
            'doctor_intro_stat' => ['nullable', 'string', 'max:255'],
            'doctor_intro_cta_label' => ['nullable', 'string', 'max:255'],
            'doctor_intro_cta_url' => ['nullable', 'string', 'max:255'],
            'doctor_intro_image' => $this->media->imageRules(),
            'about_title' => ['nullable', 'string', 'max:255'],
            'about_body' => ['nullable', 'string'],
            'about_secondary_body' => ['nullable', 'string'],
            'about_cta_label' => ['nullable', 'string', 'max:255'],
            'about_cta_url' => ['nullable', 'string', 'max:255'],
            'about_image' => $this->media->imageRules(),
            'services_title' => ['nullable', 'string', 'max:255'],
            'highlights_title' => ['nullable', 'string', 'max:255'],
            'highlight_bottom_image' => $this->media->videoRules(),
            'contact_title' => ['nullable', 'string', 'max:255'],
            'contact_image' => $this->media->imageRules(),
            'contact_success_message' => ['nullable', 'string', 'max:255'],
            'contact_name_placeholder' => ['nullable', 'string', 'max:255'],
            'contact_phone_placeholder' => ['nullable', 'string', 'max:255'],
            'contact_email_placeholder' => ['nullable', 'string', 'max:255'],
            'contact_message_placeholder' => ['nullable', 'string', 'max:255'],
            'contact_button_label' => ['nullable', 'string', 'max:255'],
            'highlights_text' => ['nullable', 'string'],
            'service_cards' => ['nullable', 'array'],
            'service_cards.*.enabled' => ['nullable', 'boolean'],
            'service_cards.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $homepage = HomepageContent::query()
            ->with(['highlights', 'serviceCards'])
            ->firstOr(fn () => HomepageContent::singleton()->load(['highlights', 'serviceCards']));

        $data['hero_image'] = $this->media->replaceImage($request, 'hero_image', 'cms/homepage', $homepage->hero_image);
        $data['doctor_intro_image'] = $this->media->replaceImage($request, 'doctor_intro_image', 'cms/homepage', $homepage->doctor_intro_image);
        $data['about_image'] = $this->media->replaceImage($request, 'about_image', 'cms/homepage', $homepage->about_image);
        $data['highlight_bottom_image'] = $this->media->replaceVideo($request, 'highlight_bottom_image', 'cms/homepage', $homepage->highlight_bottom_image);
        $data['contact_image'] = $this->media->replaceImage($request, 'contact_image', 'cms/homepage', $homepage->contact_image);

        $homepage->fill(collect($data)->except(['highlights_text', 'service_cards'])->all())->save();

        $homepage->highlights()->delete();

        foreach ($this->parseHighlights($data['highlights_text'] ?? '') as $index => $highlight) {
            $homepage->highlights()->create($highlight + ['sort_order' => ($index + 1) * 10]);
        }

        $homepage->serviceCards()->delete();

        foreach ($this->parseServiceCards($data['service_cards'] ?? []) as $card) {
            $homepage->serviceCards()->create($card);
        }

        return back()->with('status', 'Homepage berhasil diperbarui.');
    }

    private function highlightsText(): string
    {
        return HomepageContent::singleton()->highlights
            ->map(fn ($item) => implode('|', [$item->title, $item->url, $item->image]))
            ->implode("\n");
    }

    private function parseHighlights(string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $value) ?: [])
            ->map(fn ($line) => array_map('trim', explode('|', $line)))
            ->filter(fn ($parts) => count($parts) >= 3 && $parts[0] !== '' && $parts[1] !== '')
            ->map(fn ($parts) => [
                'title' => $parts[0],
                'url' => $parts[1],
                'image' => $parts[2],
            ])
            ->values()
            ->all();
    }

    private function parseServiceCards(array $cards): array
    {
        return collect($cards)
            ->filter(fn ($card) => (bool) ($card['enabled'] ?? false))
            ->map(fn ($card, $serviceId) => [
                'service_id' => (int) $serviceId,
                'sort_order' => (int) ($card['sort_order'] ?? 0),
            ])
            ->sortBy('sort_order')
            ->values()
            ->all();
    }
}
