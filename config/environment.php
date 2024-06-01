<?php

use App\Http\EnvironmentEnum;

return [
    /**
     * Defines the current EB environment we are in
     */
    'current' => env('EB_ENVIRONMENT', 'seth'),

    /**
     * Seth environment values
     */
    EnvironmentEnum::SETH->value => [
        'in_app_name' => 'Seth Sharp',

        'copyright' => '&copy; 2022-2024 Seth Sharp. All rights reserved.',

        'nav_links' => [
            [
                'href' => '/',
                'active' => '/',
                'name' => 'Home'
            ],
            [
                'href' => '/projects',
                'active' => 'projects',
                'name' => 'Projects'
            ],
            [
                'href' => '/experience',
                'active' => 'experience',
                'name' => 'Experience'
            ],
            [
                'href' => '/blogs',
                'active' => 'blogs',
                'name' => 'Blogs'
            ],
            [
                'href' => '/contact',
                'active' => 'contact',
                'name' => 'Contact'
            ]
        ],

        'social_links' => [
            [
                'link' => 'https://github.com/SethSharp',
                'image' => 'github-icon.png',
                'alt' => 'GitHub Image',
                'name' => 'GitHub'
            ],
            [
                'link' => 'https://www.linkedin.com/in/seth-sharp/',
                'image' => 'linkedin-icon.png',
                'alt' => 'LinkedIn Image',
                'name' => 'LinkedIn'
            ],
            [
                'link' => 'mailto:sesharp@outlook.com',
                'image' => 'email-icon.png',
                'alt' => 'Email Image',
                'name' => 'Email'
            ],
            [
                'link' => 'https://x.com/seth_sharp_01',
                'image' => 'x-icon.png',
                'alt' => 'X Image',
                'name' => 'Twitter'
            ]
        ]
    ],

    /**
     * Beth environment values
     */
    EnvironmentEnum::BETH->value => [
        'in_app_name' => 'Bethany Frankis',

        'copyright' => '&copy; 2023-2024 Bethany Frankis. All rights reserved.',

        'nav_links' => [
            [
                'href' => '/',
                'active' => '/',
                'name' => 'Home'
            ],
            [
                'href' => '/education-course-work',
                'active' => 'education-course-work',
                'name' => 'Education | Course Work'
            ],
            [
                'href' => '/blogs',
                'active' => 'blogs',
                'name' => 'My Blogs'
            ],
            [
                'href' => '/contact',
                'active' => 'contact',
                'name' => 'Contact Me'
            ],
        ],

        'social_links' => [
            [
                'name' => 'LinkedIn',
                'link' => 'https://www.linkedin.com/in/bethanyfrankis/',
                'image' => 'linkedIn.png',
                'alt' => 'LinkedIn Image'
            ],
            [
                'name' => 'Email',
                'link' => 'mailto:b.frankis@outlook.com',
                'image' => 'email.png',
                'alt' => 'Email Image'
            ]
        ]
    ]
];
