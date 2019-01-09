<?php

namespace spec\App\Validator\Constraints;

use App\Client\OembedClientRegistry;
use App\Validator\Constraints\OembedUrl;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class OembedUrlValidatorSpec extends ObjectBehavior
{
    function let(OembedClientRegistry $clientRegistry, ExecutionContextInterface $context)
    {
        $this->beConstructedWith($clientRegistry);
        $this->initialize($context);
    }

    function it_extend_a_base_constraint_validator()
    {
        $this->shouldHaveType(ConstraintValidator::class);
    }

    function it_throws_an_unexpected_type_exception_when_constraint_is_not_valid(
        Constraint $constraint
    ): void
    {
        $this
            ->shouldThrow(UnexpectedTypeException::class)
            ->during('validate', ['value', $constraint]);
    }

    function it_returns_null_when_value_is_null(OembedUrl $constraint): void
    {
        $this->validate(null, $constraint)->shouldReturn(null);
    }

    function it_returns_null_when_value_is_empty(OembedUrl $constraint): void
    {
        $this->validate('', $constraint)->shouldReturn(null);
    }

    function it_throws_an_unexpected_value_exception_when_value_is_not_a_string(
        OembedUrl $constraint
    ): void
    {
        $this
            ->shouldThrow(UnexpectedValueException::class)
            ->during('validate', [2, $constraint]);
    }

    function it_returns_null_when_url_is_not_valid(OembedUrl $constraint): void
    {
        $this->validate('not valid url', $constraint)->shouldReturn(null);
    }

    function it_builds_a_violation_when_domain_is_not_supported(
        OembedUrl $constraint,
        OembedClientRegistry $clientRegistry,
        ExecutionContextInterface $context,
        ConstraintViolationBuilderInterface $violationBuilder
    ): void {
        $clientRegistry->getClient('example.com')->willReturn(null);
        $context->buildViolation('The domain "{{ string }}" is not supported.')->willReturn($violationBuilder);
        $violationBuilder->setParameter('{{ string }}', 'example.com')->willReturn($violationBuilder);

        $context->buildViolation('The domain "{{ string }}" is not supported.')->shouldBeCalled();
        $violationBuilder->setParameter('{{ string }}', 'example.com')->shouldBeCalled();
        $violationBuilder->addViolation()->shouldBeCalled();

        $this->validate('http://example.com', $constraint);
    }
}
