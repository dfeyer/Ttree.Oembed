<?php
namespace Ttree\Oembed\Resource;

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
 * oEmbed Html
 *
 * @package Ttree.Oembed
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class Html extends AbstractResource {

	/**
	 * HTML
	 *
	 * @var string
	 */
	protected $html = 0;

	/**
	 * Width
	 *
	 * @var integer
	 */
	protected $width = 0;

	/**
	 * Height
	 *
	 * @var integer
	 */
	protected $height = 0;

	/**
	 * @return string
	 */
	public function getAsString() {
		return $this->html;
	}

	/**
	 * @return string
	 */
	public function getHtml() {
		return $this->html;
	}

	/**
	 * @param string $html
	 * @return Html
	 */
	public function setHtml($html) {
		$this->html = $html;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * @param int $width
	 * @return Html
	 */
	public function setWidth($width) {
		$this->width = $width;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * @param int $height
	 * @return Html
	 */
	public function setHeight($height) {
		$this->height = $height;

		return $this;
	}
}

?>