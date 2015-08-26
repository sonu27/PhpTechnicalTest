Code test
=================

The aim of this code test is to get an idea about how you like to code, and if
it fits well with how we like to code!

Currently we have a console command which describes the reviews for an Amar
product:

app/console feefo:print-reviews 42687

This should output something like:

"There are 16 reviews and the average is 94%"

Product id 42687 is for a "Vera Kettle", you can see it on the Amar site
here:

https://www.amar.com/products/vera-kettle

Just in case you'd like another id:

42690 is a "Vela Food Blender" (to match the kettle!)
https://www.amar.com/products/vela-food-blender

Those reviews are coming from Feefo who collect customer reviews for Amar.

The objectives
==============

At the moment, every time we run the command it fetches the reviews from Feefo
and displays some text about them.

We have three changes we'd like to make:

1. Cache/store the reviews for a period of time, 24 hours to begin with, so we
don't need to make lots of identical requests to Feefo

2. Refactor the code into something more sensible, we want the Feefo reviews to
be available to other, as-yet-unwritten parts of the system.

3. Provide a command to invalidate the cached reviews

The text output from our command should stay the same (well, unless the reviews
change!).

Finally, please list any issues you can see with the code which actually
retrieves the reviews.

This will need some sort of database/cache as well, so please include anything
required to set them up.

Setup cache
===========

Install Redis 3.0, e.g. for a Centos 7 machine - yum install redis

Problems
========

Since Feefo isn't providing an actual versioned API, if they make changes to the XML
structure it could break the app.

Unless they allow providing version info in the accept header, the XML structure
could change in the future and there isn't away of preventing this.
