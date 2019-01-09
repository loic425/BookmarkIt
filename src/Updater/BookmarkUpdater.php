<?php
/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Updater;

use App\Client\OembedClientRegistry;
use App\Entity\Bookmark;

class BookmarkUpdater
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

    public function update(Bookmark $bookmark): void
    {
        $url = $bookmark->getUrl();
        $domain = parse_url($url, PHP_URL_HOST);
        $client = $this->clientRegistry->getClient($domain);

        $response = $client->request($bookmark->getUrl());

        $data = json_decode($response->getBody()->getContents(), true);
        $bookmark->setType($data['type']);
        $bookmark->setTitle($data['title']);
        $bookmark->setAuthorName($data['author_name']);
        $bookmark->setWidth((int) $data['width']);
        $bookmark->setHeight((int) $data['height']);
        $bookmark->setDuration(isset($data['duration']) ? (int) $data['duration'] : null);
    }
}
