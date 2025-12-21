<?php

namespace Dapunabi\UiTemplate\Services;

use Dapunabi\UiTemplate\Models\Block;

class BlockRegistry
{
    protected array $filesystem = [];
    protected array $database = [];

    public function load(): void
    {
        $this->filesystem = $this->loadFromFilesystem();
        $this->database = $this->loadFromDatabase();
    }

    public function all(): array
    {
        // DB overrides filesystem by key
        $merged = $this->filesystem;
        foreach ($this->database as $key => $manifest) {
            $merged[$key] = $manifest;
        }
        return $merged;
    }

    public function get(string $key): ?array
    {
        $all = $this->all();
        return $all[$key] ?? null;
    }

    protected function loadFromFilesystem(): array
    {
        $base = __DIR__.'/../Blocks';
        $out = [];
        if (! is_dir($base)) {
            return $out;
        }
        foreach (glob($base.'/*.json') as $file) {
            $json = @file_get_contents($file);
            if (! $json) continue;
            $data = json_decode($json, true);
            if (! is_array($data)) continue;
            $key = $data['key'] ?? $data['code'] ?? null;
            if (! $key) continue;
            $out[$key] = $this->normalizeManifest($data);
        }
        return $out;
    }

    protected function loadFromDatabase(): array
    {
        $out = [];
        foreach (Block::query()->where('active', true)->get() as $b) {
            $key = $b->code;
            $out[$key] = [
                'key' => $key,
                'name' => $b->name,
                'fields' => $b->schema ?: [],
                'defaults' => $b->defaults ?: [],
                'component' => $b->component ?? null,
                'preview' => $b->preview ?? null,
                'category' => $b->category ?? null,
                'version' => $b->version ?? 1,
                'ttl' => is_array($b->meta ?? null) && isset(($b->meta)['ttl']) ? (int) ($b->meta)['ttl'] : null,
                'source' => 'db',
            ];
        }
        return $out;
    }

    protected function normalizeManifest(array $data): array
    {
        return [
            'key' => $data['key'] ?? $data['code'] ?? '',
            'name' => $data['name'] ?? $data['title'] ?? '',
            'fields' => $data['fields'] ?? $data['schema'] ?? [],
            'defaults' => $data['defaults'] ?? [],
            'component' => $data['component'] ?? null,
            'preview' => $data['preview'] ?? null,
            'category' => $data['category'] ?? null,
            'version' => $data['version'] ?? 1,
            'ttl' => isset($data['ttl']) ? (int) $data['ttl'] : null,
            'source' => 'fs',
        ];
    }
}
