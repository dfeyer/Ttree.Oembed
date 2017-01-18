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

use Neos\Flow\Annotations as Flow;

/**
 * oEmbed Exception
 *
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class Exception extends \Exception
{
    const PAGE_BODY_FETCH_FAILED = '1355874614';
    const NO_OEMBED_LINKS_FOUND = '1355874615';
    const NO_HREF_ATTRIBUTE = '1355874616';
    const UNKNOWN_RESOURCE_TYPE = '1355874617';
}

?>