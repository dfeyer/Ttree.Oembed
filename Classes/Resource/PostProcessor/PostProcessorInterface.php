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
use TYPO3\Flow\Annotations as Flow;

/**
 * PostProcessor Interface
 *
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
interface PostProcessorInterface
{

    /**
     * @param AbstractResource $resource
     * @return boolean
     */
    public function canProcess(AbstractResource $resource);

    /**
     * @param AbstractResource $resource
     * @return void
     */
    public function process(AbstractResource $resource);

}