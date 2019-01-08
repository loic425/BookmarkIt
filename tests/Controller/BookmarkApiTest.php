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

use App\Entity\Bookmark;
use Lakion\ApiTestCase\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class BookmarkApiTest extends JsonApiTestCase
{
    use JsonHeaderTrait;

    /**
     * @test
     */
    public function it_does_not_allow_to_create_bookmark_video_without_specifying_required_data()
    {
        $this->client->request('POST', '/api/bookmarks/videos', [], [], static::getJsonHeader(), '{}');

        $response = $this->client->getResponse();
        $this->assertResponse($response, 'bookmark/create_video_validation_fail_response', Response::HTTP_BAD_REQUEST);
    }

    /**
     * @test
     */
    public function it_does_not_allow_to_create_bookmark_photo_without_specifying_required_data()
    {
        $this->client->request('POST', '/api/bookmarks/photos', [], [], static::getJsonHeader(), '{}');

        $response = $this->client->getResponse();
        $this->assertResponse($response, 'bookmark/create_photo_validation_fail_response', Response::HTTP_BAD_REQUEST);
    }

    /**
     * @test
     */
    public function it_allows_to_create_bookmark()
    {
        $data =
            <<<EOT
        {
            "type": "video",
            "title": "Star Wars",
            "url": "http://example.com/star-wars",
            "authorName": "George Lucas",
            "width": 1280,
            "height": 1024,
            "duration": 118
        }
EOT;

        $this->client->request('POST', '/api/bookmarks', [], [], static::getJsonHeader(), $data);

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'bookmark/create_response', Response::HTTP_CREATED);
    }

    /**
     * @test
     */
    public function it_allows_to_get_bookmarks_list()
    {
        $this->loadFixturesFromFile('resources/bookmarks.yml');

        $this->client->request('GET', '/api/bookmarks', [], [], static::getJsonHeader());

        $response = $this->client->getResponse();
        $this->assertResponse($response, 'bookmark/index_response', Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function it_returns_not_found_response_when_requesting_details_of_a_bookmark_which_does_not_exist()
    {
        $this->client->request('GET', '/api/bookmarks/-1', [], [], static::getJsonHeader());

        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     */
    public function it_allows_to_get_one_bookmark()
    {
        $bookmarks = $this->loadFixturesFromFile('resources/bookmarks.yml');
        $bookmark = $bookmarks['star_wars'];

        $this->client->request('GET', $this->getBookmarkUrl($bookmark), [], [], static::getJsonHeader());

        $response = $this->client->getResponse();
        $this->assertResponse($response, 'bookmark/show_response', Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function it_does_not_allow_to_remove_duration_from_bookmark_video()
    {
        $bookmarks = $this->loadFixturesFromFile('resources/bookmarks.yml');
        $bookmark = $bookmarks['star_wars'];

        $data =
            <<<EOT
        {
            "duration": null
        }
EOT;

        $this->client->request('PUT', $this->getBookmarkUrl($bookmark), [], [], static::getJsonHeader(), $data);

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'bookmark/remove_duration_from_video_validation_fail_response', Response::HTTP_BAD_REQUEST);
    }

    /**
     * @test
     */
    public function it_returns_not_found_response_when_trying_to_update_bookmark_which_does_not_exist()
    {
        $this->client->request('PUT', '/api/bookmarks/-1', [], [], static::getJsonHeader());

        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     */
    public function it_allows_updating_bookmark_title()
    {
        $bookmarks = $this->loadFixturesFromFile('resources/bookmarks.yml');
        $bookmark = $bookmarks['star_wars'];

        $data =
            <<<EOT
        {
            "title": "Star Wars: Empire strikes back"
        }
EOT;

        $this->client->request('PUT', $this->getBookmarkUrl($bookmark), [], [], static::getJsonHeader(), $data);

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'bookmark/update_response', Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function it_allows_updating_bookmark_tags()
    {
        $bookmarks = $this->loadFixturesFromFile('resources/bookmarks.yml');
        $bookmark = $bookmarks['star_wars'];

        $data =
            <<<EOT
        {
            "tags": ["top movie"]
        }
EOT;

        $this->client->request('PUT', $this->getBookmarkUrl($bookmark), [], [], static::getJsonHeader(), $data);

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'bookmark/update_tags_response', Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function it_returns_not_found_response_when_trying_to_delete_bookmark_which_does_not_exist()
    {
        $this->client->request('DELETE', '/api/bookmarks/-1', [], [], static::getJsonHeader());

        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     */
    public function it_allows_to_delete_bookmark()
    {
        $bookmarks = $this->loadFixturesFromFile('resources/bookmarks.yml');
        $bookmark = $bookmarks['star_wars'];

        $this->client->request('DELETE', $this->getBookmarkUrl($bookmark), [], [], static::getJsonHeader());

        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_NO_CONTENT);

        $this->client->request('GET', $this->getBookmarkUrl($bookmark), [], [], static::getJsonHeader());

        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_NOT_FOUND);
    }

    /**
     * @param Bookmark $bookmark
     *
     * @return string
     */
    private function getBookmarkUrl(Bookmark $bookmark)
    {
        return '/api/bookmarks/' . $bookmark->getId();
    }
}
