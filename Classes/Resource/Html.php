<?php
namespace Ttree\Oembed\Resource;

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
 * oEmbed Html
 *
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class Html extends AbstractResource
{

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
    public function getAsString()
    {
        return $this->html;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param string $html
     * @return Html
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Html
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Html
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }
}

?>