<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default SEO Settings
    |--------------------------------------------------------------------------
    */
    'default_description' => env('SEO_DEFAULT_DESCRIPTION', 'Professional Laravel development services'),
    'twitter_handle' => env('SEO_TWITTER_HANDLE', '@yourhandle'),
    'fb_app_id' => env('SEO_FB_APP_ID', ''),
    'keywords' => explode(',', env('SEO_DEFAULT_KEYWORDS', 'laravel,php,web-development,seo')),
    
    /*
    |--------------------------------------------------------------------------
    | Open Graph Defaults
    |--------------------------------------------------------------------------
    */
    'og_default_image' => env('SEO_OG_DEFAULT_IMAGE', 'images/og-default.jpg'),
    
    /*
    |--------------------------------------------------------------------------
    | Canonical URL Settings
    |--------------------------------------------------------------------------
    */
    'canonical' => [
        'enabled' => true,
        'auto' => true,
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Robots Settings
    |--------------------------------------------------------------------------
    */
    'robots' => [
        'default' => 'index, follow',
        'allow' => ['*'],
        'disallow' => ['/admin/*', '/login', '/register'],
    ],
];
