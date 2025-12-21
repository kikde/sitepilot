<?php

namespace Dapunabi\UiTemplate\Services\Shortcode;

class ShortcodeRegistry
{
    protected array $handlers = [];

    public function register(string $tag, ShortcodeInterface $handler): void
    {
        $this->handlers[strtolower($tag)] = $handler;
    }

    public function has(string $tag): bool
    {
        return array_key_exists(strtolower($tag), $this->handlers);
    }

    public function get(string $tag): ?ShortcodeInterface
    {
        return $this->handlers[strtolower($tag)] ?? null;
    }
}

