<?php

namespace spec\App\Updater;

use App\Entity\Bookmark;
use GuzzleHttp\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class BookmarkUpdaterSpec extends ObjectBehavior
{
    function let(Client $photoClient, Client $videoClient)
    {
        $this->beConstructedWith($photoClient, $videoClient);
    }

    function it_update_photo_book_mark(
        Bookmark $bookMark,
        Client $photoClient,
        ResponseInterface $response,
        StreamInterface $body
    ): void {
        $bookMark->getUrl()->willReturn("http://www.flickr.com/photos/bees/2341623661/");

        $photoClient->get(Argument::type('string'))->willReturn($response);
        $response->getBody()->willReturn($body);
        $body->getContents()->willReturn(<<<EOM
{
  "type": "photo",
  "title": "ZB8T0193",
  "author_name": "‮‭‬bees‬",
  "width": "1024",
  "height": "683",
  "url": "https://farm4.staticflickr.com/3123/2341623661_7c99f48bbf_b.jpg"
}
EOM
        );
        $bookMark->setTitle("ZB8T0193")->shouldBeCalled();
        $bookMark->setType("photo")->shouldBeCalled();
        $bookMark->setAuthorName("‮‭‬bees‬")->shouldBeCalled();
        $bookMark->setWidth(1024)->shouldBeCalled();
        $bookMark->setHeight(683)->shouldBeCalled();
        $bookMark->setDuration(null)->shouldBeCalled();

        $this->update($bookMark);
    }

    function it_update_video_book_mark(
        Bookmark $bookMark,
        Client $videoClient,
        ResponseInterface $response,
        StreamInterface $body
    ): void {
        $bookMark->getUrl()->willReturn("https://vimeo.com/76979871");

        $videoClient->get(Argument::type('string'))->willReturn($response);
        $response->getBody()->willReturn($body);
        $body->getContents()->willReturn(<<<EOM
{
  "type": "video",
  "title": "ZB8T0193",
  "author_name": "‮‭‬bees‬",
  "width": "1024",
  "height": "683",
  "url": "https://farm4.staticflickr.com/3123/2341623661_7c99f48bbf_b.jpg",
  "duration": "98"
}
EOM
        );
        $bookMark->setTitle("ZB8T0193")->shouldBeCalled();
        $bookMark->setType("video")->shouldBeCalled();
        $bookMark->setAuthorName("‮‭‬bees‬")->shouldBeCalled();
        $bookMark->setWidth(1024)->shouldBeCalled();
        $bookMark->setHeight(683)->shouldBeCalled();
        $bookMark->setDuration(98)->shouldBeCalled();

        $this->update($bookMark);
    }
}
