<?php

return [
    /**
     * Defines the current EB environment we are in
     */
    'current' => env('EB_ENVIRONMENT', 'seth'),

    /**
     * Seth environment values
     */
    'seth' => [
        'in_app_name' => 'Seth Sharp',

        'copyright' => '&copy; 2022-2024 Seth Sharp. All rights reserved.',

        'nav_links' => [
            [
                'href' => '/',
                'active' => 'home',
                'name' => 'About'
            ],
            [
                'href' => '/experience',
                'active' => 'experience',
                'name' => 'Experience'
            ],
            [
                'href' => '/projects',
                'active' => 'projects',
                'name' => 'Projects'
            ],
            [
                'href' => '/blogs',
                'active' => 'blogs',
                'name' => 'Blogs'
            ],
        ],

        'social_links' => [
            [
                'link' => 'https://github.com/SethSharp',
                'image' => 'github.png',
                'alt' => 'GitHub Image'
            ],
            [
                'link' => 'https://www.linkedin.com/in/seth-sharp-213bb3211/',
                'image' => 'linkedIn.png',
                'alt' => 'LinkedIn Image'
            ]
        ]
    ],

    /**
     * Beth environment values
     */
    'beth' => [
        'in_app_name' => 'Bethany Frankis',

        'copyright' => '&copy; 2024 Seth Sharp. All rights reserved.',

        'nav_links' => [],

        'social_links' => []
    ]
];