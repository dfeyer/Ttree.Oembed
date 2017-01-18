<?php
namespace Ttree\Oembed\Provider;

/*                                                                        *
 * This script belongs to the Flow package "Ttree.Oembed".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Ttree\Oembed\Provider;
use TYPO3\Flow\Annotations as Flow;

/**
 * oEmbed Link
 *
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class YouTube extends Provider
{

    public function __construct()
    {
        parent::__construct(
            'http://www.youtube.com/oembed',
            [
                'http://*.youtube.com/*'
            ],
            'http://www.youtube.com',
            'YouTube'
        );
    }

}

?>