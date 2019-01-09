@managing_bookmarks
Feature: Deleting multiple bookmarks
    In order to get rid of spam bookmarks in an efficient way
    As a Visitor
    I want to be able to delete multiple bookmarks at once

    Background:
        Given there is a bookmark titled "Star Wars"
        And there is also a bookmark titled "Game Of Thrones"
        And there is also a bookmark titled "Back To The Future"

    @ui @javascript
    Scenario: Deleting multiple bookmarks at once
        Given I browse bookmarks
        And I check the "Star Wars" bookmark
        And I also check the "Game Of Thrones" bookmark
        And I delete them
        Then I should be notified that they have been successfully deleted
        And I should see a single bookmark in the list
        And I should see the bookmark "Back To The Future" in the list
