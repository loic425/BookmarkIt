<?php

/*
 * This file is part of AppName.
 *
 * (c) Monofony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Behat\Context\Transform;

use App\Entity\Bookmark;
use Behat\Behat\Context\Context;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

class BookmarkContext implements Context
{
    /**
     * @var RepositoryInterface
     */
    private $bookmarkRepository;

    /**
     * @param RepositoryInterface $bookmarkRepository
     */
    public function __construct(RepositoryInterface $bookmarkRepository)
    {
        $this->bookmarkRepository = $bookmarkRepository;
    }

    /**
     * @Transform /^bookmark "([^"]+)"$/
     * @Transform :bookmark
     */
    public function getBookmarkTitle($title)
    {
        /** @var Bookmark $bookmark */
        $bookmark = $this->bookmarkRepository->findOneBy(['title' => $title]);
        Assert::notNull(
            $bookmark,
            sprintf('Bookmark with title "%s" does not exist', $title)
        );
        return $bookmark;
    }
}
