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
     * @When I want to create a new :type bookmark
     */
    public function iWantToCreateBookmark(string $type)
    {
        if ('video' === $type) {
            $this->createVideoPage->open();
        } elseif ('photo' === $type) {
            $this->createPhotoPage->open();
        } else {
            throw new \InvalidArgumentException(sprintf('Bookmark type %s is incorrect', $type));
        }
    }

    /**
     * @When I want to browse bookmarks
     * @When I browse bookmarks
     */
    public function iWantToBrowseBookmarks()
    {
        $this->indexPage->open();
    }

    /**
     * @Given I want to modify the :bookmark bookmark
     */
    public function iWantToModifyABookmark(Bookmark $bookmark)
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
     * @When I delete bookmark with title :title
     */
    public function iDeleteBookmarkWithTitle($title)
    {
        $this->indexPage->deleteResourceOnPage(['title' => $title]);
    }

    /**
     * @When I (also) check the :title bookmark
     */
    public function iCheckTheBookmark(string $title): void
    {
        $this->indexPage->checkResourceOnPage(['title' => $title]);
    }

    /**
     * @When I delete them
     */
    public function iDeleteThem(): void
    {
        $this->indexPage->bulkDelete();
    }

    /**
     * @Then I should see a single bookmark in the list
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
     * @Then I should be notified that the :elementName is required
     */
    public function iShouldBeNotifiedThatTitleIsRequired(string $elementName)
    {
        /** @var CreatePage $currentPage */
        $currentPage = $this->currentPageResolver->getCurrentPageWithForm([
            $this->createVideoPage,
            $this->createPhotoPage,
            $this->updatePage,
        ]);

        Assert::same($currentPage->getValidationMessage($elementName), 'This value should not be blank.');
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
