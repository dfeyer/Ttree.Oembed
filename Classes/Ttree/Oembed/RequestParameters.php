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
use TYPO3\Flow\Utility\Arrays;

/**
 * oEmbed Request Parameters
 *
 * @package Ttree.Oembed
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