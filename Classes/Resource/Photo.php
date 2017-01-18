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

use TYPO3\Flow\Annotations as Flow;

/**
 * oEmbed Photo
 *
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class Photo extends AbstractResource
{

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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Photo
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * @return Photo
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
     * @return Photo
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return string
     */
    public function getAsString()
    {
        $attributes = [
            'src' => $this->url,
            'alt' => $this->title,
            'height' => ($this->height) ? $this->height : '',
            'width' => ($this->width) ? $this->width : ''
        ];

        $html = '<img ';

        foreach ($attributes as $attribute => $value) {
            $html .= $attribute . '="' . $value . '" ';
        }

        $html .= '/>';

        return $html;
    }
}

?>