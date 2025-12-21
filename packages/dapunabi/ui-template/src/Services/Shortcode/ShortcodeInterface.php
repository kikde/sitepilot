<?php

namespace Dapunabi\UiTemplate\Services\Shortcode;

interface ShortcodeInterface
{
    /**
     * @param array $attrs Parsed attributes from the tag
     * @param string|null $content Inner content between [tag]...[/tag]
     * @param array $context Rendering context (e.g., tenant, page)
     * @return string HTML output (must be sanitized)
     */
    public function render(array $attrs = [], ?string $content = null, array $context = []): string;
}
