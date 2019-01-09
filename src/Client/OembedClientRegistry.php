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

class OembedClientRegistry
{
    /**
     * @var array|OembedClientInterface[]
     */
    private $clients = [];

    /**
     * @return OembedClientInterface[]|array
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * @param string                $domain
     * @param OembedClientInterface $client
     */
    public function addClient(string $domain, OembedClientInterface $client): void
    {
        $this->clients[$domain] = $client;
    }

    /**
     * @param string $domain
     *
     * @return OembedClientInterface|null
     */
    public function getClient(string $domain): ?OembedClientInterface
    {
        return isset($this->clients[$domain]) ? $this->clients[$domain] : null;
    }
}
