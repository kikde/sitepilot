<?php

namespace Dapunabi\Media\Services;

use Dapunabi\Media\Models\Media;
use Dapunabi\Media\Models\MediaVariant;
use Illuminate\Support\Facades\Storage;

class VariantGenerator
{
    /**
     * Generate image variants (thumb, medium, webp) if Intervention\Image is available.
     * Returns number of variants created.
     */
    public function generateImageVariants(Media $media): int
    {
        $created = 0;
        $disk = $media->disk ?: config('media-manager.disk','public');
        $sourcePath = Storage::disk($disk)->path($media->path);

        if (!class_exists(\Intervention\Image\ImageManager::class)) {
            return 0; // dependency not installed yet
        }

        // Use Intervention Image v3 style manager
        $driver = strtolower(config('media-manager.image_driver','gd')) === 'imagick' ? 'imagick' : 'gd';
        $manager = new \Intervention\Image\ImageManager([ 'driver' => $driver ]);
        $image = $manager->read($sourcePath);

        $variants = [
            ['name' => 'thumb', 'max' => 256],
            ['name' => 'small', 'max' => 512],
            ['name' => 'medium', 'max' => 1024],
        ];

        foreach ($variants as $v) {
            $img = $image->clone();
            $img->scaleDown(width: $v['max'], height: $v['max']);
            $rel = $this->variantPath($media->path, $v['name'], pathinfo($media->filename, PATHINFO_EXTENSION));
            Storage::disk($disk)->put($rel, (string) $img->encodeByPath($rel));
            $this->persistVariant($media, $v['name'], $rel);
            $created++;
        }

        // webp variant
        try {
            $img = $image->clone();
            $img->scaleDown(width: 1024, height: 1024);
            $rel = $this->variantPath($media->path, 'webp', 'webp');
            Storage::disk($disk)->put($rel, (string) $img->encode('webp', 85));
            $this->persistVariant($media, 'webp', $rel);
            $created++;
        } catch (\Throwable $e) {
            // ignore if driver doesn't support webp
        }

        return $created;
    }

    /**
     * Generate first page thumbnail for PDF using Imagick if available.
     * Returns true if thumbnail created.
     */
    public function generatePdfThumb(Media $media): bool
    {
        $disk = $media->disk ?: config('media-manager.disk','public');
        $source = Storage::disk($disk)->path($media->path);
        if (!class_exists('Imagick')) {
            return false;
        }
        try {
            $im = new \Imagick();
            $im->setResolution(144, 144);
            $im->readImage($source.'[0]'); // first page
            $im->setImageFormat('jpeg');
            $im->setImageCompressionQuality(85);
            // Scale down to a decent thumb
            $im->thumbnailImage(512, 512, true);
            $rel = $this->variantPath($media->path, 'thumb', 'jpg');
            Storage::disk($disk)->put($rel, $im);
            $this->persistVariant($media, 'thumb', $rel);
            $im->clear();
            $im->destroy();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    protected function variantPath(string $originalPath, string $name, string $ext): string
    {
        // original: tenants/{id}/media/YYYY/MM/DD/uuid.ext
        $dir = dirname($originalPath);
        return trim($dir, '/').'/'.'variants'.'/'.$name.'.'.$ext;
    }

    protected function persistVariant(Media $media, string $name, string $path): void
    {
        $mv = $media->variants()->updateOrCreate(['name' => $name], [
            'path' => $path,
        ]);
        $variants = $media->variants_json ?: [];
        $variants[$name] = $path;
        $media->variants_json = $variants;
        $media->save();
    }
}

