<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Projects </title>
    @vite('resources/css/app.css')
</head>

<body class="mg-0 pd-0">

@php
    $technologyList = [
        ['EJS', 'Node/Express', 'MongoDB'],
        ['JS', 'Webpack', 'NodeJs', 'YouTube Data API v3'],
        ['Laravel', 'TailwindCSS', 'Database Design'],
        ['Angular/Ionic', 'TypeScript'],
    ];
@endphp

<x-nav-bar projects="text-black border-black"></x-nav-bar>

<div class="mt-2 pt-1 md:mt-8 md:pt-4">
    <x-title title1="My" title2="Projects"/>
</div>

<div class="w-full sm:mt-5 sm:py-5 px-10 sm:px-28">
    <div class="mx-auto shadow rounded-xl overflow-hidden p-4 bg-gray-50">
        <h1 class="text-3xl font-medium mb-4"> Habit Tracker </h1>
        <div class="w-full flex md:flex-wrap">
            <div class="w-full md:w-1/2">
                <img src="/images/projects/habit-tracker/dashboard.png"
                     class="object-cover w-full h-80 shadow"/>
            </div>
            <div class="w-full md:w-1/2 p-2 leading-loose">
                <p>
                    Habit Tracker is a major project of mine focusing on implementing my skills on the VILT stack
                    and testing new-found knowledge in AWS. This project is something that came from a small idea,
                    with input from friends into a publicly available app ready for use.
                </p>
                <br>
                <p>
                    Habit Tracker implements the Laravel Framework, with a simplistic Vue front end paired nicely
                    with Tailwind CSS with the modern monolith Inertia JS to connect everything together... with that
                    what is this app all about?
                </p>
            </div>
        </div>
        <div class="w-full flex md:flex-wrap mt-6">
            <div class="w-full md:w-1/2 p-2 leading-loose">
                <p>
                    Habit Tracker is fairly simple yet powerful, allowing you to track and remind you
                    of habits or even just general things that occur regularly. You can create habits that
                    will repeat on a given schedule you give; weekly (One day of each week), Daily (Multiple days of the
                    week)
                    or monthly (Once a month occurrence). With that you are given a week view of all your habits to help
                    focus your concentration, but for a more broad overlook you can use the calendar to view habits for
                    the month.
                    Including filtering of the habits based on type and completion status.
                </p>
            </div>
            <div class="w-full md:w-1/2">
                <img src="/images/projects/habit-tracker/calendar.png"
                     class="object-cover w-full h-80 shadow"/>
            </div>
        </div>
        <div class="w-full flex md:flex-wrap mt-6">
            <div class="w-full md:w-1/2">
                <img src="/images/projects/habit-tracker/habits.png"
                     class="object-cover w-full h-72 shadow"/>
            </div>
            <div class="w-full md:w-1/2 p-2 leading-loose">
                <div class="py-auto">
                    After a lot of experimenting and LOTS of research I was able to get a grip on AWS, first
                    deploying
                    this
                    portfolio you are seeing on a EC2 instance, but this was very tedious and manual. So I wanted
                    something different and
                    more automated. Which led me onto the Elastic Beanstalk and GitHub Actions. After some
                    configuration
                    and research habit Tracker
                    is fully running on this infrastructure as well as connected to an RDS
                </div>
            </div>
        </div>
    </div>

    {{--    <x-project.card--}}
    {{--        title="Time Recorder"--}}
    {{--        link="TimeRecorder"--}}
    {{--    >--}}
    {{--        This application used <b> EJS </b>, <b> Node/Express</b> and <b> Mongo </b> database--}}
    {{--        to construct a basic API application to keep track of time, for certain subjects.--}}
    {{--        This is a tool I used during university to keep track of the amount of time I--}}
    {{--        dedicated to subjects.--}}
    {{--    </x-project.card>--}}

    {{--    <x-project.card--}}
    {{--        title="YouHub"--}}
    {{--        link="YouHub"--}}
    {{--    >--}}
    {{--        This project was built for a subject during university, which taught us about <b> MVC</b>,--}}
    {{--        <b> Webpack</b> and implementing that with the <b> YouTube API </b>. This project built--}}
    {{--        a page which would allow the user to login via <b> Facebook </b> and based--}}
    {{--        on the pages they have liked, it would make a call to the Youtube API--}}
    {{--        to get the videos from the pages they had liked (requirement of the project was to implement--}}
    {{--        any 2 APIs).--}}
    {{--    </x-project.card>--}}

    {{--    <x-project.card--}}
    {{--        title="Blog Page"--}}
    {{--        link="BlogPage"--}}
    {{--    >--}}
    {{--        The Blog Page project was a task during placement with <b> Coding Labs </b> to implement the knowledge--}}
    {{--        we had learnt from an internal bootcamp. Which involved <b> CRUD</b> with Laravel, <b> User Authentication</b>--}}
    {{--        and <b> Authorisation</b>. This project taught me how useful and powerful Laravel is.--}}
    {{--    </x-project.card>--}}

    {{--    <x-project.card--}}
    {{--        title="Aussie Sport Knowledge"--}}
    {{--        link="Aussie-Sport-Knowledge"--}}
    {{--    >--}}
    {{--        This was another project from university and introduced us to web frameworks, in this case--}}
    {{--        it was <b> Angular </b> paired with <b> Ionic </b>. Originally this was an app I made with--}}
    {{--        Xcode back in high-school, which went live for a short time on the App Store.--}}
    {{--    </x-project.card>--}}
</div>
</body>
</html>
