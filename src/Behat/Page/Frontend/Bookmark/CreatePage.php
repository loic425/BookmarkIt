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
     * @param string|null $title
     *
     * @throws ElementNotFoundException
     */
    public function specifyTitle(?string $title)
    {
        $this->getElement('title')->setValue($title);
    }

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
     * @param string|null $authorName
     *
     * @throws ElementNotFoundException
     */
    public function specifyAuthorName(?string $authorName)
    {
        $this->getElement('author_name')->setValue($authorName);
    }

    /**
     * @param string|null $width
     *
     * @throws ElementNotFoundException
     */
    public function specifyWidth(?string $width)
    {
        $this->getElement('width')->setValue($width);
    }

    /**
     * @param string|null $height
     *
     * @throws ElementNotFoundException
     */
    public function specifyHeight(?string $height)
    {
        $this->getElement('height')->setValue($height);
    }

    /**
     * @param string|null $duration
     *
     * @throws ElementNotFoundException
     */
    public function specifyDuration(?string $duration)
    {
        $this->getElement('duration')->setValue($duration);
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
