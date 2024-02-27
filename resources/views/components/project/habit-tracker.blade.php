<div class="my-12">
    <div class="mb-8">
        <h1 class="text-4xl font-medium mt-2">
            <a href="http://habittracker-uc-1.eba-ayudv8jf.ap-southeast-2.elasticbeanstalk.com">
                Habit Tracker
            </a>
        </h1>
        <span class="text-blue-800 font-medium text-lg"> VILT and AWS </span>
    </div>
    <div class="grid lg:grid-cols-2 gap-x-4 text-md text-gray-500 leading-loose">
        <div>
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
                <x-image.card alt="Calendar Image for HB" image="/projects/habit-tracker/calendar.png"/>
            </div>
        </div>
        <div>
            <div class="mt-6">
                <x-image.card alt="Home Image for HB" image="/projects/habit-tracker/dashboard.png"/>
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
            <div class="mt-6">
                After a lot of experimenting and LOTS of research I was able to get a grip on AWS, first
                deploying this portfolio you are seeing on a EC2 instance, but this was very tedious and manual. So I
                wanted
                something different and more automated. Which led me onto the Elastic Beanstalk and GitHub Actions.
                After some
                configuration and research Habit Tracker is fully running on this infrastructure as well as connected to
                an RDS
            </div>
        </div>
    </div>
</div>
