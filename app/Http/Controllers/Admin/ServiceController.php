<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
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
        $data = $this->validatedData($request);
        $service->update($this->payload($request, $data, $service));
        $this->syncSections($service, $data['sections_json'] ?? '[]');

        return redirect()->route('admin.services.index')->with('status', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Layanan berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
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
            'sections_json' => ['nullable', 'string'],
            'card_icon' => ['nullable', 'image', 'max:4096'],
            'card_image' => ['nullable', 'image', 'max:4096'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
            'highlight_image' => ['nullable', 'image', 'max:4096'],
            'feature_image' => ['nullable', 'image', 'max:4096'],
        ]);
    }

    private function payload(Request $request, array $data, ?Service $service = null): array
    {
        $payload = [
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['intro'] ?? $data['card_description'] ?? $data['title'],
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
        ];

        foreach (['card_icon', 'card_image', 'hero_image', 'highlight_image', 'feature_image'] as $field) {
            if ($request->hasFile($field)) {
                $payload[$field] = $request->file($field)->store('services', 'public');
            } elseif ($service && $service->{$field}) {
                $payload[$field] = $service->{$field};
            }
        }

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
