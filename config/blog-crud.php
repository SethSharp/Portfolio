<?php

use SethSharp\BlogCrud\Models\File;
use Intervention\Image\ImageManager;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Models\Blog\Like;
use SethSharp\BlogCrud\Models\Blog\Comment;
use SethSharp\BlogCrud\Models\Blog\Collection;

return [
    /*
    |--------------------------------------------------------------------------
    | Bucket Paths
    |--------------------------------------------------------------------------
    |
    | Allows the option for users to define their own location for
    | local/production paths for the s3 bucket
    */
    'bucket_paths' => [
        'local' => 'testing/',
        'production' => 'production/'
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Allows the option for users to define their own driver
    */
    'image_driver' => ImageManager::gd(),

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | Allows the option for users to define their custom models
    | which will automatically be applied to relationships throughout the package
    */
    'models' => [
        'blog' => [
            'blog' => Blog::class,
            'collection' => Collection::class,
            'comment' => Comment::class,
            'like' => Like::class,
            'tag' => Tag::class,
        ],
        'file' => [
            'file' => File::class,
        ],
        'iam' => [
            'user' => User::class,
        ]
    ]
];
