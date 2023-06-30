<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="mg-0 pd-0">
<x-nav-bar qualifications="text-black border-black"></x-nav-bar>
<div class="h-6"></div>
<x-title title1="My" title2="Qualifications"></x-title>

<div class="flex flex-wrap justify-center">
    <x-card.content-left
        title="Bachelor of Computer Science"
        content="Lorem ipsum dolor s it amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc
        ipsum luctus nunc, nec aliquet nisl nisl nec nisl. Donec auctor, nisl eget aliquam ultricies, nunc ipsum
        Lorem ipsum dolor s it amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc
        ipsum luctus nunc, nec aliquet nisl nisl nec nisl. Donec auctor, nisl eget aliquam ultricies, nunc ipsum"
    />

    <x-card.content-right
        title="Current Experience in the field"
        content="Lorem ipsum dolor s it amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc
        ipsum luctus nunc, nec aliquet nisl nisl nec nisl. Donec auctor, nisl eget aliquam ultricies, nunc ipsum
        Lorem ipsum dolor s it amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc
        ipsum luctus nunc, nec aliquet nisl nisl nec nisl. Donec auctor, nisl eget aliquam ultricies, nunc ipsum"
    />

    <x-card.content-left
        title="My Specialisation"
        content="I am currently primarily focusing my attention in the web development"
    />

    <x-card.content-right
        title="Future Areas of development"
        content="Although Web development is my current area of focus, I am always open to other areas of development."
    />
</div>
</body>
</html>
