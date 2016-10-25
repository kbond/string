<?php

if (!function_exists('remove_whitespace')) {
    /**
     * Replaces "&nbsp;" with a single space and converts multiple sequential spaces into a single space.
     *
     * @param string $str
     *
     * @return string
     */
    function remove_whitespace($str)
    {
        return preg_replace('/\s+/', ' ', str_replace('&nbsp;', ' ', $str));
    }
}

if (!function_exists('null_trim')) {
    /**
     * Similar to core "trim" but returns null instead of an empty string
     * When an array is passed, all elements get processed recursively.
     *
     * @param string|array $data
     * @param null|string  $character_mask
     *
     * @return array|null|string
     */
    function null_trim($data, $character_mask = null)
    {
        if (is_array($data)) {
            return array_map(
                function ($value) use ($character_mask) {
                    return null_trim($value, $character_mask);
                },
                $data
            );
        }

        $trimmedValue = null === $character_mask ? trim($data) : trim($data, $character_mask);

        if ($trimmedValue === '') {
            return null;
        }

        return $trimmedValue;
    }
}

if (!function_exists('truncate_word')) {
    /**
     * Truncates text to a length without breaking words.
     *
     * @param string $str
     * @param int    $length
     * @param string $suffix
     *
     * @return string
     */
    function truncate_word($str, $length = 255, $suffix = '...')
    {
        $output = remove_whitespace(trim($str));

        if (strlen($output) > $length) {
            $output = wordwrap($output, $length - strlen($suffix));
            $output = substr($output, 0, strpos($output, "\n"));
            $output .= $suffix;
        }

        return strlen($output) > $length ? '' : $output;
    }
}
