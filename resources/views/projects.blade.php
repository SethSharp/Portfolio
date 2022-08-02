<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Projects </title>
    @vite('resources/css/app.css')
</head>

<body class="mg-0 pd-0">
    <x-nav-bar projects="text-blue-800" ></x-nav-bar>

    <div class="mb-4 mt-8 sm:mt-16 px-10 sm:px-20 w-full">
        <h1 class="text-4xl font-bold text-black inline-block pr-2"> My </h1>
        <h1 class="text-4xl font-bold text-amber-400 inline-block"> Projects! </h1>
    </div>
    <div class="w-full">
        @component('components.project',
                    ['title' => 'YouHub',
                     'desc' => '
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Vestibulum blandit massa vitae efficitur auctor.
                        Integer ut dui hendrerit, finibus neque ac, venenatis purus.
                        Mauris feugiat commodo lorem, non cursus felis sodales nec.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                     ',
                     'technology' => ['JS',
                                      'Handle-Bars',
                                      'FaceBook SDK',
                                      'YouTube Data API v3'],
                     'dur' => '2 months',
                     'link' => 'https://github.com/SethSharp/YouHub',
                     'img_1' => 'blank',
                     'img_2' => 'blank',
        ]) @endcomponent
        @component('components.project',
                    ['title' => 'Time Recorder',
                     'desc' => '
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Vestibulum blandit massa vitae efficitur auctor.
                        Integer ut dui hendrerit, finibus neque ac, venenatis purus.
                        Mauris feugiat commodo lorem, non cursus felis sodales nec.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                     ',
                     'technology' => ['EJS',
                                      'Node/Express',
                                      'MongoDB'],
                     'dur' => '2 months',
                     'link' => 'https://github.com/SethSharp/TimeRecorder',
                     'img_1' => 'blank',
                     'img_2' => 'blank'
        ]) @endcomponent
        @component('components.project',
                    ['title' => 'Portfolio',
                     'desc' => '
                       Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Vestibulum blandit massa vitae efficitur auctor.
                        Integer ut dui hendrerit, finibus neque ac, venenatis purus.
                        Mauris feugiat commodo lorem, non cursus felis sodales nec.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                     ',
                     'technology' => ['Laravel',
                                      'Tailwind CSS',
                                      ],
                     'dur' => '2 months',
                     'link' => 'https://github.com/SethSharp/Portfolio',
                     'img_1' => 'blank',
                     'img_2' => 'blank'
        ]) @endcomponent
    </div>
</body>
</html>
