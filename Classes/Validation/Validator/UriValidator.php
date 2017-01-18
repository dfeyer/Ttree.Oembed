<?php
namespace Ttree\Oembed\Validation\Validator;

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
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Validation\Validator\AbstractValidator;

/**
 * @Flow\Scope("singleton")
 */
class UriValidator extends AbstractValidator
{

    /**
     * Checks if the given value is a specific boolean value.
     *
     * @param mixed $value The value that should be validated
     * @return void
     * @api
     */
    protected function isValid($value)
    {
        $consumer = new Consumer();
        $embedObject = $consumer->consume($value);
        if ($embedObject === null) {
            $this->addError('This URI has no oEmbed support.', 1403004582, [$value]);
        }
    }

}