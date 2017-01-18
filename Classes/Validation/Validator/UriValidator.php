<?php
namespace Ttree\Oembed\Validation\Validator;

/*
 * This file is part of the Ttree.Oembed package.
 *
 * (c) Dominique Feyer <dfeyer@ttree.ch>
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Ttree\Oembed\Consumer;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Validation\Validator\AbstractValidator;

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