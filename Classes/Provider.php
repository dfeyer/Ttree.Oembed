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

use Ttree\Oembed\Url\Schema;
use TYPO3\Flow\Annotations as Flow;

/**
 * oEmbed Provider
 *
 * @author  Romain Ruetschi <romain.ruetschi@gmail.com>
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class Provider
{

    /**
     * Name
     *
     * @var string
     */
    protected $name = '';

    /**
     * URL
     *
     * @var string
     */
    protected $url = '';

    /**
     * URL Scheme
     *
     * @var array
     */
    protected $schemes = [];

    /**
     * API Endpoint
     *
     * @var string
     */
    protected $endpoint = '';

    /**
     * Create a new RRoEmbed\Provider instance.
     *
     * @param string $endpoint The provider endpoint URL.
     * @param array $schemes The schemes the providers match.
     * @param string $url The URL of provider's website.
     * @param string $name The name of the provider.
     */
    public function __construct($endpoint, array $schemes = [], $url = '', $name = '')
    {
        foreach ($schemes as $key => $scheme) {
            if (!is_object($scheme) || !($scheme instanceof Schema)) {
                if (is_string($scheme)) {
                    $schemes[$key] = new Schema($scheme);
                } else {
                    unset($schemes[$key]);
                }
            }
        }

        $this->endpoint = $endpoint;
        $this->schemes = $schemes;
        $this->url = $url;
        $this->name = $name;
    }

    /**
     * Check whether the given URL match one of the provider's schemes.
     *
     * @param string $url The URL to check against.
     * @return boolean
     */
    public function match($url)
    {
        if (!$this->schemes) {
            return true;
        }

        foreach ($this->schemes as $scheme) {
            if ($scheme->match($url)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the provider's name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the provider's URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the provider's URL schemes.
     *
     * @return array
     */
    public function getSchemes()
    {
        return $this->schemes;
    }

    /**
     * Get the provider's API endpoint.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }
}

?>