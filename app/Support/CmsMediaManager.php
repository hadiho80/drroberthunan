<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CmsMediaManager
{
    public function imageRules(bool $required = false, int $maxKilobytes = 4096): array
    {
        return [
            $required ? 'required' : 'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp,gif',
            'max:'.$maxKilobytes,
        ];
    }

    public function replaceImage(Request $request, string $field, string $directory, ?string $currentPath = null): ?string
    {
        if (! $request->hasFile($field)) {
            return $currentPath;
        }

        $storedPath = $request->file($field)->store($directory, 'public');

        if ($currentPath && $currentPath !== $storedPath) {
            $this->deleteManagedFile($currentPath);
        }

        return $storedPath;
    }

    public function deleteManagedFile(?string $path): void
    {
        if (! $this->isManagedPath($path)) {
            return;
        }

        Storage::disk('public')->delete($path);
    }

    public function isManagedPath(?string $path): bool
    {
        if (! $path) {
            return false;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return false;
        }

        if (str_starts_with($path, 'assets/') || str_starts_with($path, '/')) {
            return false;
        }

        return true;
    }
}
