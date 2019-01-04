<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Monofony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Behat\Context\Setup;

use App\Entity\Bookmark;
use Behat\Behat\Context\Context;
use App\Behat\Service\SharedStorageInterface;
use App\Fixture\Factory\ExampleFactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class BookmarkContext implements Context
{
    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @var ExampleFactoryInterface
     */
    private $bookmarkFactory;

    /**
     * @var RepositoryInterface
     */
    private $bookmarkRepository;

    /**
     * @param SharedStorageInterface  $sharedStorage
     * @param ExampleFactoryInterface $bookmarkFactory
     * @param RepositoryInterface     $bookmarkRepository
     */
    public function __construct(
        SharedStorageInterface $sharedStorage,
        ExampleFactoryInterface $bookmarkFactory,
        RepositoryInterface $bookmarkRepository
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->bookmarkFactory = $bookmarkFactory;
        $this->bookmarkRepository = $bookmarkRepository;
    }

    /**
     * @Given there is (also )a bookmark titled :title
     */
    public function thereIsAnAdministratorIdentifiedBy(string $title)
    {
       $this->createBookmark(['title' => $title]);
    }

    /**
     * @param array $options
     */
    private function createBookmark(array $options)
    {
        /** @var Bookmark $bookmark */
        $bookmark = $this->bookmarkFactory->create($options);
        $this->bookmarkRepository->add($bookmark);
        $this->sharedStorage->set('bookmark', $bookmark);
    }
}
