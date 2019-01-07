<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Behat\Page\Frontend\Bookmark;

use App\Behat\Page\Frontend\Crud\UpdatePage as BaseUpdatePage;
use Behat\Mink\Exception\ElementNotFoundException;

class UpdatePage extends BaseUpdatePage
{
    /**
     * @param string|null $title
     *
     * @throws ElementNotFoundException
     */
    public function changeTitle(?string $title)
    {
        $this->getElement('title')->setValue($title);
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'author_name' => '#app_bookmark_authorName',
            'duration' => '#app_bookmark_duration',
            'height' => '#app_bookmark_height',
            'title' => '#app_bookmark_title',
            'url' => '#app_bookmark_url',
            'width' => '#app_bookmark_width',
        ]);
    }
}
