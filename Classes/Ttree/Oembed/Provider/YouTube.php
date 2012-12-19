<?php
namespace Ttree\Oembed\Provider;

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
use Ttree\Oembed\Provider;

/**
 * oEmbed Link
 *
 * @package Ttree.Oembed
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class YouTube extends Provider {

	public function __construct() {
		parent::__construct(
			'http://www.youtube.com/oembed',
			array(
				'http://*.youtube.com/*'
			),
			'http://www.youtube.com',
			'YouTube'
		);
	}

}

?>