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

use App\Entity\Bookmark;
use GuzzleHttp\Client;

class BookmarkUpdater
{
    /**
     * @var Client
     */
    private $photoClient;

    /**
     * @var Client
     */
    private $videoClient;

    /**
     * @param Client $photoClient
     * @param Client $videoClient
     */
    public function __construct(Client $photoClient, Client $videoClient)
    {
        $this->photoClient = $photoClient;
        $this->videoClient = $videoClient;
    }

    public function update(Bookmark $bookmark): void
    {
        $response = $this->request($bookmark->getUrl());

        $data = json_decode($response->getBody()->getContents(), true);
        $bookmark->setType($data['type']);
        $bookmark->setTitle($data['title']);
        $bookmark->setAuthorName($data['author_name']);
        $bookmark->setWidth((int)$data['width']);
        $bookmark->setHeight((int)$data['height']);
        $bookmark->setDuration(isset($data['duration']) ? (int)$data['duration'] : null);
    }

    private function request(string $url)
    {
        if (false !== strpos($url, 'photos')) {
            $uri = sprintf('/services/oembed?format=json&url=%s', $url);

            return $this->photoClient->get($uri);
        }

        $uri = sprintf('/api/oembed.json?url=%s', $url);

        return $this->videoClient->get($uri);
    }
}
