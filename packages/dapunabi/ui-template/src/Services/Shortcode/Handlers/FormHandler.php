<?php

namespace Dapunabi\UiTemplate\Services\Shortcode\Handlers;

use Dapunabi\UiTemplate\Services\Shortcode\ShortcodeInterface;

class FormHandler implements ShortcodeInterface
{
    public function render(array $attrs = [], ?string $content = null, array $context = []): string
    {
        $name = $attrs['name'] ?? 'contact';
        // Minimal demo form; in real implementation, route to a controller
        $action = htmlspecialchars($attrs['action'] ?? '#', ENT_QUOTES, 'UTF-8');
        return <<<HTML
<form method="post" action="{$action}" class="uitpl-form uitpl-form-{$name}">
  <input type="hidden" name="_token" value="" />
  <div class="mb-2"><input name="name" placeholder="Your name" class="form-control" /></div>
  <div class="mb-2"><input type="email" name="email" placeholder="Your email" class="form-control" /></div>
  <div class="mb-2"><textarea name="message" placeholder="Message" class="form-control" rows="4"></textarea></div>
  <button class="btn btn-primary" type="submit">Send</button>
</form>
HTML;
    }
}
