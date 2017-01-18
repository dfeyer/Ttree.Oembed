<?php
namespace Ttree\Oembed\Provider;

/*
 * This file is part of the Ttree.Oembed package.
 *
 * (c) Dominique Feyer <dfeyer@ttree.ch>
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Ttree\Oembed\Provider;
use TYPO3\Flow\Annotations as Flow;

/**
 * oEmbed Link
 *
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class Flickr extends Provider
{

    public function __construct()
    {
        parent::__construct(
            'http://www.flickr.com/services/oembed',
            [
                'http://*.flickr.com/*'
            ],
            'http://www.flickr.com',
            'Flickr'
        );
    }

}

?>