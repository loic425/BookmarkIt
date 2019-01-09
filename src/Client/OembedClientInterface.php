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

use Psr\Http\Message\ResponseInterface;

interface OembedClientInterface
{
    /**
     * @param string $url
     *
     * @return ResponseInterface
     */
    public function request(string $url): ResponseInterface;
}