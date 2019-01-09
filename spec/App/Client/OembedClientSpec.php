<?php

namespace spec\App\Client;

use App\Client\OembedClient;
use GuzzleHttp\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;

class OembedClientSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client, '/path?url=%s');
    }

    function it_calls_client_request(Client $client, ResponseInterface $response): void
    {
        $url = 'http:example.com';
        $client->get('/path?url=http:example.com')->willReturn($response);

        $client->get('/path?url=http:example.com')->shouldBeCalled();

        $this->request($url);
    }
}
