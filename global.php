<?php

if (!function_exists('country_name')) {
    /**
     * Retrieves the country name corresponding to the given country code.
     *
     * @param string|null $code The two-letter ISO country code (case-insensitive). 
     *                          If null, returns an array of all country names.
     * @return string|array|null The country name corresponding to the given code, 
     *                           an array of all countries if code is null, 
     *                           or null if the code is not found.
     */
    function country_name($code = null) {
        $countries = [
            'ir' => 'Iran'
        ];

        if (is_null($code)) {
            return $countries;
        }

        $code = strtolower($code);
        return array_key_exists($code, $countries) ? $countries[$code] : null;
    }
}

if (!function_exists('client_ip')) {
    /**
     * Retrieves the client's IP address.
     *
     * This function checks various server headers that may contain the client's IP address,
     * accounting for proxies and different server configurations.
     *
     * @return string The client's IP address or '0.0.0.0' if it cannot be determined.
     */
    function client_ip() {
        $keys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];

        foreach ($keys as $key) {
            if (!empty($_SERVER[$key])) {
                $ip = explode(',', $_SERVER[$key])[0];
                return trim($ip);
            }
        }

        return '0.0.0.0';
    }
}

if (!function_exists('odd_or_even')) {
    /**
     * Determines whether a given number is odd or even.
     *
     * @param int $number The number to check.
     * @return string 'even' if the number is even, 'odd' if the number is odd.
     */
    function odd_or_even($number) {
        return ($number % 2 === 0) ? 'even' : 'odd';
    }
}

if (!function_exists('random_string')) {
    /**
     * Generates a random string of the specified length.
     *
     * This function creates a random string composed of numbers, uppercase and lowercase letters.
     *
     * @param int $length The desired length of the random string. Defaults to 10.
     * @return string The generated random string.
     */
    function random_string(int $length = 10): string {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}

if (!function_exists('human_readable_date')) {
    /**
     * Converts a given date string into a human-readable format.
     *
     * This function takes a date string and converts it into a more readable format based on the specified format.
     *
     * @param string $date The date string to convert.
     * @param string $format The format in which to display the date. Defaults to 'F j, Y, g:i a'.
     * @return string The formatted, human-readable date.
     */
    function human_readable_date(string $date, string $format = 'F j, Y, g:i a'): string {
        $timestamp = strtotime($date);
        return date($format, $timestamp);
    }
}
