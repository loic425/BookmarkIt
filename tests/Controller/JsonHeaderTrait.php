<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * This trait is used to fix detecting json header with content type application/problem+json
 *
 * @see https://github.com/Lakion/ApiTestCase/issues/129
 */
trait JsonHeaderTrait
{
    /**
     * @return array
     */
    private static function getJsonHeader(): array
    {
        return [
            'CONTENT_TYPE' => 'application/json',
            'ACCEPT' => 'application/json',
        ];
    }

    /**
     * @param Response $response
     */
    protected function assertJsonHeader(Response $response)
    {
        parent::assertHeader($response, 'application');
        parent::assertHeader($response, 'json');
    }
}
