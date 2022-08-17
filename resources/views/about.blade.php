<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title> About </title>
</head>

<body class="mg-0 pd-0">

    <x-nav-bar about="text-black border-black"></x-nav-bar>
    <div class="h-6"></div>
    <x-title t_1="About" t_2="Me"> </x-title>

    <div class="bg-red-100 items-center flex flex-wrap justify-center w-full h-auto">
        <div class="z-10  bg-white border border-gray-300 rounded-3xl h-44 w-3/4">
            <h1 class="pl-10 py-2 font-medium text-2xl"> Who am I? </h1>
            <div class="z-20 relative bg-gray-300 border border-black rounded-3xl h-44 w-full
                    mt-1 ml-8 p-3">
                <p class=""> G'day I'm Seth, well besides the typical, 'Hey I study Computer Science and
                    love software', this is me. I'm currently living on the Gold Coast, studying and
                    working part-time at Dominos. As much as I love to study and work, I need my down time,
                    Friday night footy  (If i dont get called into work) is always a life saver and
                    playing games with my friends are my favourite ways to chill out after a big week.</p>
            </div>
        </div>

    </div>
{{--    <div class="items-center flex flex-wrap justify-center w-full p-6">--}}
{{--        <div class="w-3/4 pt-2.5">--}}
{{--            <h1 class="text-2xl font-bold text-gray-400"> Who am I? </h1>--}}
{{--            <div class="pl-4 sm:pl-14 pb-8 flex flex-wrap">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                    <p class="w-full sm:w-1/2 my-auto">--}}
{{--                        G'day I'm Seth, well besides the typical, 'Hey I study Computer Science and--}}
{{--                        love software', this is me. I'm currently living on the Gold Coast, studying and--}}
{{--                        working part-time at Dominos. As much as I love to study and work, I need my down time,--}}
{{--                        Friday night footy  (If i dont get called into work) is always a life saver and--}}
{{--                        playing games with my friends are my favourite ways to chill out after a big week.--}}
{{--                    </p>--}}
{{--                    <div class="w-full sm:w-1/2">--}}
{{--                        <div class="flex justify-center">--}}
{{--                            <img class="object-contain h-full w-60 p-3 pb-1 pt-12"--}}
{{--                                 src="/images/forest.png"--}}
{{--                                 alt="about-picture">--}}
{{--                        </div>--}}
{{--                        <div class="flex justify-center">--}}
{{--                                <x-tag tag="Fraser inland track"> </x-tag>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <br>--}}

{{--                <div class="flex flex-wrap">--}}
{{--                    <p class="w-full my-auto sm:pr-14">--}}
{{--                        I have been into technology since high school, where I created my first few apps--}}
{{--                        with XCode and uploaded a couple. Since then, I have dedicated my school subjects--}}
{{--                        towards a career in Software Development. Yes, I have looked back when I want to pull my--}}
{{--                        hair out from the smallest of bugs, but it always changed my mind when I figured it out... finally--}}
{{--                        and that's why I love it.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <h1 class="text-2xl font-bold text-gray-500 pt-4"> My Goals </h1>--}}
{{--            <div class="pl-4 sm:pl-14 py-8 flex flex-wrap">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                    <p class="w-full my-auto">--}}
{{--                        My overall goal, coming fresh out of uni is to land a junior developer role.--}}
{{--                        My current area of interest is in the fullstack expertise. But if there--}}
{{--                        are opportunities in different areas, I won't hesitate to have a crack. Further down--}}
{{--                        the track I do want to become a Senior Developer at a company and be able to coach young--}}
{{--                        players like myself in the future, I always had a soft spot for teaching and that would be--}}
{{--                        perfect.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <h1 class="text-2xl font-bold text-gray-500 pt-4"> My Hobbies </h1>--}}
{{--            <div class="pl-4 sm:pl-14 py-4 flex flex-wrap">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                    <p class="w-full sm:w-1/2 my-auto">--}}
{{--                        With having so much going on with 2 jobs and uni.--}}
{{--                        There isn't a whole lot of time to have a hobby.--}}
{{--                        But when I do I love 4WDing and going camping with--}}
{{--                        my mates. I love doing this as it completely disconnects you from the world and--}}
{{--                        allows you to fully wind down and clear your mind. A perfect example of this--}}
{{--                        was a week long Fraser Island trip I did with my friends. Hardly any signal--}}
{{--                        and nothing but remote camps, great feeds and memories.--}}
{{--                    </p>--}}
{{--                    <div class="w-full sm:w-1/2">--}}
{{--                        <div class="flex justify-center">--}}
{{--                            <img class="object-contain h-full w-60 p-3 pb-1 pt-12"--}}
{{--                                 src="/images/car.jpg"--}}
{{--                                 alt="about-picture">--}}
{{--                        </div>--}}
{{--                        <div class="flex justify-center">--}}
{{--                            <x-tag tag="The Mighty Triton"> </x-tag>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <h1 class="text-2xl font-bold text-gray-500 pt-4"> The University Journey </h1>--}}
{{--            <div class="pl-4 sm:pl-14 py-8 flex flex-wrap">--}}
{{--                <div class="flex flex-wrap">--}}
{{--                    <p class="w-full my-auto">--}}
{{--                        The past few years have been quite interesting and to put into a nutshell. I spent 4 weeks--}}
{{--                        in-person study in 2020 until covid hit and the rest of that year was studying from Griffiths--}}
{{--                        campus. Second year same story and saved a whole lot of money and studied from home.--}}
{{--                        Although this may sound bad, I got a good opportunity out of it which was a job at Dominos.--}}
{{--                        Which benefited me greatly with funding camping adventures and avoiding eating noodles for--}}
{{--                        breakfast lunch and dinner for this year at uni. I knew I had to come down to the Gold Coast--}}
{{--                        in this last year to find full-time work and complete the Griffiths WIL internship program.--}}
{{--                        I had been working towards getting a opportunity in this since before my degree started.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</body>
</html>
