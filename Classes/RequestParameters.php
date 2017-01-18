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

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Utility\Arrays;

/**
 * oEmbed Request Parameters
 *
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class RequestParameters
{

    /**
     * @var int
     */
    protected $maxWidth = null;

    /**
     * @var int
     */
    protected $maxHeight = null;

    /**
     * @param int $maxHeight
     * @param int $maxWidth
     */
    public function __construct($maxHeight, $maxWidth)
    {
        $this->maxHeight = $maxHeight;
        $this->maxWidth = $maxWidth;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $parameters = [
            'maxwidth' => $this->maxWidth,
            'maxheight' => $this->maxHeight,
        ];

        return Arrays::removeEmptyElementsRecursively($parameters);
    }

    /**
     * @param int $maxHeight
     * @return RequestParameters
     */
    public function setMaxHeight($maxHeight)
    {
        $this->maxHeight = $maxHeight;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxHeight()
    {
        return $this->maxHeight;
    }

    /**
     * @param int $maxWidth
     * @return RequestParameters
     */
    public function setMaxWidth($maxWidth)
    {
        $this->maxWidth = $maxWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxWidth()
    {
        return $this->maxWidth;
    }

}

?>