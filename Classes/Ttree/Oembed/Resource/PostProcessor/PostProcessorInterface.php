<?php
namespace Ttree\Oembed\Resource\PostProcessor;

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
use TYPO3\Flow\Annotations as Flow;

/**
 * PostProcessor Interface
 *
 * @author  Dominique Feyer <dfeyer@ttree.ch>
 */
interface PostProcessorInterface {

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