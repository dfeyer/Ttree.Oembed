<?php
namespace Ttree\Oembed;

/*
 * This file is part of the Ttree.Oembed package.
 *
 * (c) Dominique Feyer <dfeyer@ttree.ch>
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Flow\Annotations as Flow;

/**
 * oEmbed Discoverer
 *
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class Discoverer
{

    /**
     * From Services_oEmbed (Services/oEmbed.php:304).
     */
    const LINK_REGEX = '#<link(?:[^>]*)type="(?P<Format>@formats@)\+oembed"(?P<Attributes>[^>]*)>#i';

    /**
     * @Flow\Inject
     * @var \Ttree\Oembed\Browser
     */
    protected $browser;

    /**
     * Cached endpoints.
     *
     * @var string[]
     */
    protected $cachedEndpoints = [];

    /**
     * @var \TYPO3\Flow\Cache\Frontend\AbstractFrontend
     */
    protected $endPointCache;

    /**
     * Supported formats
     *
     * @var string
     */
    protected $supportedFormats = [
        'application/json',
        'text/xml'
    ];

    /**
     * Preferred format
     *
     * @var string
     */
    protected $preferredFormat = 'application/json';

    /**
     * Get the provider's endpoint URL for the supplied resource.
     *
     * @param string $url The URL to get the endpoint's URL for.
     * @return string
     * @throws Exception
     */
    public function getEndpointForUrl($url)
    {
        $cacheKey = sha1($url . $this->preferredFormat . json_encode($this->supportedFormats));

        if (!isset($this->cachedEndpoints[$url])) {
            $this->cachedEndpoints[$url] = $this->fetchEndpointForUrl($url);
            if (trim($this->cachedEndpoints[$url]) === '') {
                throw new Exception('Empty url endpoints', 1360175845);
            }
            $this->endPointCache->set($cacheKey, $this->cachedEndpoints[$url]);
        } elseif ($this->endPointCache->has($cacheKey) === true) {
            $this->cachedEndpoints[$url] = $this->endPointCache->get($cacheKey);
        }

        return $this->cachedEndpoints[$url];
    }

    /**
     * Fetch the provider's endpoint URL for the supplied resource.
     *
     * @param string $url The provider's endpoint URL for the supplied resource.
     * @return string
     * @throws \Ttree\Oembed\Exception
     * @todo is not endpoint is found try other format (supportedFormat)
     */
    protected function fetchEndpointForUrl($url)
    {
        $endPoint = null;

        try {
            $content = $this->browser->getContent($url);
        } catch (Exception $exception) {
            throw new Exception(
                'Unable to fetch the page body for "' . $url . '": ' . $exception->getMessage(),
                Exception::PAGE_BODY_FETCH_FAILED
            );
        }

        preg_match_all("/<link rel=\"alternate\"[^>]+>/i",
            $content,
            $out);
        if ($out[0]) {
            foreach ($out[0] as $link) {
                if (strpos($link, trim($this->preferredFormat . '+oembed')) !== false) {
                    $endPoint = $this->extractEndpointFromAttributes($link);
                    break;
                }
            }
        } else {
            throw new Exception(
                'No valid oEmbed links found on the document at "' . $url . '".',
                Exception::NO_OEMBED_LINKS_FOUND
            );
        }

        return $endPoint;
    }

    /**
     * Extract the endpoint's URL from the <link>'s tag attributes.
     *
     * @param  string $attributes The attributes of the <link> tag.
     * @return string
     * @throws \Ttree\Oembed\Exception
     */
    protected function extractEndpointFromAttributes($attributes)
    {
        if (!preg_match('/href="([^"]+)"/i', $attributes, $matches)) {
            throw new Exception(
                'No href attribute in <link> tag.',
                Exception::NO_HREF_ATTRIBUTE
            );
        }

        return $matches[1];
    }
}