<?php

use Dapunabi\UiTemplate\Services\Renderer;
use Dapunabi\UiTemplate\Services\BlockRegistry;
use Dapunabi\UiTemplate\Services\Shortcode\ShortcodeParser;
use Dapunabi\UiTemplate\Services\Shortcode\ShortcodeRegistry;
use Dapunabi\UiTemplate\Models\Page;

it('renders hero block with props', function () {
    $blocks = new BlockRegistry();
    $blocks->load();
    $reg = new ShortcodeRegistry();
    $parser = new ShortcodeParser($reg);
    $renderer = new Renderer($blocks, $parser);

    $page = new Page([
        'data' => [
            'blocks' => [
                [ 'key' => 'hero', 'props' => ['title' => 'Hello', 'subtitle' => 'World'] ],
            ],
        ],
    ]);

    $html = $renderer->renderPage($page);
    expect($html)->toContain('Hello');
    expect($html)->toContain('World');
});

