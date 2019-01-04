<?php

namespace spec\App\Factory;

use App\Entity\Bookmark;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Factory\FactoryInterface;

class BookmarkFactorySpec extends ObjectBehavior
{
    function let(FactoryInterface $factory)
    {
        $this->beConstructedWith($factory);
    }

    function it_implements_resource_factory_interface(): void
    {
        $this->shouldHaveType(FactoryInterface::class);
    }

    function it_creates_untyped_book_mark(FactoryInterface $factory, Bookmark $bookMark): void
    {
        $factory->createNew()->willReturn($bookMark);

        $this->createNew()->shouldReturn($bookMark);
    }

    function it_creates_typed_book_mark(FactoryInterface $factory, Bookmark $bookMark): void
    {
        $factory->createNew()->willReturn($bookMark);

        $bookMark->setType(Bookmark::TYPE_VIDEO)->shouldBeCalled();

        $this->createTyped(Bookmark::TYPE_VIDEO);
    }
}
