<?php

return [
    /*
     * API Key for DeepL.
     * This key can be obtained on https://www.deepl.com/
     */
    'deepl_api_key' => env('DEEPL_API_KEY', '2ad30f8b-77ed-56d5-7d6f-11f20265eb88'),

    // https://api-free.deepl.com/v2/translate
    'deepl_url' => env('DEEPL_API_URL', 'https://api.deepl.com/v2/translate'),

    /**
     * The formality parameter. One of: "default", "more", or "less"
     * @see https://www.deepl.com/docs-api/translating-text/
     */
    'formality' => 'default',
    /**
     * Sets whether the translation engine should respect the original formatting,
     * even if it would usually correct some aspects. Possible values are:
     * "0" (default)
     * "1"
     * @see https://www.deepl.com/docs-api/translating-text/
     */
    'preserve_formatting' => "0"
];
