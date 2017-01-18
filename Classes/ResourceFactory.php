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

use Ttree\Oembed\Resource\AbstractResource;
use Ttree\Oembed\Resource\PostProcessor\PostProcessorInterface;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Object\ObjectManagerInterface;
use TYPO3\Flow\Reflection\ObjectAccess;

/**
 * Resource Factory
 *
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 * @Flow\Scope("singleton")
 */
class ResourceFactory
{

    /**
     * @Flow\Inject(setting="resource.classNamePattern")
     * @var string
     */
    protected $resourceClassNamePattern;

    /**
     * @Flow\Inject(setting="resource.postProcessors")
     * @var string
     */
    protected $postProcessors = [];

    /**
     * @Flow\Inject
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Create a Resource object from the supplied resource.
     *
     * @param \stdClass $resource The resource to create an Resource from.
     * @return AbstractResource
     * @throws Exception
     */
    public function create($resource)
    {
        $className = $this->getResourceClassName($resource->type);
        if (!class_exists($className)) {
            throw new Exception(
                'Unknown resource type "' . $resource->type . '".',
                Exception::UNKNOWN_RESOURCE_TYPE
            );
        }

        /** @var AbstractResource $object */
        $object = $this->objectManager->get($className);

        foreach ($resource as $property => $value) {
            if (!ObjectAccess::isPropertySettable($object, $property)) {
                continue;
            }
            ObjectAccess::setProperty($object, $property, $value);
        }

        $this->postProcessResources($object);

        return $object;
    }

    /**
     * @param AbstractResource $resource
     */
    protected function postProcessResources(AbstractResource $resource)
    {
        if (!is_array($this->postProcessors)) {
            return;
        }
        foreach ($this->postProcessors as $postProcessorClassName) {
            /** @var PostProcessorInterface $postProcessor */
            $postProcessor = $this->objectManager->get($postProcessorClassName);
            if (!$postProcessor->canProcess($resource)) {
                continue;
            }
            $postProcessor->process($resource);
        }
    }

    /**
     * @param string $type
     * @return string
     */
    protected function getResourceClassName($type)
    {
        return str_replace('@type', ucfirst(strtolower(trim($type))), $this->resourceClassNamePattern);
    }

}