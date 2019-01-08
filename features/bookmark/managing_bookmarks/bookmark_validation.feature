@managing_bookmarks
Feature: Bookmarks validation
    In order to avoid making mistakes when managing bookmarks
    As an Visitor
    I want to be prevented from adding it without specifying required fields

    @ui
    Scenario: Trying to add a new bookmark without url
        Given I want to create a new bookmark
        When I do not specify its url
        And I try to add it
        Then I should be notified that the url is required
        And this bookmark should not be added
