<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class OembedUrl extends Constraint
{
    public $domainNotSupported = 'The domain "{{ string }}" is not supported.';
    public $urlNotSupported = 'The url "{{ string }}" is not supported.';
}
