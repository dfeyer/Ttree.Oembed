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
 * oEmbed Photo
 *
 * @package Ttree.Oembed
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class Photo extends AbstractResource {

	/**
	 * URL
	 *
	 * @var string
	 */
	protected $url = '';

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
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param string $url
	 * @return Photo
	 */
	public function setUrl($url) {
		$this->url = $url;

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
	 * @return Photo
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
	 * @return Photo
	 */
	public function setHeight($height) {
		$this->height = $height;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAsString() {
		$attributes = array(
			'src'    => $this->url,
			'alt'    => $this->title,
			'height' => ($this->height) ? $this->height : '',
			'width'  => ($this->width) ? $this->width : ''
		);

		$html = '<img ';

		foreach ($attributes as $attribute => $value) {
			$html .= $attribute . '="' . $value . '" ';
		}

		$html .= '/>';

		return $html;
	}
}

?>