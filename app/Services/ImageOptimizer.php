<?php

namespace App\Services;

use Filament\Forms\Components\BaseFileUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImageOptimizer
{
    private const MAX_WIDTH = 1600;

    private const WEBP_QUALITY = 80;

    /**
     * Filament `saveUploadedFileUsing` callback: resizes oversized images and
     * converts them to WebP before storing, so uploads are served in a modern,
     * properly-sized format without a manual step in the admin panel.
     */
    public static function store(BaseFileUpload $component, TemporaryUploadedFile $file): ?string
    {
        try {
            if (! $file->exists()) {
                return null;
            }

            $converted = self::convertToWebp($file);

            if ($converted === null) {
                return $component->saveUploadedFile($file);
            }

            [$binary, $extension] = $converted;

            $directory = trim($component->getDirectory(), '/');
            $path = trim($directory . '/' . Str::ulid() . '.' . $extension, '/');

            $disk = Storage::disk($component->getDiskName());
            $disk->put($path, $binary);

            if ($component->getVisibility() === 'public') {
                rescue(fn () => $disk->setVisibility($path, 'public'), report: false);
            }

            return $path;
        } catch (\Throwable $e) {
            Log::warning('ImageOptimizer: falling back to default upload storage', [
                'message' => $e->getMessage(),
            ]);

            return $component->saveUploadedFile($file);
        }
    }

    /**
     * Returns [binaryWebpData, 'webp'] on success, or null when the file isn't
     * a format GD can safely re-encode (e.g. SVG, animated GIF).
     *
     * @return array{0: string, 1: string}|null
     */
    private static function convertToWebp(UploadedFile $file): ?array
    {
        if (! function_exists('imagewebp')) {
            return null;
        }

        $mime = $file->getMimeType();

        if (! in_array($mime, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'], true)) {
            // SVGs and other non-raster formats are kept as-is.
            return null;
        }

        // Animated GIFs would lose their animation if re-encoded frame-by-frame; skip them.
        if ($mime === 'image/gif' && self::isAnimatedGif($file->getRealPath())) {
            return null;
        }

        $source = match ($mime) {
            'image/jpeg' => @imagecreatefromjpeg($file->getRealPath()),
            'image/png' => @imagecreatefrompng($file->getRealPath()),
            'image/gif' => @imagecreatefromgif($file->getRealPath()),
            'image/webp' => @imagecreatefromwebp($file->getRealPath()),
            default => null,
        };

        if (! $source) {
            return null;
        }

        $width = imagesx($source);
        $height = imagesy($source);

        if ($width > self::MAX_WIDTH) {
            $newWidth = self::MAX_WIDTH;
            $newHeight = (int) round($height * ($newWidth / $width));

            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            imagedestroy($source);
            $source = $resized;
        } else {
            imagealphablending($source, false);
            imagesavealpha($source, true);
        }

        ob_start();
        imagewebp($source, null, self::WEBP_QUALITY);
        $binary = ob_get_clean();
        imagedestroy($source);

        if (! $binary) {
            return null;
        }

        return [$binary, 'webp'];
    }

    private static function isAnimatedGif(string $path): bool
    {
        $contents = file_get_contents($path);

        if ($contents === false) {
            return false;
        }

        return substr_count($contents, "\x00\x21\xF9\x04") > 1;
    }
}
