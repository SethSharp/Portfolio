# Portfolio
This is a online portfolio of things related to me as well as a blog system which allows me to manage/publish blogs.


### Technology
This is Laravel at heart with a mix of Vue for the blog dashboard with blade/livewire for public facing pages.

#### The Front End
The front end has always been a blade integration with changes over the last couple years to the UI as I learn new skills in design and especially SEO. Livewire is also something I came around to liking on this project as it allows easy functionality between the front and backend of Laravel while maintaining that better SEO rating with server side rendering.

#### The Blog System
The Blog system is something I am really proud of and looking to break out into a package to utilise it in another project. It uses Vue & integrating the TipTap editor to create blogs. It has all the standard things you would expect, headings, links, alignment and more. I have also made a custom component which allows me to upload images - which are directly uploaded to a s3 bucket for storage and in cases where I delete a image those files are deleted accordingly.
