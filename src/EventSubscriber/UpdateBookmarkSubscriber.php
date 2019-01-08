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

use App\Entity\Bookmark;
use App\Updater\BookmarkUpdater;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
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
            'app.bookmark.pre_create' => 'updateBookmarkDetails',
            'app.bookmark.pre_update' => 'updateBookmarkDetails',
        ];
    }

    /**
     * @param GenericEvent $event
     */
    public function updateBookmarkDetails(GenericEvent $event)
    {
        $bookmark = $event->getSubject();
        Assert::isInstanceOf($bookmark, Bookmark::class);

        $this->updater->update($bookmark);
    }
}
