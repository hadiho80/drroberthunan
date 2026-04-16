<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CmsMediaManager
{
    private const VIDEO_EXTENSIONS = ['mp4', 'mov', 'm4v', 'webm'];
    private const YOUTUBE_HOSTS = ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtu.be', 'www.youtu.be'];

    public function imageRules(bool $required = false, int $maxKilobytes = 4096): array
    {
        return [
            $required ? 'required' : 'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp,gif',
            'max:'.$maxKilobytes,
        ];
    }

    public function videoRules(bool $required = false, int $maxKilobytes = 307200): array
    {
        return [
            $required ? 'required' : 'nullable',
            'file',
            'mimetypes:video/mp4,video/quicktime,video/webm,video/x-m4v',
            'mimes:mp4,mov,webm,m4v',
            'max:'.$maxKilobytes,
        ];
    }

    public function replaceImage(Request $request, string $field, string $directory, ?string $currentPath = null): ?string
    {
        return $this->replaceFile($request, $field, $directory, $currentPath);
    }

    public function replaceVideo(Request $request, string $field, string $directory, ?string $currentPath = null): ?string
    {
        return $this->replaceFile($request, $field, $directory, $currentPath);
    }

    public function replaceFile(Request $request, string $field, string $directory, ?string $currentPath = null): ?string
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

    public function isVideoPath(?string $path): bool
    {
        if (! $path) {
            return false;
        }

        $extension = strtolower(pathinfo(parse_url($path, PHP_URL_PATH) ?: $path, PATHINFO_EXTENSION));

        return in_array($extension, self::VIDEO_EXTENSIONS, true);
    }

    public function isYoutubeUrl(?string $path): bool
    {
        if (! $path) {
            return false;
        }

        $host = strtolower(parse_url($path, PHP_URL_HOST) ?? '');

        return in_array($host, self::YOUTUBE_HOSTS, true);
    }

    public function youtubeVideoId(?string $path): ?string
    {
        if (! $this->isYoutubeUrl($path)) {
            return null;
        }

        $host = strtolower(parse_url($path, PHP_URL_HOST) ?? '');
        $videoId = null;

        if (str_contains($host, 'youtu.be')) {
            $videoId = trim(parse_url($path, PHP_URL_PATH) ?? '', '/');
        } else {
            parse_str(parse_url($path, PHP_URL_QUERY) ?? '', $query);
            $videoId = $query['v'] ?? null;
        }

        if (! is_string($videoId) || $videoId === '') {
            return null;
        }

        return preg_replace('/[^A-Za-z0-9_-]/', '', $videoId) ?: null;
    }

    public function youtubeEmbedUrl(?string $path): ?string
    {
        $videoId = $this->youtubeVideoId($path);

        return $videoId ? 'https://www.youtube.com/embed/'.$videoId.'?autoplay=1&rel=0' : null;
    }

    public function youtubeThumbnailUrl(?string $path): ?string
    {
        $videoId = $this->youtubeVideoId($path);

        return $videoId ? 'https://i.ytimg.com/vi/'.$videoId.'/hqdefault.jpg' : null;
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
