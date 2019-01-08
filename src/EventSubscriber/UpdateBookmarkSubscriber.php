<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Bookmark;
use App\Updater\BookmarkUpdater;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Webmozart\Assert\Assert;

class UpdateBookmarkSubscriber implements EventSubscriberInterface
{
    /**
     * @var BookmarkUpdater
     */
    protected $updater;

    /**
     * @param BookmarkUpdater $updater
     */
    public function __construct(BookmarkUpdater $updater)
    {
        $this->updater = $updater;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'app.bookmark.pre_create' => 'updateBookmarkFromGenericEvent',
            'app.bookmark.pre_update' => 'updateBookmarkFromGenericEvent',
            KernelEvents::VIEW => ['updateBookmarkFromApiEvent', EventPriorities::PRE_WRITE],
        ];
    }

    public function updateBookmarkFromGenericEvent(GenericEvent $event)
    {
        $bookmark = $event->getSubject();
        Assert::isInstanceOf($bookmark, Bookmark::class);
        $this->updateBookmarkDetails($bookmark);
    }

    public function updateBookmarkFromApiEvent(GetResponseForControllerResultEvent $event)
    {
        $bookmark = $event->getControllerResult();

        if (!$bookmark instanceof Bookmark) {
            return;
        }

        $this->updateBookmarkDetails($bookmark);
    }

    /**
     * @param Bookmark $bookmark
     */
    public function updateBookmarkDetails(Bookmark $bookmark)
    {
        $this->updater->update($bookmark);
    }
}
