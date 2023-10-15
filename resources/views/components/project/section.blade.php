<div class="my-4">
    <div class="mb-8">
        <span class="text-blue-800 font-medium text-lg"> VILT and AWS </span>
        <h1 class="text-4xl font-medium mt-2"> Habit Tracker </h1>
    </div>
    <div class="sm:flex">
        <div class="sm:w-1/2 text-md mt-4 text-gray-500 leading-loose">
            <div>
                Habit Tracker is a major project of mine focusing on implementing my skills on the VILT stack
                and testing new-found knowledge in AWS. This project is something that came from a small idea,
                with input from friends into a publicly available app ready for use.
            </div>

            <div class="mt-14">
                <div>
                    Habit Tracker is fairly simple yet powerful, allowing you to track and remind you
                    of habits or even just general things that occur regularly. You can create habits that
                    will repeat on a given schedule you give; weekly (One day of each week), Daily (Multiple days of the
                    week)
                    or monthly (Once a month occurrence). With that you are given a week view of all your habits to help
                    focus your concentration, but for a more broad overlook you can use the calendar to view habits for
                    the month.
                    Including filtering of the habits based on type and completion status.
                </div>
            </div>
            <div class="mt-6">
                <x-card.image image="/projects/habit-tracker/calendar.png"/>
            </div>
        </div>
        <div class="sm:w-1/2 mx-auto mt-16 sm:mt-4">
            <div class="mx-6">
                <x-card.image image="/projects/habit-tracker/dashboard.png"/>
            </div>
            <div class="h-8"></div>
            <div class="mx-auto space-y-4 w-3/4">
                <div class="flex">
                    <x-icons.building/>
                    <span class="my-auto ml-4 font-semi"> AWS </span>
                </div>
                <div class="flex">
                    <x-icons.database/>
                    <span class="my-auto ml-4 font-semi"> RDS </span>
                </div>
                <div class="flex">
                    <x-icons.cloud-up/>
                    <span class="my-auto ml-4 font-semi"> Push to Deploy </span>
                </div>
            </div>
            <div class="mx-12 mt-6 text-gray-500 leading-loose">
                After a lot of experimenting and LOTS of research I was able to get a grip on AWS, first
                deploying this portfolio you are seeing on a EC2 instance, but this was very tedious and manual. So I
                wanted
                something different and more automated. Which led me onto the Elastic Beanstalk and GitHub Actions.
                After some
                configuration and research Habit Tracker is fully running on this infrastructure as well as connected to
                an RDS
            </div>
            <div class="mx-12 mt-2 flex">
                <a href="https://github.com/SethSharp/Habit-Tracker">
                    <img src="/images/github.png" class="w-20 h-20"/>
                </a>
                <span class="my-auto font-medium"> Checkout the repository </span>
            </div>
        </div>
    </div>
</div>
