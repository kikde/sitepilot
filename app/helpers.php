<?php

if (! function_exists('translate')) {
    function translate(string $key, array $replace = [], ?string $locale = null): string
    {
        return __($key, $replace, $locale);
    }
}

