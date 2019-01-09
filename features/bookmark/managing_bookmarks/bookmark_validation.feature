@managing_bookmarks
Feature: Bookmarks validation
    In order to avoid making mistakes when managing bookmarks
    As a Visitor
    I want to be prevented from adding it without specifying required fields

    @ui
    Scenario: Trying to add a new bookmark without url
        Given I want to create a new bookmark
        When I do not specify its url
        And I try to add it
        Then I should be notified that the url is required
        And this bookmark should not be added

    @ui
    Scenario: Trying to add a new bookmark with a not valid url
        Given I want to create a new bookmark
        When I specify its url as "not valid url"
        And I try to add it
        Then I should be notified that the url is not valid
        And this bookmark should not be added

    @ui
    Scenario: Trying to add a new bookmark with a not supported domain
        Given I want to create a new bookmark
        When I specify its url as "http://example.com"
        And I try to add it
        Then I should be notified that the domain "example.com" is not supported
        And this bookmark should not be added

    @ui
    Scenario: Trying to add a new bookmark with a not supported url
        Given I want to create a new bookmark
        When I specify its url as "http://www.flickr.com/photos/bees/0/"
        And I try to add it
        Then I should be notified that the url "http://www.flickr.com/photos/bees/0/" is not supported
        And this bookmark should not be added
