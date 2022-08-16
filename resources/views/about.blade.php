<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title> About </title>
</head>

<body class="mg-0 pd-0">

    <x-nav-bar about="text-black border-black" ></x-nav-bar>

    <div class="mt-12 sm:mt-8 px-20 w-full">
        <h1 class="text-4xl font-bold text-black inline-block pr-2"> About </h1>
        <h1 class="text-4xl font-bold text-amber-400 inline-block"> Me! </h1>
    </div>
    <div class="items-center flex flex-wrap justify-center w-full p-6">
        <div class="w-3/4 pt-2.5">
            <h1 class="text-2xl font-bold text-gray-500"> Who am I? </h1>
            <div class="pl-14 py-8 flex flex-wrap">
                <div class="flex flex-wrap bg-red-100">
                    <p class="w-full sm:w-1/2 my-auto">
                        G'day I'm Seth, well besides the typical, 'Hey I study Computer Science and
                        love software', this is me. I'm currently living on the Gold Coast, studying and
                        working part-time at Dominos. As much as I love to study and work, I need my down time,
                        Friday night footy  (If i dont get called into work) is always a life saver and
                        playing games with my friends are my favourite ways to chill out after a big week.
                    </p>
                    <div class="bg-green-400">
                        <div class="">
                            <img class="object-contain h-full w-60 p-3 pb-1 pt-12"
                                 src="/images/forest.png"
                                 alt="about-picture">
                        </div>
                        <div class="flex justify-center">
                                <x-tag tag="Fraser inland track"> </x-tag>
                        </div>

                    </div>

                </div>


                <br>
                <p>
                    I have been into technology since highschool, where I created my first few apps
                    with XCode and actually uploaded a couple. Since then I haved dedicated my school subjects
                    towards a career in Software Development. Yes I have looked back when I want to pull my
                    hair out from the smallest of bugs, but it always changed my mind when I figured it out finally.
                </p>
            </div>
        </div>

        <div class="w-3/4 pt-2.5">
            <h1 class="text-2xl font-bold text-gray-500"> The University Journey </h1>
            <div class="pl-14 py-8">
                <p>
                    The past few years have been quite interesting and to put into a nutshell. I spent 4 weeks
                    in-person study in 2020 until covid hit and the rest of that year was studying from Griffiths
                    campus. Second year same story and saved a whole lot of money and studied from home. Although this may sound
                    kinda sucky, I definetly got a good oppurtunity out of it which was a job at Dominos, which benefited myself
                    greatly with funding camping adventures and avoid eating noodles for breakfast lunch and dinner for this year.
                    I knew I had to come down to the Gold Coast
                </p>
            </div>
        </div>

        <div class="w-3/4 pt-2.5">
            <h1 class="text-2xl font-bold text-gray-500"> My Hobbies </h1>
            <div class="pl-14 py-8">
                <p>
                    With having so much going on with 2 jobs and uni.
                    There isn't a whole lot of time to have a hobby.
                    But when I do I love 4WDing and going camping with
                    my mates. I love doing this as it completely disconnects you from the world and
                    allows you to fully wind down and clear your mind. A perfect example of this
                    was a week long Fraser Island trip I did with my friends. Hardly any signal
                    and nothing but remote camps, great feeds and memories.
                </p>
            </div>
        </div>

        <div class="w-3/4 pt-2.5">
            <h1 class="text-2xl font-bold text-gray-500"> My Goals </h1>
            <div class="pl-14 py-8">
                <p>
                    Over the past few years I have gained a passion for software development and developing
                    ambitious projects. Years at uni has taught me many aspects of this area, from AI, full-stack web development
                    and game development.
                </p>
            </div>
        </div>



{{--        <x-image-card image="forest.png"></x-image-card>--}}



{{--        <x-image-card image="maheno.png"></x-image-card>--}}


    </div>
</body>
</html>
