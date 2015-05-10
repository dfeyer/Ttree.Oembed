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
use TYPO3\Flow\Utility\Arrays;

/**
 * oEmbed Request Parameters
 *
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class RequestParameters {

	/**
	 * @var int
	 */
	protected $maxWidth = NULL;

	/**
	 * @var int
	 */
	protected $maxHeight = NULL;

	/**
	 * @param int $maxHeight
	 * @param int $maxWidth
	 */
	public function __construct($maxHeight, $maxWidth) {
		$this->maxHeight = $maxHeight;
		$this->maxWidth  = $maxWidth;
	}

	/**
	 * @return array
	 */
	public function toArray() {
		$parameters = array(
			'maxwidth'  => $this->maxWidth,
			'maxheight' => $this->maxHeight,
		);

		return Arrays::removeEmptyElementsRecursively($parameters);
	}

	/**
	 * @param int $maxHeight
	 * @return RequestParameters
	 */
	public function setMaxHeight($maxHeight) {
		$this->maxHeight = $maxHeight;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getMaxHeight() {
		return $this->maxHeight;
	}

	/**
	 * @param int $maxWidth
	 * @return RequestParameters
	 */
	public function setMaxWidth($maxWidth) {
		$this->maxWidth = $maxWidth;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getMaxWidth() {
		return $this->maxWidth;
	}

}

?>