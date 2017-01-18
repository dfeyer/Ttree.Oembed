<?php
namespace Ttree\Oembed\ViewHelpers;

/*                                                                        *
 * This script belongs to the Flow package "Ttree.Oembed".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Ttree\Oembed\Consumer;
use Ttree\Oembed\RequestParameters;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Fluid\Core\ViewHelper\Exception;

/**
 * Renders a representation of a oEmbed resource.
 *
 * = Examples =
 *
 * <code title="rendering oEmbed resource with best representation">
 * {o:embed(uri: 'https://www.youtube.com/watch?v=x36gsF-2Tgc')}
 * </code>
 * <output>
 * (depending on the uri, in case of youtube video it will be youtube embed code html)
 * </output>
 *
 *
 * <code title="Rendering oEmbed resource with child rendering">
 * <o:embed uri="https://www.youtube.com/watch?v=x36gsF-2Tgc" objectName="oEmbedResource">
 * {oEmbedResource.title} - {oEmbedResource.authorName}
 * </o:embed>
 * </code>
 * <output>
 * (depending on the uri)
 * Developing a TYPO3 Phoenix Website (T3CON12DE) - typo3
 * </output>
 *
 */
class EmbedViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Renders a representation of a oEmbed resource
     *
     * @param string $uri
     * @param integer $maxWidth
     * @param integer $maxHeight
     * @param string $objectName
     * @return string
     * @throws Exception
     */
    public function render($uri, $maxWidth = 0, $maxHeight = 0, $objectName = null)
    {
        $consumer = new Consumer();

        $this->prepareRequestParameters($maxWidth, $maxHeight, $consumer);

        $resourceObject = $consumer->consume($uri);

        if ($resourceObject !== null) {
            if ($objectName !== null) {
                if ($this->templateVariableContainer->exists($objectName)) {
                    throw new Exception('Object name for EmbedViewHelper given as: ' . htmlentities($objectName) . '. This variable name is already in use, choose another.', 1359969229);
                }
                $this->templateVariableContainer->add($objectName, $resourceObject);
                $html = $this->renderChildren();
                $this->templateVariableContainer->remove($objectName);
            } else {
                $html = $resourceObject->getAsString();
            }
        } else {
            $html = 'Invalid oEmbed Resource';
        }

        return $html;
    }

    /**
     * @param integer $maxWidth
     * @param integer $maxHeight
     * @param Consumer $consumer
     */
    protected function prepareRequestParameters($maxWidth, $maxHeight, Consumer $consumer)
    {
        if ($maxWidth > 0 || $maxHeight > 0) {
            $requestParameters = new RequestParameters($maxHeight, $maxWidth);

            if ($maxWidth > 0) {
                $requestParameters->setMaxWidth($maxWidth);
            }
            if ($maxHeight > 0) {
                $requestParameters->setMaxHeight($maxHeight);
            }

            $consumer->setRequestParameters($requestParameters);
        }
    }
}

?>