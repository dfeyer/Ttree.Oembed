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

/**
 * oEmbed Browser
 *
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 * @Flow\Scope("singleton")
 */
class Browser
{

    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function getContent($url)
    {
        $options = [
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POST => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_AUTOREFERER => true,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_MAXREDIRS => 10,
        ];

        $handler = curl_init($url);
        curl_setopt_array($handler, $options);
        $content = curl_exec($handler);
        $errorNumber = curl_errno($handler);
        if ($errorNumber > 0) {
            $errorMessage = curl_error($handler);
            throw new Exception(sprintf('Unable to get content, CURL error: %s, ', $errorNumber, $errorMessage), 1402851391);
        }
        $header = curl_getinfo($handler);
        if ($header['http_code'] !== 200) {
            throw new Exception(sprintf('Unable to get content, URL %s response code: %s, ', $url, $header['http_code']), 1402851391);
        }
        curl_close($handler);

        return $content;
    }
}