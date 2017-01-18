<?php
namespace Ttree\Oembed\Resource\PostProcessor;

/*
 * This file is part of the Ttree.Oembed package.
 *
 * (c) Dominique Feyer <dfeyer@ttree.ch>
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Ttree\Oembed\Resource\AbstractResource;
use Ttree\Oembed\Resource\Video;
use Neos\Flow\Annotations as Flow;

/**
 * Youtube Resource PostProcessor
 *
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
class YoutubePostProcessor implements PostProcessorInterface
{

    /**
     * @param AbstractResource $resource
     * @return boolean
     */
    public function canProcess(AbstractResource $resource)
    {
        return ($resource instanceof Video);
    }

    /**
     * @param AbstractResource $resource
     * @return void
     */
    public function process(AbstractResource $resource)
    {
        /** @var Video $resource */
        $html = str_replace('feature=oembed', 'feature=oembed&rel=0', $resource->getHtml());
        $resource->setHtml($html);
    }

}