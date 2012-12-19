<?php
namespace Ttree\Oembed;

/*                                                                        *
 * This script belongs to the Flow package "Ttree.Oembed".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * oEmbed Discoverer
 *
 * @package Ttree.Oembed
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */

class Discoverer {

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
	protected $cachedEndpoints = array();

	/**
	 * @var \TYPO3\Flow\Cache\Frontend\AbstractFrontend
	 */
	protected $endPointCache;

	/**
	 * Supported formats
	 *
	 * @var string
	 */
	protected $supportedFormats = array(
		'application/json',
		'text/xml'
	);

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
	 */
	public function getEndpointForUrl($url) {
		$cacheKey = sha1($url . $this->preferredFormat . json_encode($this->supportedFormats));

		if (!isset($this->cachedEndpoints[$url])) {
			$this->cachedEndpoints[$url] = $this->fetchEndpointForUrl($url);
			$this->endPointCache->set($cacheKey, $this->cachedEndpoints[$url]);
		} elseif ($this->endPointCache->has($cacheKey) === TRUE) {
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
	protected function fetchEndpointForUrl($url) {
		$endPoint = NULL;

		try {
			$content = $this->browser->getContent($url);
		} catch (Exception $e) {
			throw new Exception(
				'Unable to fetch the page body for "' . $url . '".',
				Exception::PAGE_BODY_FETCH_FAILED,
				$e
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
	protected function extractEndpointFromAttributes($attributes) {
		if (!preg_match('/href="([^"]+)"/i', $attributes, $matches)) {
			throw new Exception(
				'No href attribute in <link> tag.',
				Exception::NO_HREF_ATTRIBUTE
			);
		}

		return $matches[1];
	}
}

?>