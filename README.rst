.. -*- mode: rst -*-

Ttree.Oembed
======

This is a TYPO3 Flow package to consume oEmbed resource in your
application, you found the last version on Github:
`github.com/dfeyer/Ttree.Oembed <https://github.com/dfeyer/Ttree.Oembed>`_.

About
-----

`Ttree.Oembed` is based on a RRoEmbed, originaly published on Github, some years ago:
`github.com/romac/RRoEmbed <https://github.com/romac/RRoEmbed/>`_ under double
licence MIT and GPL.

This package include some adapation based on TYPO3 Flow API, like cache, HTTP request based
on the default Browser provided by Flow and add some new feature, like providing custom
request parameters like maxwidth and maxheight.

More specifically, `Ttree.Oembed` provides:

* oEmbed resource consumer
* oEmbed endPoint auto discovery

Code Sample
-----------

A simple request
~~~~~~~~~~~~~~~~

If you don't provide a Provider to the consume method, the consumer will try to automaticaly
discover oEmbed URL in the page content, if no compatible URL are found the consumer will
throw an exception.

::
	$consumer = new \Ttree\Oembed\Consumer();

	$resource = $consumer->consume("http://vimeo.com/6132324");
	
	print $resource;

A simple request with a given provider
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can define additional provider, just check the example providers in the Package.

::
	$consumer = new \Ttree\Oembed\Consumer();

	$resource = $consumer->consume("http://vimeo.com/6132324", new \Ttree\Oembed\Provider\Vimeo());

	print $resource;

A simple request with custome paramaters
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Supported parameters are "maxwidth" and "maxheight".

::
	$consumer = new \Ttree\Oembed\Consumer();

	$requestParameters = new \Ttree\Oembed\RequestParameters();
	$requestParameters->setMaxWidth(800);

	$consumer->setRequestParameters($requestParameters);

	$resource = $consumer->consume("http://vimeo.com/6132324");

	print $resource;

License
-------

The code is licensed under the `GPL license <http://www.gnu.org/licenses/gpl.html>`_.