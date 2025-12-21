<?php

if (! function_exists('translate')) {
    function translate(string $key, array $replace = [], ?string $locale = null): string
    {
        return __($key, $replace, $locale);
    }
}

if (! function_exists('get_static_option')) {
    function get_static_option(string $key, mixed $default = null): mixed
    {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('static_options')) {
                return $default;
            }
            $row = \Illuminate\Support\Facades\DB::table('static_options')
                ->where('option_name', $key)
                ->first(['option_value']);
            return $row?->option_value ?? $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }
}

if (! function_exists('set_static_option')) {
    function set_static_option(string $key, mixed $value): void
    {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('static_options')) {
                return;
            }
            \Illuminate\Support\Facades\DB::table('static_options')->updateOrInsert(
                ['option_name' => $key],
                ['option_value' => is_scalar($value) || $value === null ? (string) $value : json_encode($value), 'updated_at' => now(), 'created_at' => now()]
            );
        } catch (\Throwable $e) {
            // ignore
        }
    }
}

// Lightweight Image facade compatibility:
// Old code expects `Image::make(...)->resize(...)->save(...)`.
// If Intervention/Image is not installed, provide a minimal fallback so uploads don't 500.
if (! class_exists('Image')) {
    class Image
    {
        public static function make($input): \App\Support\ImageProxy
        {
            return new \App\Support\ImageProxy($input);
        }
    }
}
