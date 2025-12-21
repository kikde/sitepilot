<?php

namespace Dapunjabi\CoreAuth\Support;

class AdminNavRegistry
{
    /** @var array<string,array{key:string,label:string,order:int,items:array<int,array>}> */
    protected array $sections = [];

    public function section(string $key, string $label, int $order = 100): self
    {
        if (!isset($this->sections[$key])) {
            $this->sections[$key] = [
                'key' => $key,
                'label' => $label,
                'order' => $order,
                'items' => [],
            ];
        } else {
            $this->sections[$key]['label'] = $label;
            $this->sections[$key]['order'] = $order;
        }
        return $this;
    }

    /**
     * Item keys (recommended):
     * - label (string), icon (string|null), route (string|null), url (string|null)
     * - order (int), platform (bool), permission (string|null)
     * - children (array<int,array>)
     */
    public function add(string $sectionKey, array $item): self
    {
        if (!isset($this->sections[$sectionKey])) {
            $this->section($sectionKey, $sectionKey);
        }
        $item['order'] = (int)($item['order'] ?? 100);
        $this->sections[$sectionKey]['items'][] = $item;
        return $this;
    }

    /** @return array<int,array{key:string,label:string,order:int,items:array<int,array>}> */
    public function all(): array
    {
        $sections = array_values($this->sections);
        usort($sections, fn($a, $b) => ($a['order'] <=> $b['order']) ?: strcmp($a['label'], $b['label']));
        foreach ($sections as &$sec) {
            usort($sec['items'], fn($a, $b) => (($a['order'] ?? 100) <=> ($b['order'] ?? 100)) ?: strcmp(($a['label'] ?? ''), ($b['label'] ?? '')));
            foreach ($sec['items'] as &$it) {
                if (!empty($it['children']) && is_array($it['children'])) {
                    usort($it['children'], fn($a, $b) => (($a['order'] ?? 100) <=> ($b['order'] ?? 100)) ?: strcmp(($a['label'] ?? ''), ($b['label'] ?? '')));
                }
            }
        }
        return $sections;
    }
}

