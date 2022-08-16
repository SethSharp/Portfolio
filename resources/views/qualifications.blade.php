<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="mg-0 pd-0">
    <x-nav-bar qualifications="text-black border-black" ></x-nav-bar>

    <div class="mt-12 sm:mt-8 px-12 sm:px-20 w-full">
        <h1 class="text-4xl font-bold text-black inline-block pr-2"> My </h1>
        <h1 class="text-4xl font-bold text-amber-400 inline-block"> Qualifications! </h1>
    </div>
    <div class="items-center flex flex-wrap sm:flex justify-center w-full mt-5 px-12">
        <div class="h-auto w-auto
                    sm:m-10 my-5
                    p-10 pt-4
                    rounded-3xl
                    shadow-black shadow-md
                    transition ease-in-out delay-200
                    hover:-translate-y-1 hover:scale-110 hover:bg-gray-100 duration-500">
            <div>
                <h1 class="text-2xl font-bold text-black"> Skills </h1>
                <ul class="p-6 list-disc">
                    <li> Full Stack Web Development
                        <ul class="list-decimal pl-6">
                            <li class="">
                                Frameworks
                                <x-tag tag="Angular"></x-tag>
                                <x-tag tag="Laravel"></x-tag>
                                <x-tag tag="React"></x-tag>
                                <x-tag tag="Ionic"></x-tag>
                            </li>
                            <li>
                                Backend technologies
                                <x-tag tag="NodeJS"></x-tag>
                                <x-tag tag="ExpressJS"></x-tag>
                            </li>
                            <li> Design </li>
                        </ul>
                    </li>
                    <li> Software Development
                            <x-tag tag="C/C++"></x-tag>
                            <x-tag tag="Python"></x-tag>
                            <x-tag tag="JavaScript"></x-tag>
                            <x-tag tag="PHP"></x-tag>
                    </li>
                </ul>
            </div>
        </div>
        <div class="h-auto w-auto
                    max-w-lg
                    sm:m-10 my-5
                    p-10 pt-4
                    rounded-3xl
                    shadow-black shadow-md
                    transition ease-in-out delay-200
                    hover:-translate-y-1 hover:scale-110 hover:bg-gray-100 duration-500">
            <div>
                <h1 class="text-2xl font-bold text-black"> Attributes </h1>
                <ul class="p-6 list-disc">
                    <li> Work ethic
                        <ul class="list-decimal pl-6">
                            <li> 2 jobs in final trimester </li>
                            <li> Studied full time and worked 10+ hours </li>
                            <li> Been working since high-school </li>
                            <li> Consistently worked 20-25+ hours per week (Tri 2 of 2021) with a 3 subject load studying online and got 5.5+GPA </li>
                        </ul>
                    </li>
                    <li> Team leader/player
                        <ul class="list-decimal pl-6">
                            <li> Trained people at work </li>
                            <li> Lead shifts as a manager </li>
                        </ul>
                    </li>
                    <li> Reliable
                        <ul class="list-decimal pl-6">
                            <li> Always showed up for work (unless sick) </li>
                            <li> Trusted as a manager to count money, shut the store down and lead the team on night shifts </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="h-auto w-auto
                    sm:m-10
                    p-10 pt-4 my-5
                    rounded-3xl
                    shadow-black shadow-md
                    transition ease-in-out delay-200
                    hover:-translate-y-1 hover:scale-110 hover:bg-gray-100 duration-500">
            <div>
                <h1 class="text-2xl font-bold text-black"> Work </h1>
                <ul class="p-6 list-disc">
                    <li> Coding Labs Internship (July-Present)
                        <ul class="list-decimal pl-6">
                            <li> Laravel </li>
                            <li> Database Design </li>
                            <li> TailwindCSS </li>
                            <li> Visual Mock-ups </li>
                            <li> PHP </li>
                        </ul>
                    </li>
                    <li> Dominos (Feb 2021 - Present)
                        <ul class="list-decimal pl-6">
                            <li> Delivery driver </li>
                            <li> Shift runner </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="h-auto w-auto
                    sm:m-10 my-5
                    p-10 pt-4
                    rounded-3xl
                    shadow-black shadow-md
                    transition ease-in-out delay-200
                    hover:-translate-y-1 hover:scale-110 hover:bg-gray-100 duration-500">
            <div>
                <h1 class="text-2xl font-bold text-black"> Education </h1>
                <ul class="p-6 list-disc">
                    <li> Griffith University (Bachelor of Computer Science) 2020-2023
                        <ul class="list-decimal pl-6">
                            <li> General
                                <ul class="list-decimal pl-6">
                                    <li> Algorithms/Data structures </li>
                                    <li> Complex problem solving </li>
                                    <li> Full-stack development </li>
                                    <li> AI </li>
                                </ul>
                            </li>
                            <li> Favourite/High performing subjects
                                <ul class="list-decimal pl-6">
                                    <li> Interactive App Development (7) </li>
                                    <li> OOP(6) </li>
                                    <li> Advanced Algorithms (6) </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li> Software Development
                        <ul class="list-decimal pl-6">
                            <li> C/C++ </li>
                            <li> Python </li>
                            <li> JavaScript </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
