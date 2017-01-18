<?php
namespace Ttree\Oembed\Url;

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
class Schema
{

    const WILDCARD_CHARACTER = '*';

    /**
     * Scheme
     *
     * @var string
     */
    protected $scheme = '';

    /**
     * Regular Expression Pattern.
     *
     * @var string
     */
    protected $pattern = '';

    public function __construct($scheme)
    {
        if (!is_string($scheme)) {
            throw new \InvalidArgumentException(
                '$scheme must be a string.'
            );
        }

        $this->scheme = $scheme;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->scheme;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function match($url)
    {
        if (!$this->pattern) {
            $this->pattern = self::buildPatternFromScheme($this);
        }

        return ( bool )preg_match($this->pattern, $url);
    }

    /**
     * @param Schema $scheme
     * @return string
     */
    static protected function buildPatternFromScheme(self $scheme)
    {
        // Generate a unique random string.
        $uniq = md5(mt_rand());

        // Replace the wildcard sub-domain if exists.
        $scheme = str_replace(
            '://' . self::WILDCARD_CHARACTER . '.',
            '://' . $uniq,
            $scheme->getScheme()
        );

        // Replace the wildcards.
        $scheme = str_replace(
            self::WILDCARD_CHARACTER,
            $uniq,
            $scheme
        );

        // Set the pattern wrap.
        $wrap = '|';

        // Quote the pattern,
        $pattern = preg_quote($scheme, $wrap);

        // Replace the unique string by the character class.
        $pattern = str_replace($uniq, '.*', $pattern);

        // Return the wrapped pattern.
        return $wrap . $pattern . $wrap . 'iu';
    }

    public function getScheme()
    {
        return $this->scheme;
    }
}

?>