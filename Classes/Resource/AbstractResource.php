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
 * oEmbed AbstractResource
 *
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
abstract class AbstractResource
{

    /**
     * Type.
     *
     * @var string
     */
    protected $type = '';

    /**
     * Version.
     *
     * @var string
     */
    protected $version = '1.0';

    /**
     * Title.
     *
     * @var string
     */
    protected $title = '';

    /**
     * Author Name.
     *
     * @var string
     */
    protected $authorName = '';

    /**
     * Author URL.
     *
     * @var string
     */
    protected $authorUrl = '';

    /**
     * Provider Name.
     *
     * @var string
     */
    protected $providerName = '';

    /**
     * Provider URL.
     *
     * @var string
     */
    protected $providerUrl = '';

    /**
     * Cache Age
     *
     * @var integer+
     */
    protected $cacheAge = 0;

    /**
     * Thumbnail URL
     *
     * @var string
     */
    protected $thumbnailUrl = '';

    /**
     * Thumbnail Width
     *
     * @var integer
     */
    protected $thumbnailWidth = 0;

    /**
     * Thumbnail Height
     *
     * @var integer
     */
    protected $thumbnailHeight = 0;

    /**
     * Get a string representation of the oEmbed resource.
     *
     * @return string
     */
    abstract public function getAsString();

    /**
     * Get a string representation of the oEmbed resource.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getAsString();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'type' => $this->type,
            'version' => $this->version,
            'authorName' => $this->authorUrl,
            'authorUrl' => $this->authorUrl,
            'providerName' => $this->providerName,
            'providerUrl' => $this->providerUrl,
            'cacheAge' => $this->cacheAge,
            'thumnailUrl' => $this->thumbnailUrl,
            'thumnailWidth' => $this->thumbnailWidth,
            'thumnailHeight' => $this->thumbnailHeight,
            'content' => (string)$this
        ];
    }

    /**
     * @param string $authorName
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string $authorUrl
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setAuthorUrl($authorUrl)
    {
        $this->authorUrl = $authorUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * @param int $cacheAge
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setCacheAge($cacheAge)
    {
        $this->cacheAge = $cacheAge;

        return $this;
    }

    /**
     * @return int
     */
    public function getCacheAge()
    {
        return $this->cacheAge;
    }

    /**
     * @param string $providerName
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;

        return $this;
    }

    /**
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }

    /**
     * @param string $providerUrl
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setProviderUrl($providerUrl)
    {
        $this->providerUrl = $providerUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getProviderUrl()
    {
        return $this->providerUrl;
    }

    /**
     * @param int $thumbnailHeight
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setThumbnailHeight($thumbnailHeight)
    {
        $this->thumbnailHeight = $thumbnailHeight;

        return $this;
    }

    /**
     * @return int
     */
    public function getThumbnailHeight()
    {
        return $this->thumbnailHeight;
    }

    /**
     * @param string $thumbnailUrl
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setThumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    /**
     * @param int $thumbnailWidth
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setThumbnailWidth($thumbnailWidth)
    {
        $this->thumbnailWidth = $thumbnailWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getThumbnailWidth()
    {
        return $this->thumbnailWidth;
    }

    /**
     * @param string $title
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $type
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $version
     * @return \Ttree\Oembed\Resource\AbstractResource
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $string
     * @return mixed
     * @todo use Flow API
     */
    protected static function underscoreToUpperCamelCase($string)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
    }
}

?>