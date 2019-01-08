<?php

namespace spec\App\Entity;

use App\Entity\Bookmark;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\ResourceInterface;

class BookmarkSpec extends ObjectBehavior
{
    function it_implements_resource_interface(): void
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    function it_has_no_type_by_default(): void
    {
        $this->getType()->shouldReturn(null);
    }

    function its_type_is_mutable(): void
    {
        $this->setType(Bookmark::TYPE_VIDEO);
        $this->getType()->shouldReturn(Bookmark::TYPE_VIDEO);
    }

    function it_has_no_title_by_default(): void
    {
        $this->getTitle()->shouldReturn(null);
    }

    function its_title_is_mutable(): void
    {
        $this->setTitle('My favorite video');
        $this->getTitle()->shouldReturn('My favorite video');
    }

    function it_has_no_url_by_default(): void
    {
        $this->getUrl()->shouldReturn(null);
    }

    function its_url_is_mutable(): void
    {
        $this->setUrl('http://example.com/video');
        $this->getUrl()->shouldReturn('http://example.com/video');
    }

    function it_has_no_author_name_by_default(): void
    {
        $this->getAuthorName()->shouldReturn(null);
    }

    function its_author_name_is_mutable(): void
    {
        $this->setAuthorName('George Lucas');
        $this->getAuthorName()->shouldReturn('George Lucas');
    }

    function it_initializes_added_date_by_default(): void
    {
        $this->getAddedAt()->shouldHaveType(\DateTimeInterface::class);
    }

    function its_added_date_is_mutable(): void
    {
        $addedAt = new \DateTime();
        $this->setAddedAt($addedAt);
        $this->getAddedAt()->shouldReturn($addedAt);
    }

    function it_has_no_width_by_default(): void
    {
        $this->getWidth()->shouldReturn(null);
    }

    function its_width_is_mutable(): void
    {
        $this->setWidth(1280);
        $this->getWidth()->shouldReturn(1280);
    }

    function its_height_is_mutable(): void
    {
        $this->setHeight(1024);
        $this->getHeight()->shouldReturn(1024);
    }

    function it_has_no_duration_by_default(): void
    {
        $this->getDuration()->shouldReturn(null);
    }

    function its_duration_is_mutable(): void
    {
        $this->setDuration(118);
        $this->getDuration()->shouldReturn(118);
    }

    function it_initializes_tags_array_by_default(): void
    {
        $this->getTags()->shouldReturn([]);
    }

    function it_adds_tags(): void
    {
        $this->addTag('movie');
        $this->hasTag('movie')->shouldReturn(true);
    }

    function it_removes_tags(): void
    {
        $this->addTag('movie');
        $this->removeTag('movie');
        $this->hasTag('movie')->shouldReturn(false);
    }
}
