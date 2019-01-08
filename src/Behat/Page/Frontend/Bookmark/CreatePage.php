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

use App\Behat\Page\Frontend\Crud\CreatePage as BaseCreatePage;
use Behat\Mink\Exception\ElementNotFoundException;

class CreatePage extends BaseCreatePage
{
    /**
     * @param string|null $url
     *
     * @throws ElementNotFoundException
     */
    public function specifyUrl(?string $url)
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
