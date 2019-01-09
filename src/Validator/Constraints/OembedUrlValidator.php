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

use App\Client\OembedClientRegistry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class OembedUrlValidator extends ConstraintValidator
{
    /**
     * @var OembedClientRegistry
     */
    private $clientRegistry;

    /**
     * @param OembedClientRegistry $clientRegistry
     */
    public function __construct(OembedClientRegistry $clientRegistry)
    {
        $this->clientRegistry = $clientRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof OembedUrl) {
            throw new UnexpectedTypeException($constraint, OembedUrl::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        $domain = parse_url($value, PHP_URL_HOST);

        // Url Validator should validate that
        if (null === $domain) {
            return;
        }

        $client = $this->clientRegistry->getClient($domain);

        if (null === $client) {
            $this->context->buildViolation($constraint->domainNotSupported)
                ->setParameter('{{ string }}', $domain)
                ->addViolation();
        }
    }
}
