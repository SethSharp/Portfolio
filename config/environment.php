<?php

return [
    /**
     * Defines the current EB environment we are in
     */
    'current' => env('EB_ENVIRONMENT', 'seth'),

    /**
     * Seth environment values
     */
    \App\Http\EnvironmentEnum::SETH->value => [
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
                'link' => 'https://www.linkedin.com/in/seth-sharp/',
                'image' => 'linkedIn.png',
                'alt' => 'LinkedIn Image'
            ]
        ]
    ],

    /**
     * Beth environment values
     */
    \App\Http\EnvironmentEnum::BETH->value => [
        'in_app_name' => 'Bethany Frankis',

        'copyright' => '&copy; 2024 Bethany Frankis. All rights reserved.',

        'nav_links' => [
            [
                'href' => '/',
                'active' => 'home',
                'name' => 'About'
            ],
        ],

        'social_links' => [
            [
                'link' => 'https://www.linkedin.com/in/bethanyfrankis/',
                'image' => 'linkedIn.png',
                'alt' => 'LinkedIn Image'
            ]
        ]
    ]
];
