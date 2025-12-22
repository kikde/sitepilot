<?php

// Lightweight shim for Form::select used in legacy blades.
// Only defines the class if not already provided by a package.
if (!class_exists('Form')) {
    class Form
    {
        /**
         * Render a simple <select> element.
         *
         * @param string $name
         * @param array $list key => label pairs
         * @param mixed $selected selected value(s) (string|array|null)
         * @param array $attributes html attributes (supports 'placeholder', 'multiple', 'id', 'class', ...)
         * @return string
         */
        public static function select(string $name, $list = [], $selected = null, array $attributes = []): string
        {
            // Normalise list to an array
            if ($list instanceof \Illuminate\Contracts\Support\Arrayable) {
                $list = $list->toArray();
            } elseif ($list instanceof \Traversable) {
                $list = iterator_to_array($list);
            } elseif (!is_array($list)) {
                $list = [];
            }
            // Determine selected from old input if present
            try {
                $old = function_exists('old') ? old($name) : null;
            } catch (\Throwable $e) {
                $old = null;
            }

            $isMultiple = array_key_exists('multiple', $attributes) && ($attributes['multiple'] === true || $attributes['multiple'] === 'multiple');

            if ($old !== null && $old !== '') {
                $selected = $old;
            }

            // Normalise selected to array if multiple
            $selectedValues = $isMultiple ? (array) $selected : [$selected];

            // Ensure id defaults to name
            if (!isset($attributes['id'])) {
                $attributes['id'] = $name;
            }

            // Ensure name[] for multiple
            $selectName = $name;
            if ($isMultiple && substr($selectName, -2) !== '[]') {
                $selectName .= '[]';
            }

            $attrHtml = self::attributes(array_merge(['name' => $selectName], $attributes));

            $html = [];
            $html[] = '<select ' . $attrHtml . '>';

            if (isset($attributes['placeholder'])) {
                $placeholder = (string) $attributes['placeholder'];
                $html[] = '<option value="">' . self::e($placeholder) . '</option>';
            }

            foreach ($list as $value => $label) {
                $isSelected = in_array((string) $value, array_map('strval', $selectedValues), true);
                $optAttrs = $isSelected ? ' selected' : '';
                $html[] = '<option value="' . self::e((string) $value) . '"' . $optAttrs . '>' . self::e((string) $label) . '</option>';
            }

            $html[] = '</select>';
            return implode("\n", $html);
        }

        private static function attributes(array $attributes): string
        {
            $parts = [];
            foreach ($attributes as $key => $value) {
                if (is_int($key)) {
                    // support boolean-ish attributes passed as list entries
                    $parts[] = self::e((string) $value);
                    continue;
                }

                if ($value === true) {
                    $parts[] = self::e($key);
                    continue;
                }

                if ($value === false || $value === null) {
                    continue;
                }

                $parts[] = self::e($key) . '="' . self::e((string) $value) . '"';
            }
            return implode(' ', $parts);
        }

        private static function e(string $value): string
        {
            return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
        }
    }
}
