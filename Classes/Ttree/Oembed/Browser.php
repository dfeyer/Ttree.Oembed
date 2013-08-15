<?php
namespace Ttree\Oembed;

/*                                                                        *
 * This script belongs to the Flow package "Ttree.Oembed".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * oEmbed Browser
 *
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 * @Flow\Scope("singleton")
 */
class Browser {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Http\Client\Browser
	 */
	protected $browser;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Http\Client\CurlEngine
	 */
	protected $browserRequestEngine;

	/**
	 * Initialize object
	 */
	public function initializeObject() {
		$this->browser->setRequestEngine($this->browserRequestEngine);
	}

	/**
	 * @param string $url
	 * @return string
	 * @throws Exception
	 */
	public function getContent($url) {
		$response = $this->browser->request($url);

		if ($response->getStatusCode() !== 200) {
			throw new Exception(
				sprintf('HTTP request do not return 200 status code (%s)', $response->getStatusCode()),
				1355878139
			);
		}

		return $response->getContent();
	}
}

?>