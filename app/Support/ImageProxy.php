<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

class ImageProxy
{
    private mixed $input;
    private ?string $encoded = null;

    public function __construct(mixed $input)
    {
        $this->input = $input;
    }

    public function orientate(): self
    {
        return $this;
    }

    public function resize(int $width, int $height, ?callable $callback = null): self
    {
        return $this;
    }

    public function encode(?string $format = null, int $quality = 90): self
    {
        $this->encoded = $this->readBytes();
        return $this;
    }

    public function save(string $path, int $quality = 90): self
    {
        $dir = dirname($path);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $bytes = $this->encoded ?? $this->readBytes();
        file_put_contents($path, $bytes);

        return $this;
    }

    public function __toString(): string
    {
        return $this->encoded ?? $this->readBytes();
    }

    private function readBytes(): string
    {
        $input = $this->input;

        // UploadedFile
        if ($input instanceof UploadedFile) {
            // getRealPath() can be empty; pathname is more reliable on Windows/Laragon
            $path = $input->getRealPath() ?: $input->getPathname();
            if (!$path && method_exists($input, 'path')) {
                $path = $input->path();
            }
            return $path ? (string) file_get_contents($path) : '';
        }

        // String path
        if (is_string($input)) {
            return is_file($input) ? (string) file_get_contents($input) : '';
        }

        // SplFileInfo-ish
        if (is_object($input) && method_exists($input, 'getRealPath')) {
            $path = $input->getRealPath();
            return $path ? (string) file_get_contents($path) : '';
        }

        return '';
    }
}
