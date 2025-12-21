<?php

use Dapunabi\UiTemplate\Services\Renderer;
use Dapunabi\UiTemplate\Services\BlockRegistry;
use Dapunabi\UiTemplate\Services\Shortcode\ShortcodeParser;
use Dapunabi\UiTemplate\Services\Shortcode\ShortcodeRegistry;
use Dapunabi\UiTemplate\Services\TemplateRenderer;
use Dapunabi\UiTemplate\Models\Page;

it('caches rendered output per tenant and slug', function () {
    $blocks = new BlockRegistry();
    $blocks->load();
    $parser = new ShortcodeParser(new ShortcodeRegistry());
    $renderer = new Renderer($blocks, $parser);
    $tr = new TemplateRenderer($renderer, $blocks);

    $page = new Page([
        'tenant_id' => 123,
        'slug' => 'home',
        'data' => ['blocks' => [[ 'key' => 'footer', 'props' => ['copyright' => 'X'] ]]],
    ]);

    $a = $tr->renderCached($page);
    $b = $tr->renderCached($page);
    expect($a)->toBe($b);
});

