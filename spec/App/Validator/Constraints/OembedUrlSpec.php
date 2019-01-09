<?php

namespace spec\App\Validator\Constraints;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Validator\Constraint;

class OembedUrlSpec extends ObjectBehavior
{
    function it_extend_a_base_constraint()
    {
        $this->shouldHaveType(Constraint::class);
    }


}
