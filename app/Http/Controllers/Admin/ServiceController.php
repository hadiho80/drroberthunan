<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Support\CmsMediaManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __construct(private readonly CmsMediaManager $media)
    {
    }

    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::query()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.services.form', [
            'service' => new Service([
                'show_intro' => true,
                'is_published' => true,
                'sections_json' => json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            ]),
            'action' => route('admin.services.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $service = Service::query()->create($this->payload($request, $data));
        $this->syncSections($service, $data['sections_json'] ?? '[]');

        return redirect()->route('admin.services.index')->with('status', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service): View
    {
        $service->load('sections');
        $service->sections_json = json_encode($service->sections->map(fn ($section) => [
            'title' => $section->title,
            'copy' => $section->copy,
            'list_items' => $section->list_items,
            'copy_blocks' => $section->copy_blocks,
            'split_columns' => $section->split_columns,
            'sort_order' => $section->sort_order,
        ])->all(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return view('admin.services.form', [
            'service' => $service,
            'action' => route('admin.services.update', $service),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $data = $this->validatedData($request, $service);
        $service->update($this->payload($request, $data, $service));
        $this->syncSections($service, $data['sections_json'] ?? '[]');

        return redirect()->route('admin.services.index')->with('status', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        foreach (['card_icon', 'card_image', 'hero_image', 'highlight_image', 'feature_image', 'og_image'] as $field) {
            $this->media->deleteManagedFile($service->{$field});
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Layanan berhasil dihapus.');
    }

    private function validatedData(Request $request, ?Service $service = null): array
    {
        $serviceId = $service?->id;

        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('services', 'slug')->ignore($serviceId),
            ],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'intro' => ['nullable', 'string'],
            'card_description' => ['nullable', 'string'],
            'hero_suffix' => ['nullable', 'string', 'max:255'],
            'hero_body' => ['nullable', 'string'],
            'overview_title' => ['nullable', 'string', 'max:255'],
            'overview_items_text' => ['nullable', 'string'],
            'overview_split_columns' => ['nullable', 'boolean'],
            'show_intro' => ['nullable', 'boolean'],
            'custom_layout' => ['nullable', 'string', 'max:255'],
            'feature_copy_text' => ['nullable', 'string'],
            'feature_images_text' => ['nullable', 'string'],
            'gallery_images_text' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:320'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'sections_json' => ['nullable', 'string'],
            'card_icon' => $this->media->imageRules(),
            'card_image' => $this->media->imageRules(),
            'hero_image' => $this->media->imageRules(),
            'highlight_image' => $this->media->imageRules(),
            'feature_image' => $this->media->imageRules(),
            'og_image' => $this->media->imageRules(),
        ]);
    }

    private function payload(Request $request, array $data, ?Service $service = null): array
    {
        $payload = [
            'title' => $data['title'],
            'slug' => Str::slug($data['slug']),
            'description' => $data['card_description'] ?? $data['intro'] ?? $data['title'],
            'eyebrow' => $data['eyebrow'] ?? null,
            'intro' => $data['intro'] ?? null,
            'card_description' => $data['card_description'] ?? null,
            'hero_suffix' => $data['hero_suffix'] ?? null,
            'hero_body' => $data['hero_body'] ?? null,
            'overview_title' => $data['overview_title'] ?? null,
            'overview_items' => $this->lines($data['overview_items_text'] ?? ''),
            'overview_split_columns' => $request->boolean('overview_split_columns'),
            'show_intro' => $request->boolean('show_intro'),
            'custom_layout' => $data['custom_layout'] ?? null,
            'feature_copy' => $this->lines($data['feature_copy_text'] ?? ''),
            'feature_images' => $this->lines($data['feature_images_text'] ?? ''),
            'gallery_images' => $this->lines($data['gallery_images_text'] ?? ''),
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published'),
            'seo_title' => $data['seo_title'] ?? null,
            'seo_description' => $data['seo_description'] ?? null,
            'seo_keywords' => $data['seo_keywords'] ?? null,
        ];

        $payload['card_icon'] = $this->media->replaceImage($request, 'card_icon', 'cms/services', $service?->card_icon);
        $payload['card_image'] = $this->media->replaceImage($request, 'card_image', 'cms/services', $service?->card_image);
        $payload['hero_image'] = $this->media->replaceImage($request, 'hero_image', 'cms/services', $service?->hero_image);
        $payload['highlight_image'] = $this->media->replaceImage($request, 'highlight_image', 'cms/services', $service?->highlight_image);
        $payload['feature_image'] = $this->media->replaceImage($request, 'feature_image', 'cms/services', $service?->feature_image);
        $payload['og_image'] = $this->media->replaceImage($request, 'og_image', 'cms/services', $service?->og_image);

        return $payload;
    }

    private function syncSections(Service $service, string $json): void
    {
        $sections = json_decode($json, true);
        $service->sections()->delete();

        if (! is_array($sections)) {
            return;
        }

        foreach ($sections as $index => $section) {
            if (! is_array($section) || empty($section['title'])) {
                continue;
            }

            $service->sections()->create([
                'title' => $section['title'],
                'copy' => $section['copy'] ?? null,
                'list_items' => $section['list_items'] ?? [],
                'copy_blocks' => $section['copy_blocks'] ?? [],
                'split_columns' => (bool) ($section['split_columns'] ?? false),
                'sort_order' => (int) ($section['sort_order'] ?? (($index + 1) * 10)),
            ]);
        }
    }

    private function lines(string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $value) ?: [])
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();
    }
}
