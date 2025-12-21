<?php

use Dapunabi\UiTemplate\Services\Shortcode\ShortcodeParser;
use Dapunabi\UiTemplate\Services\Shortcode\ShortcodeRegistry;
use Dapunabi\UiTemplate\Services\Shortcode\Handlers\CTAHandler;

it('parses cta shortcode', function () {
    $reg = new ShortcodeRegistry();
    $reg->register('cta', new CTAHandler());
    $parser = new ShortcodeParser($reg);
    $out = $parser->parse('Click [cta text="Go" url="/x"];');
    expect($out)->toContain('<a');
    expect($out)->toContain('Go');
});

it('leaves unknown shortcode intact', function () {
    $reg = new ShortcodeRegistry();
    $parser = new ShortcodeParser($reg);
    $out = $parser->parse('Hello [unknown foo=1]');
    expect($out)->toBe('Hello [unknown foo=1]');
});

