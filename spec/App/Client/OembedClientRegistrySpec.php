<?php

namespace spec\App\Client;

use App\Client\OembedClientInterface;
use PhpSpec\ObjectBehavior;

class OembedClientRegistrySpec extends ObjectBehavior
{
    function it_initializes_client_array_by_default(): void
    {
        $this->getClients()->shouldReturn([]);
    }

    function it_adds_client(OembedClientInterface $client): void
    {
        $this->addClient('flickr.com', $client);
        $this->getClient('flickr.com')->shouldReturn($client);
    }

    function it_returns_null_when_client_does_not_exit()
    {
        $this->getClient('flickr.com')->shouldReturn(null);
    }
}
