<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Projects </title>
    @vite('resources/css/app.css')
</head>

<body class="mg-0 pd-0">
    <x-nav-bar projects="text-black border-black" ></x-nav-bar>

    <div class="mt-12 sm:mt-8 px-20 w-full">
        <h1 class="text-4xl font-bold text-black inline-block pr-2"> My </h1>
        <h1 class="text-4xl font-bold text-amber-400 inline-block"> Projects! </h1>
    </div>
    <div class="w-full mt-5 py-5 px-28">
        @component('components.project',
                    ['title' => 'Time Recorder',
                     'desc' => '
                        I made a habit in 2021 of making my own software applications that
                        would help with uni. This is one of those that I haven`t broken
                        and was able to finish off. This project allows me to effectively
                        record the time I would spend on subjects. Saving it to MongoDB
                        and allow me to analyse over the weeks how my work rate would
                        change from week to week.
                     ',
                     'technology' => ['EJS',
                                      'Node/Express',
                                      'MongoDB'],
                     'link' => 'TimeRecorder',
                     'dur' => '2 months',
                     'img_1' => 'TR/MainRecording.jpg',
                     'img_2' => 'TR/TotalTimes.jpg'
        ]) @endcomponent
        @component('components.project',
                ['title' => 'YouHub',
                 'desc' => '
                    This project was built for a subject, which taught us the MVC,
                    Webpack integration and using API requests. This project built
                    a page which would allow the user to login view Facebook and based
                    on the pages they have liked would make a call to the Youtube API
                    to get the videos from these creators.
                 ',
                 'technology' => ['JS',
                                  'Facebook SDK',
                                  'Webpack',
                                  'YouTube Data API v3'],
                 'link' => 'YouHub',
                 'dur' => '2 months',
                 'img_1' => 'blank.png',
                 'img_2' => 'blank.png',
    ]) @endcomponent
    @component('components.project',
                ['title' => 'Blog Page',
                 'desc' => '
                    This Blog Page was made as a project at the Coding Labs
                    internship. This project showed me how useful Laravel is
                    to integrate a database and make relationships,
                    user authentication and authorisation and implementing all this
                    in a MVC format.
                 ',
                 'technology' => ['Laravel',
                                  'TailwindCSS',
                                  'Database Design'],
                 'link' => 'BlogPage',
                 'dur' => '2 months',
                 'img_1' => 'blank.png',
                 'img_2' => 'blank.png',
    ]) @endcomponent
    @component('components.project',
                ['title' => 'Aussie Sport Knowledge',
                 'desc' => '
                   This was another project from uni and introduced me to web frameworks.
                   Originally this was an app I made with Xcode back in high-school, which was
                   actually live for a year or so before it was too expensive to keep up.
                 ',
                 'technology' => ['Angular/Ionic',
                                  'TypeScript'],
                 'link' => 'Aussie-Sport-Knowledge',
                 'dur' => '2 months',
                 'img_1' => 'ASK/menu.png',
                 'img_2' => 'ASK/game.png'
    ]) @endcomponent
    </div>
</body>
</html>
