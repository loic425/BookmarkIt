<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Behat\Context\Ui\Frontend;

use App\Behat\Page\Frontend\Bookmark\CreatePage;
use App\Behat\Page\Frontend\Bookmark\IndexPage;
use App\Behat\Page\Frontend\Bookmark\UpdatePage;
use App\Behat\Service\Resolver\CurrentPageResolverInterface;
use App\Entity\Bookmark;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

class ManagingBookmarksContext implements Context
{
    /**
     * @var CreatePage
     */
    private $createVideoPage;

    /**
     * @var CreatePage
     */
    private $createPhotoPage;

    /**
     * @var IndexPage
     */
    private $indexPage;

    /**
     * @var UpdatePage
     */
    private $updatePage;

    /**
     * @var CurrentPageResolverInterface
     */
    private $currentPageResolver;

    /**
     * @param CreatePage $createVideoPage
     * @param CreatePage $createPhotoPage
     * @param IndexPage $indexPage
     * @param UpdatePage $updatePage
     * @param CurrentPageResolverInterface $currentPageResolver
     */
    public function __construct(
        CreatePage $createVideoPage,
        CreatePage $createPhotoPage,
        IndexPage $indexPage,
        UpdatePage $updatePage,
        CurrentPageResolverInterface $currentPageResolver
    ) {
        $this->createVideoPage = $createVideoPage;
        $this->createPhotoPage = $createPhotoPage;
        $this->indexPage = $indexPage;
        $this->updatePage = $updatePage;
        $this->currentPageResolver = $currentPageResolver;
    }

    /**
     * @When I want to create a new video bookmark
     */
    public function iWantToCreateVideoBookmark()
    {
        $this->createVideoPage->open();
    }

    /**
     * @When I want to browse bookmarks
     */
    public function iWantToBrowseBookmarks()
    {
        $this->indexPage->open();
    }

    /**
     * @Given I want to modify the :bookmark bookmark
     */
    public function iWantToModifyAnArticle(Bookmark $bookmark)
    {
        $this->updatePage->open(['id' => $bookmark->getId()]);
    }


    /**
     * @When I specify its title as :title
     * @When I do not specify its title
     */
    public function iSpecifyItsTitleAs(string $title = null)
    {
        $this->createVideoPage->specifyTitle($title);
    }

    /**
     * @When I specify its url as :url
     * @When I do not specify its url
     */
    public function iSpecifyItsUrlAs(string $url = null)
    {
        $this->createVideoPage->specifyUrl($url);
    }

    /**
     * @When I specify its author name as :authorName
     * @When I do not specify its author name
     */
    public function iSpecifyItsAuthorNameAs(string $authorName = null)
    {
        $this->createVideoPage->specifyAuthorName($authorName);
    }

    /**
     * @When I specify its width as :width
     * @When I do not specify its width
     */
    public function iSpecifyItsWidthAs(string $width = null)
    {
        $this->createVideoPage->specifyWidth($width);
    }

    /**
     * @When I specify its height as :height
     * @When I do not specify its height
     */
    public function iSpecifyItsHeightAs(string $height = null)
    {
        $this->createVideoPage->specifyHeight($height);
    }

    /**
     * @When I specify its duration as :duration
     * @When I do not specify its duration
     */
    public function iSpecifyItsDurationAs(string $duration = null)
    {
        $this->createVideoPage->specifyDuration($duration);
    }

    /**
     * @When I rename it to :title
     */
    public function iChangeItsTitleAs($title = null)
    {
        $this->updatePage->changeTitle($title);
    }

    /**
     * @When I add it
     * @When I try to add it
     */
    public function iAddIt()
    {
        /** @var CreatePage $currentPage */
        $currentPage = $this->currentPageResolver->getCurrentPageWithForm([
            $this->createVideoPage,
            $this->createPhotoPage
        ]);

        $currentPage->create();
    }

    /**
     * @When I save my changes
     * @When I try to save my changes
     */
    public function iSaveMyChanges()
    {
        $this->updatePage->saveChanges();
    }

    /**
     * @Then /^there should be (\d+) bookmarks in the list$/
     */
    public function iShouldSeeBookmarksInTheList(int $number = 1): void
    {
        Assert::same($this->indexPage->countItems(), (int) $number);
    }

    /**
     * @Then I should (also )see the bookmark :title in the list
     * @Then the bookmark :title should appear in the website
     */
    public function theBookmarkShouldAppearInTheWebsite($title)
    {
        $this->indexPage->open();
        Assert::true($this->indexPage->isSingleResourceOnPage(['title' => $title]));
    }

    /**
     * @Then there should not be :title bookmark anymore
     */
    public function thereShouldBeNoAnymore($title)
    {
        Assert::false($this->indexPage->isSingleResourceOnPage(['title' => $title]));
    }


    /**
     * @Then I should be notified that the title is required
     */
    public function iShouldBeNotifiedThatTitleIsRequired()
    {
        /** @var CreatePage $currentPage */
        $currentPage = $this->currentPageResolver->getCurrentPageWithForm([
            $this->createVideoPage,
            $this->createPhotoPage
        ]);

        Assert::same($currentPage->getValidationMessage('title'), 'This value should not be blank.');
    }

    /**
     * @Then this bookmark should not be added
     */
    public function thisBookmarkShouldNotBeAdded()
    {
        $this->indexPage->open();
        Assert::same($this->indexPage->countItems(), 0);
    }
}
