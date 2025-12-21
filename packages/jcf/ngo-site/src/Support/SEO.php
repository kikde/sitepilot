<?php

namespace Jcf\NgoSite\Support;

class SEO
{
    public static function generate(bool $minify = false): string
    {
        $setting = null;
        try {
            $setting = view()->shared('setting');
        } catch (\Throwable $e) {
            $setting = null;
        }

        $title = $setting->title ?? config('app.name', 'NGO Site');
        $author = $setting->meta_author ?? '';
        $description = $setting->meta_description ?? '';
        $keywords = $setting->meta_keywords ?? '';

        $tags = [];
        $tags[] = '<title>' . e($title) . '</title>';
        if ($description !== '') {
            $tags[] = '<meta name="description" content="' . e($description) . '">';
        }
        if ($keywords !== '') {
            $tags[] = '<meta name="keywords" content="' . e($keywords) . '">';
        }
        if ($author !== '') {
            $tags[] = '<meta name="author" content="' . e($author) . '">';
        }

        return $minify ? implode('', $tags) : implode("\n", $tags);
    }
}

