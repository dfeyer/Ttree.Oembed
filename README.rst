oEmbed utility package for Flow with support for Neos
=====================================================

This package for Flow adds support for oEmbed.

This package also contain a Neos Node Type definition to integrate oEmbed resources in your Neos project.

created by Dominique Feyer <dfeyer@ttree.ch> http://www.ttree.ch

Features
========

- Consume oEmbed resource
- Fluid oEmbed ViewHelper
- Neos Node Type definition

How to use the plugin ?
=======================

You need to install the package with composer, nothing else.

How to use the Fluid Viewhelper ?
=================================

You can simply send your oEmbed resource URI to the ViewHelper, like this::

	{namespace o=Ttree\Oembed\ViewHelpers}
	<o:embed uri="{uri}" />

How to render responsive or fluid oEmbed resource ?
===================================================

Responsive Design is a common need for modern website. If you need responsive layout for your video,
you can add the following LESS, or in CSS, to your site::

	.oembed-video-container {
		position: relative;
		margin: 20px 0;
		padding-bottom: 56.25%;
		padding-top: 30px;
		height: 0;
		overflow: hidden;
		> iframe, > object, > embed {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
	}

This example come from an nice article from Ruairi Phelan, published on CyberDesignCraft_.

.. _CyberDesignCraft http://cyberdesigncraft.com/responsive-video-embed/
