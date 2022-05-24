<?php

namespace Ttree\Oembed;

/*                                                                        *
 * This script belongs to the Flow package "Ttree.Oembed".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Core\Bootstrap;
use TYPO3\Flow\Http\HttpRequestHandlerInterface;

/**
 * oEmbed Browser
 *
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 * @Flow\Scope("singleton")
 */
class Browser
{

    /**
     * @var Bootstrap
     * @Flow\Inject
     */
    protected $boostrap;

    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function getContent($url)
    {
        $request = $this->boostrap->getActiveRequestHandler();
        if (!$request instanceof HttpRequestHandlerInterface) {
            throw new \RuntimeException('Browser must be executed within a HttpRequestHandler');
        }
        $options = array(
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POST => false,
            CURLOPT_USERAGENT => $request->getHttpRequest()->getHeader('User-Agent'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_AUTOREFERER => true,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_MAXREDIRS => 10,
        );

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