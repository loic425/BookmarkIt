<?php
/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Client;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class OembedClient implements OembedClientInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $uri;

    /**
     * @param Client $client
     * @param string $uri
     */
    public function __construct(Client $client, string $uri)
    {
        $this->client = $client;
        $this->uri = $uri;
    }

    /**
     * {@inheritdoc}
     */
    public function request(string $url): ResponseInterface
    {
        $uri = sprintf($this->uri, $url);

        return $this->client->get($uri);
    }
}
