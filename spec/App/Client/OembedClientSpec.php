<?php

namespace spec\App\Client;

use App\Client\OembedClient;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OembedClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(OembedClient::class);
    }
}
