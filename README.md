# Portfolio

This is an online portfolio which implements a blog system using my own
composer [package](https://github.com/SethSharp/BlogCrud)

### Technology

This is Laravel at heart with a mix of Vue for the blog dashboard with blade/livewire for public facing pages.

#### The Front End

The front end has always been a blade integration with changes over the last couple of years to the UI as I learn new
skills in design and SEO. Livewire is also something I came around to liking on this project as it allows
easy communication & functionality between the front and Laravel's backend - while maintaining that better SEO rating
with server side rendering.

#### The Blog System

The blog system is something I am really proud of and have made into a
(composer package)[(https://github.com/SethSharp/BlogCrud)] for the laravel part.
It uses Vue & integrates the TipTap editor to create amazing
content for blogs. It has all the standard things you would expect, headings, links,
alignment and more. I have also made a custom component which allows me to upload images - which are directly uploaded
to a s3 bucket for storage and in cases where I delete an image those files are deleted accordingly for optimal
management of files between the DB & S3.

### Recently

Recently I have also integrated my partners portfolio site. In locations that need it, the app will check the
environment and will return the correct data based on the environment. Since these implementations would be exactly the
same I didn't want to have two projects to manage when changes were made to the package or the UI.
