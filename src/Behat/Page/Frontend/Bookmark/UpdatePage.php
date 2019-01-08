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
     * @param string|null $url
     *
     * @throws ElementNotFoundException
     */
    public function changeUrl(?string $url)
    {
        $this->getElement('url')->setValue($url);
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'url' => '#app_bookmark_url',
        ]);
    }
}
