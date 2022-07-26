<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title> About </title>
</head>

<body class="mg-0 pd-0">

    <x-navbar about="text-black border-black"></x-navbar>
    <div class="h-6"></div>
    <x-title title1="About" title2="Me"> </x-title>

    <div class="pt-10 items-center flex flex-wrap justify-center w-full h-auto">
        <x-about-card
            title="Who am I?"
            content-1="
                G'day I'm Seth, well besides the typical, 'Hey I study Computer Science and
                love software', this is me. I'm currently living on the Gold Coast, studying and
                working part-time at Dominos. As much as I love to study and work, I need my down time,
                Friday night footy  (If i dont get called into work) is always a life saver and
                playing games with my friends are my favourite ways to chill out after a big week."
            content-2="
                I have been into technology since high school, where I created my first few apps
                with XCode and uploaded a couple. Since then, I have dedicated my school subjects
                towards a career in Software Development. Yes, I have looked back when I want to pull my
                hair out from the smallest of bugs, but it always changed my mind when I figured it out... finally
                and that's why I love it."
            p-float-dir="float-left ml-3"
            img-float-dir="float-right mr-3"
            img-src="forest.png"
            >
        </x-about-card>
        <x-about-card
            title="My Hobbies"
            content-1="
                With having so much going on with 2 jobs and uni.
                There isn't a whole lot of time to have a hobby.
                But when I do I love 4WDing and going camping with
                my mates. I love doing this as it completely disconnects you from the world and
                allows you to fully wind down and clear your mind. A perfect example of this
                was a week long Fraser Island trip I did with my friends. Hardly any signal
                and nothing but remote camps, great feeds and memories."
            p-float-dir="float-left ml-3"
            img-float-dir="float-right mr-3"
            img-src="car.jpg"
        ></x-about-card>

        <x-about-card
            title="University Journey"
            content-1="
                The past few years have been quite interesting and to put into a nutshell. I spent 4 weeks
                in-person study in 2020 until covid hit and the rest of that year was studying from Griffiths
                campus. Second year same story and saved a whole lot of money and studied from home.
                Although this may sound bad, I got a good opportunity out of it which was a job at Dominos.
                Which benefited me greatly with funding camping adventures and avoiding eating noodles for
                breakfast lunch and dinner for this year at uni. I knew I had to come down to the Gold Coast
                in this last year to find full-time work and complete the Griffiths WIL internship program.
                I had been working towards getting a opportunity in this since before my degree started.
            "
            p-float-dir="float-left ml-3"
            img-float-dir="float-right mr-3"

        ></x-about-card>


    </div>
</body>
</html>
