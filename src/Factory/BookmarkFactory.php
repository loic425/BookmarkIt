<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Factory;

use App\Entity\Bookmark;
use Sylius\Component\Resource\Factory\FactoryInterface;

class BookmarkFactory implements FactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return Bookmark|object
     */
    public function createNew(): Bookmark
    {
        return $this->factory->createNew();
    }

    /**
     * @param string $type
     *
     * @return Bookmark
     */
    public function createTyped(string $type): Bookmark
    {
        $bookMark = $this->createNew();
        $bookMark->setType($type);

        return $bookMark;
    }
}
