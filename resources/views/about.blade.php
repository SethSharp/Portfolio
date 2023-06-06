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
<x-title title1="About" title2="Me"></x-title>

<div class="w-full h-full mt-10">
    <div
        class="my-10 ml-10 md:w-1/2 bg-gray-50 leading-7 rounded-3xl shadow-xl border-black transition duration-200 ease-in-out hover:-translate-y-1 ">
        <div class="px-10 py-5 text-lg font-medium text-blue-800">
            Some random title on the left
        </div>
        <div class="px-12 pb-5 text-md">
            G'day I'm Seth, well besides the typical, 'Hey I study Computer Science and
            love software', this is me. I'm currently living on the Gold Coast, studying and
            working part-time at Dominos. As much as I love to study and work, I need my down time,
            Friday night footy (If i dont get called into work) is always a life saver and
            playing games with my friends are my favourite ways to chill out after a big week.
        </div>
    </div>

    <div
        class="absolute right-0 mr-10 md:w-1/2 bg-gray-50 leading-7 rounded-3xl shadow-xl border-black transition duration-200 ease-in-out hover:-translate-y-1 ">
        <div class="px-10 py-5 text-lg font-medium text-blue-800">
            Some random title on the right
        </div>
        <div class="px-12 pb-5 text-md">
            G'day I'm Seth, well besides the typical, 'Hey I study Computer Science and
            love software', this is me. I'm currently living on the Gold Coast, studying and
            working part-time at Dominos. As much as I love to study and work, I need my down time,
            Friday night footy (If i dont get called into work) is always a life saver and
            playing games with my friends are my favourite ways to chill out after a big week.
        </div>
    </div>

</div>

</body>
</html>
