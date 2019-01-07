<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Entity\Bookmark;

class CreateBookmarkPhoto
{
    public function __invoke(Bookmark $data): Bookmark
    {
        $data->setType(Bookmark::TYPE_PHOTO);

        return $data;
    }
}
