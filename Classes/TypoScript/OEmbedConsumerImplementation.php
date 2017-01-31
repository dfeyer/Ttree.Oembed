<?php
namespace Ttree\Oembed\TypoScript;

/*                                                                          *
 * This script belongs to the TYPO3 Flow package "Ttree.Plugin.MicroEvent". *
 *                                                                          *
 * It is free software; you can redistribute it and/or modify it under      *
 * the terms of the GNU General Public License, either version 3 of the     *
 * License, or (at your option) any later version.                          *
 *                                                                          *
 * The TYPO3 project - inspiring people to share!                           *
 *                                                                          */

use Ttree\Oembed\Consumer;
use Ttree\Oembed\RequestParameters;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;
use TYPO3\TypoScript\TypoScriptObjects\AbstractTypoScriptObject;

/**
 * TypoScript consumer for oEmbed resource
 *
 * @Flow\Scope("prototype")
 */
class OEmbedConsumerImplementation extends AbstractTypoScriptObject
{

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var integer
     */
    protected $maxWidth;

    /**
     * @var integer
     */
    protected $maxHeight;

    /**
     * @var NodeInterface
     */
    protected $node;

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->tsValue('uri');
    }

    /**
     * @return integer
     */
    public function getMaximumWidth()
    {
        return (integer)$this->tsValue('maximumWidth');
    }

    /**
     * @return integer
     */
    public function getMaximumHeight()
    {
        return (integer)$this->tsValue('maximumHeight');
    }

    /**
     * @param \TYPO3\TYPO3CR\Domain\Model\NodeInterface $node
     */
    public function setNode($node)
    {
        $this->node = $node;
    }

    /**
     * @return \Ttree\Oembed\Resource\AbstractResource An object representation of the oEmbed resource or NULL on error
     */
    public function evaluate()
    {
        $consumer = new Consumer();
        $this->prepareRequestParameters($consumer);

        $uri = $this->getUri();

        return $consumer->consume($uri);
    }

    /**
     * @param Consumer $consumer
     */
    protected function prepareRequestParameters(Consumer $consumer)
    {
        $maximumWidth = $this->getMaximumWidth();
        $maximumHeight = $this->getMaximumHeight();
        if ($maximumWidth > 0 || $maximumHeight > 0) {
            $requestParameters = new RequestParameters($maximumHeight, $maximumWidth);

            if ($maximumWidth > 0) {
                $requestParameters->setMaxWidth($maximumWidth);
            }
            if ($maximumHeight > 0) {
                $requestParameters->setMaxHeight($maximumHeight);
            }

            $consumer->setRequestParameters($requestParameters);
        }
    }

}
