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


if (!function_exists('convert_to_english_numbers')) {
     /**
      * Converts Persian and Arabic numerals in a string to English numerals.
      *
      * This function takes a string containing Persian (۰-۹) and/or Arabic (٠-٩) numerals
      * and converts them to their corresponding English (0-9) numerals.
      *
      * @param string $string The input string containing Persian and/or Arabic numerals.
      * @return string The converted string with all numerals replaced by English numerals.
      */
     function convert_to_english_numbers($string) {
          $farsi_numbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
          $arabic_numbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
          $english_numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

          $converted_string = strtr($string, array_combine($farsi_numbers, $english_numbers));
          $converted_string = strtr($converted_string, array_combine($arabic_numbers, $english_numbers));

          return $converted_string;
     }
}

if (!function_exists('is_likely_persian')) {
     /**
      * Checks if a string likely contains Persian characters.
      *
      * This function scans a string to determine if it contains any characters
      * commonly used in the Persian (Farsi) language. It searches for letters,
      * including those with diacritics, as well as special Persian characters like 'ئ' and 'ي'.
      *
      * @param string $string The input string to be checked.
      * @return bool Returns true if the string contains any Persian characters, otherwise false.
      */
     function is_likely_persian($string) {
          $char_list = "[ابتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ ‍ـﻻﻷﻹﻻﻺﻶﻷެإآؤ]";
          return strpbrk($string, $char_list) !== false;
     }
}

if (!function_exists('convert_persian_string_for_sorting')) {
    /**
     * Convert Persian string to a comparable value for correct sorting.
     */
    function convert_persian_string_for_sorting($string)
    {
        $persianAlphabet = [
            'ا' => 1, 'ب' => 2, 'پ' => 3, 'ت' => 4, 'ث' => 5,
            'ج' => 6, 'چ' => 7, 'ح' => 8, 'خ' => 9, 'د' => 10,
            'ذ' => 11, 'ر' => 12, 'ز' => 13, 'ژ' => 14, 'س' => 15,
            'ش' => 16, 'ص' => 17, 'ض' => 18, 'ط' => 19, 'ظ' => 20,
            'ع' => 21, 'غ' => 22, 'ف' => 23, 'ق' => 24, 'ک' => 25,
            'گ' => 26, 'ل' => 27, 'م' => 28, 'ن' => 29, 'و' => 30,
            'ه' => 31, 'ی' => 32
        ];

        $comparableValue = '';
        for ($i = 0; $i < mb_strlen($string); $i++) {
            $char = mb_substr($string, $i, 1);
            if (isset($persianAlphabet[$char])) {
                $comparableValue .= str_pad($persianAlphabet[$char], 2, '0', STR_PAD_LEFT);
            }
        }

        return $comparableValue;
    }
}

if (!function_exists('sort_persian_alphabetically')) {
    /**
     * Sorts a given collection alphabetically based on the Persian alphabet.
     *
     * This helper function sorts a collection of objects or arrays by the first character of
     * a specified key (defaulting to 'name') according to the Persian alphabet order.
     * It ensures that words beginning with Persian characters are sorted correctly from
     * 'آ' to 'ی', including special characters like 'پ', 'چ', 'ژ', and 'گ'.
     *
     * Usage:
     * $sortedCollection = sort_persian_alphabetically($collection, 'name');
     *
     * @param \Illuminate\Support\Collection $collection The collection to be sorted.
     * @param string $key The key within the collection to sort by. Defaults to 'name'.
     * @return \Illuminate\Support\Collection The sorted collection.
     */
    function sort_persian_alphabetically($collection, $key = 'name')
    {
        $alphabet = [
            'آ', 'ا', 'ب', 'پ', 'ت', 'ث', 'ج', 'چ', 'ح', 'خ', 'د', 'ذ', 'ر', 'ز', 'ژ',
            'س', 'ش', 'ص', 'ض', 'ط', 'ظ', 'ع', 'غ', 'ف', 'ق', 'ک', 'گ', 'ل', 'م', 'ن',
            'و', 'ه', 'ی'
        ];

        return $collection->sort(function ($a, $b) use ($alphabet, $key) {
            $aFirstChar = mb_substr($a->$key, 0, 1);
            $bFirstChar = mb_substr($b->$key, 0, 1);

            $aPos = array_search($aFirstChar, $alphabet);
            $bPos = array_search($bFirstChar, $alphabet);

            return $aPos <=> $bPos;
        });
    }
}

if (!function_exists('remove_special_characters')) {
    /**
     * Removes specific special characters from a given string.
     *
     * This helper function takes a string as input and replaces all occurrences of the following special characters:
     * `\`, `/`, `.`, `,`, `-`, `_`, `*`, `` ` ``, `'`, `"`, `;`, `:` with an empty string.
     * It effectively cleans the string from these characters, which might be useful for sanitizing input,
     * preparing text for storage, or ensuring consistent formatting.
     *
     * Usage:
     * $cleanedString = remove_special_characters("Hello! This is a test-string, with some 'special' characters.");
     *
     * Output:
     * "Hello This is a teststring with some special characters"
     *
     * @param string $input The input string that needs to be cleaned.
     * @return string The cleaned string with specific special characters removed.
     */
    function remove_special_characters($input)
    {
        // Define a regex pattern to match all special characters that need to be removed
        $pattern = '/[\\\\\/\.,\-_`\*\'";:]/';

        // Replace all occurrences of the special characters with an empty string
        $cleanedString = preg_replace($pattern, '', $input);

        return $cleanedString;
    }
}
